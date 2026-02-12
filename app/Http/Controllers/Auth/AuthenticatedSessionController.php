<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = auth()->user();

        if (!$user->is_verified) {
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'Akun belum diverifikasi.');
        }

        $request->session()->regenerate();

        // Update last login
        $user->update(['last_login' => now()]);

        // Redirect berdasarkan role
        if ($user->role_type === 'admin') {
            return redirect()->route('admin.home');
        }
        
        if ($user->role_type === 'guru') {
            switch ($user->guru_type) {
                case 'PAUD':
                    return redirect()->route('guru.paud.home');
                case 'Learn kursus':
                    return redirect()->route('guru.learn.home');
                case 'Homelearning kursus private':
                    return redirect()->route('guru.homelearning.home');
                default:
                    return redirect()->route('dashboard');
            }
        }
        
        if ($user->role_type === 'orang_tua') {
            // Cek apakah sudah ada siswa dan sudah pilih layanan
            $siswa = Siswa::where('orang_tua_id', $user->id)->first();
            
            if ($siswa && $siswa->layanan) {
                return redirect()->route('orangtua.home');
            }
            
            return redirect()->route('ortu.pilih.layanan');
        }

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}