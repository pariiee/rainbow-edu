<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Buat user admin
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@rainbowedu.com',
            'password' => Hash::make('password123'),
            'role_type' => 'admin',
            'guru_type' => null,
            'nama_anak' => null,
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        // Assign role admin
        $admin->assignRole('admin');
    }
}