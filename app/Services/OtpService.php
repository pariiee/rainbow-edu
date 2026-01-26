<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class OtpService
{
    public function generateOtp(): array
    {
        $otp = random_int(100000, 999999);

        return [
            'otp'           => bcrypt($otp),
            'otp_plain'     => (string) $otp, // dev/debug only
            'otp_expiry'    => now()->addMinutes(5),
            'otp_attempt'   => 0,
            'otp_cooldown'  => now()->addMinutes(1),
        ];
    }

    public function sendOtp(string $email, string $otp): bool
    {
        try {
            Mail::send('emails.otp', [
                'otp' => $otp,
                'expiry_minutes' => 5,
            ], function ($message) use ($email) {
                $message->to($email)
                        ->subject('Kode Verifikasi OTP');
            });

            return true;
        } catch (\Throwable $e) {
            Log::error('OTP EMAIL FAILED', [
                'email' => $email,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}
