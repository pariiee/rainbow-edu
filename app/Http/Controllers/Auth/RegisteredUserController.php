<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request, OtpService $otpService): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
            'role_type' => ['required', 'in:orang_tua,guru'],
            'guru_type' => ['required_if:role_type,guru', 'nullable', 'in:PAUD,Learn kursus,Homelearning kursus private'],
            'nama_anak' => ['required_if:role_type,orang_tua', 'nullable', 'string', 'max:255', 'regex:/^[a-zA-Z\s.,\'"-]+$/'],
        ], [
            'nama_anak.regex' => 'Nama anak hanya boleh berisi huruf, spasi, dan simbol umum.',
            'nama_anak.required_if' => 'Nama anak harus diisi untuk pendaftaran sebagai orang tua.',
            'guru_type.required_if' => 'Divisi guru harus dipilih.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_type' => $validated['role_type'],
            'guru_type' => $validated['guru_type'] ?? null,
            'nama_anak' => $validated['role_type'] === 'orang_tua' ? $validated['nama_anak'] : null,
            'is_verified' => false,
        ]);

        // Assign role Spatie
        Role::firstOrCreate(['name' => $validated['role_type'], 'guard_name' => 'web']);
        $user->assignRole($validated['role_type']);

        // OTP
        $otpData = $otpService->generateOtp();

        if (!$otpService->sendOtp($user->email, $otpData['otp_plain'])) {
            return back()->withErrors([
                'email' => 'Gagal mengirim OTP. Silakan coba lagi.'
            ]);
        }

        $user->update($otpData);

        session(['pending_user_id' => $user->id]);

        return redirect()->route('otp.verify')
            ->with('success', 'Kode OTP telah dikirim ke email Anda.');
    }
}