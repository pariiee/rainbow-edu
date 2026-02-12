<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OtpController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    /**
     * Show the OTP verification form
     */
    public function showVerifyForm()
    {
        // Jika user sudah login, redirect ke after-verify
        if (Auth::check()) {
            return redirect()->route('after.verify');
        }

        // Cek apakah ada pending user di session
        if (!session()->has('pending_user_id')) {
            Log::warning('Akses OTP tanpa pending_user_id');
            return redirect()->route('register')
                ->with('error', 'Sesi tidak valid. Silakan daftar ulang.');
        }

        $userId = session('pending_user_id');
        $user = User::find($userId);
        
        if (!$user) {
            session()->forget('pending_user_id');
            return redirect()->route('register')
                ->with('error', 'User tidak ditemukan. Silakan daftar ulang.');
        }

        // Jika user sudah terverifikasi, langsung login
        if ($user->is_verified) {
            Auth::login($user);
            session()->forget('pending_user_id');
            return redirect()->route('after.verify');
        }

        return view('auth.verify-otp', [
            'email' => $user->email,
            'cooldown' => $user->otp_cooldown
        ]);
    }

    /**
     * Verify the OTP code
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6'
        ]);

        $userId = session('pending_user_id');
        
        if (!$userId) {
            return redirect()->route('register')
                ->with('error', 'Sesi tidak valid. Silakan daftar ulang.');
        }

        $user = User::find($userId);
        
        if (!$user) {
            session()->forget('pending_user_id');
            return redirect()->route('register')
                ->with('error', 'User tidak ditemukan.');
        }

        // Verifikasi OTP
        if ($user->verifyOtp($request->otp)) {
            // Hapus session pending
            session()->forget('pending_user_id');
            
            // Login user
            Auth::login($user);
            
            Log::info('User berhasil diverifikasi', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $user->role_type
            ]);
            
            // Redirect berdasarkan role
            if ($user->role_type === 'orang_tua') {
                return redirect()->route('ortu.pilih.layanan')
                    ->with('success', 'Akun berhasil diverifikasi! Silakan pilih layanan.');
            }
            
            return redirect()->route('after.verify')
                ->with('success', 'Akun berhasil diverifikasi!');
        }

        // Jika OTP salah
        $attempts = $user->otp_attempt ?? 0;
        $remainingAttempts = 3 - $attempts;
        
        if ($remainingAttempts <= 0) {
            $user->delete(); // Hapus user jika terlalu banyak gagal
            session()->forget('pending_user_id');
            return redirect()->route('register')
                ->with('error', 'Terlalu banyak percobaan. Silakan daftar ulang.');
        }

        return back()->with('error', "Kode OTP tidak valid. Sisa percobaan: {$remainingAttempts}");
    }

    /**
     * Resend OTP code
     */
    public function resendOtp(Request $request)
    {
        $userId = session('pending_user_id');
        
        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'Sesi tidak valid'
            ], 400);
        }

        $user = User::find($userId);
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        // Cek cooldown
        if (!$user->canRequestOtp()) {
            $waitTime = now()->diffInSeconds($user->otp_cooldown);
            return response()->json([
                'success' => false,
                'message' => "Silakan tunggu {$waitTime} detik",
                'wait_time' => $waitTime
            ], 429);
        }

        // Generate OTP baru
        $otpData = $this->otpService->generateOtp();
        
        // Kirim OTP
        if ($this->otpService->sendOtp($user->email, $otpData['otp_plain'])) {
            $user->update($otpData);
            
            Log::info('OTP berhasil dikirim ulang', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Kode OTP baru telah dikirim ke email Anda',
                'cooldown' => $user->otp_cooldown
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mengirim OTP. Silakan coba lagi.'
        ], 500);
    }
}