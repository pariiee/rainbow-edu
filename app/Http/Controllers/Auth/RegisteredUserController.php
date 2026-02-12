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
            'password' => ['required', 'confirmed', 'min:8'],
            'role_type' => ['required', 'in:orang_tua,guru,admin'],
            'guru_type' => ['required_if:role_type,guru', 'nullable', 'in:PAUD,Learn kursus,Homelearning kursus private'],
            'nama_anak' => ['required_if:role_type,orang_tua', 'nullable', 'string', 'max:255'],
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
        $role = Role::firstOrCreate(['name' => $validated['role_type'], 'guard_name' => 'web']);
        $user->assignRole($role);

        // Generate and send OTP
        $otpData = $otpService->generateOtp();
        $otpService->sendOtp($user->email, $otpData['otp_plain']);
        $user->update($otpData);

        // SIMPAN USER ID DI SESSION
        session(['pending_user_id' => $user->id]);
        
        // LANGSUNG REDIRECT KE OTP VERIFY (TANPA LOGIN)
        return redirect()->route('otp.verify')
            ->with('success', 'Kode OTP telah dikirim ke email ' . $user->email);
    }
}