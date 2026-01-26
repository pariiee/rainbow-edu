<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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

        if (!auth()->user()->is_verified) {
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'Akun belum diverifikasi.');
        }

        $request->session()->regenerate();

        // Redirect berdasarkan role dan divisi guru
        $user = auth()->user();
        
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.home');
        }
        
        if ($user->hasRole('guru')) {
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
        
        if ($user->hasRole('orang_tua')) {
            return redirect()->route('orangtua.home');
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