<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\OtpService;
use Illuminate\Http\Request;

class ForgotPasswordOtpController extends Controller
{
    public function show()
    {
        return view('auth.forgot-password');
    }

    public function send(Request $request, OtpService $otpService)
    {
        $request->validate(['email' => ['required', 'email']]);

        $result = $otpService->sendPasswordResetOtp($request->email);

        if (!$result['success']) {
            return back()->with('error', $result['message']);
        }

        session(['reset_user_id' => $result['user_id']]);

        return redirect()->route('password.otp.verify')
            ->with('success', 'OTP reset password dikirim.');
    }
}
