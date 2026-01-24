<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi dasar untuk semua user
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_type' => ['required', 'in:orang_tua,guru'],
        ]);

        // Validasi berdasarkan role
        if ($request->role_type === 'orang_tua') {
            $request->validate([
                'nama_anak' => ['required', 'string', 'max:255'],
                'id_guru' => ['nullable'], // Orang tua tidak perlu ID guru
            ]);
            
            $validatedData['nama_anak'] = $request->nama_anak;
            $validatedData['id_guru'] = null;
        } else if ($request->role_type === 'guru') {
            $request->validate([
                'id_guru' => ['required', 'string', 'size:5', 'regex:/^[0-9]+$/', 'unique:users,id_guru'],
                'nama_anak' => ['nullable'], // Guru tidak perlu nama anak
            ]);
            
            $validatedData['id_guru'] = $request->id_guru;
            $validatedData['nama_anak'] = null;
        }

        // Create user dengan role_type yang benar
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_type' => $validatedData['role_type'], // Ini yang menentukan orang_tua/guru di database
            'id_guru' => $validatedData['id_guru'] ?? null,
            'nama_anak' => $validatedData['nama_anak'] ?? null,
        ]);

        // Pastikan role Spatie ada
        $roleName = $validatedData['role_type']; // 'orang_tua' atau 'guru'
        
        // Cek apakah role sudah ada di Spatie, jika tidak buat
        $role = Role::firstOrCreate([
            'name' => $roleName,
            'guard_name' => 'web'
        ]);

        // Assign role berdasarkan role_type
        // Hanya assign jika user bukan admin pertama
        if (User::count() == 1) {
            $user->assignRole('admin');
            // Tetapi tetap simpan role_type yang dipilih
            $user->update(['role_type' => $validatedData['role_type']]);
        } else {
            // Hapus semua role sebelumnya (jika ada)
            $user->roles()->detach();
            // Assign role yang baru
            $user->assignRole($roleName);
        }

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}