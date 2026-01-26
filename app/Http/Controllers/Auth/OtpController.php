<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OtpController extends Controller
{
    public function show()
    {
        abort_unless(session()->has('pending_user_id'), 403);
        return view('auth.otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'digits:6'],
        ]);

        $user = User::findOrFail(session('pending_user_id'));

        if (!$user->otp || !$user->otp_expiry || now()->gt($user->otp_expiry)) {
            return back()->withErrors(['otp' => 'OTP kadaluarsa']);
        }

        if (!Hash::check($request->otp, $user->otp)) {
            $user->increment('otp_attempt');
            return back()->withErrors(['otp' => 'OTP salah']);
        }

        $user->update([
            'is_verified'  => true,
            'verified_at'  => now(),
            'otp'          => null,
            'otp_plain'    => null,
            'otp_expiry'   => null,
            'otp_attempt'  => 0,
        ]);

        session()->forget('pending_user_id');
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
