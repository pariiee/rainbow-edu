<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // 🔥 hapus token lama
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        $status = Password::sendResetLink(
            $request->only('email')
        );

        // ✅ SUKSES → redirect ke login
        if ($status === Password::RESET_LINK_SENT) {
            return redirect()
                ->route('login')
                ->with('status', __($status));
        }

        // ❌ GAGAL → tetap di form
        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}
