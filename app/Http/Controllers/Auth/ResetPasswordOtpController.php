<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordOtpController extends Controller
{
    public function verify(Request $request, OtpService $otpService)
    {
        $request->validate(['otp' => ['required', 'digits:6']]);

        $userId = session('reset_user_id');

        $result = $otpService->verifyPasswordResetOtp($userId, $request->otp);

        if (!$result['success']) {
            return back()->with('error', $result['message']);
        }

        return redirect()->route('password.reset.form');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::findOrFail(session('reset_user_id'));
        $user->update(['password' => Hash::make($request->password)]);

        session()->forget(['reset_user_id']);

        return redirect()->route('login')
            ->with('success', 'Password berhasil direset.');
    }
}
