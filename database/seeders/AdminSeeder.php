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

        // ============ 1. BUAT ROLE ============
        $roles = ['admin', 'guru', 'orang_tua'];
        
        foreach ($roles as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web'
            ]);
            $this->command->info("✅ Role '{$roleName}' created");
        }

        // ============ 2. BUAT ADMIN ============
        $admin = User::firstOrCreate(
            ['email' => 'admin@rainbowedu.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@rainbowedu.com',
                'password' => Hash::make('password123'),
                'role_type' => 'admin',
                'guru_type' => null,
                'nama_anak' => null,
                'is_verified' => true,
                'verified_at' => now(),
            ]
        );

        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }
        $this->command->info("✅ Admin: admin@rainbowedu.com / password123");

        // ============ 3. BUAT GURU PAUD (1 AKUN) ============
        $guruPaud = User::firstOrCreate(
            ['email' => 'guru.paud@rainbow.edu'],
            [
                'name' => 'Ibu Sarah Wijaya',
                'email' => 'guru.paud@rainbow.edu',
                'password' => Hash::make('password123'),
                'role_type' => 'guru',
                'guru_type' => 'PAUD',
                'is_verified' => true,
                'verified_at' => now(),
            ]
        );

        if (!$guruPaud->hasRole('guru')) {
            $guruPaud->assignRole('guru');
        }
        $this->command->info("✅ Guru PAUD: guru.paud@rainbow.edu / password123");

        // ============ 4. BUAT GURU LEARN (1 AKUN) ============
        $guruLearn = User::firstOrCreate(
            ['email' => 'guru.learn@rainbow.edu'],
            [
                'name' => 'Bapak Budi Santoso',
                'email' => 'guru.learn@rainbow.edu',
                'password' => Hash::make('password123'),
                'role_type' => 'guru',
                'guru_type' => 'Learn kursus',
                'is_verified' => true,
                'verified_at' => now(),
            ]
        );

        if (!$guruLearn->hasRole('guru')) {
            $guruLearn->assignRole('guru');
        }
        $this->command->info("✅ Guru Learn: guru.learn@rainbow.edu / password123");

        // ============ 5. BUAT GURU HOMELEARNING (1 AKUN) ============
        $guruHome = User::firstOrCreate(
            ['email' => 'guru.home@rainbow.edu'],
            [
                'name' => 'Ibu Rina Andriani',
                'email' => 'guru.home@rainbow.edu',
                'password' => Hash::make('password123'),
                'role_type' => 'guru',
                'guru_type' => 'Homelearning kursus private',
                'is_verified' => true,
                'verified_at' => now(),
            ]
        );

        if (!$guruHome->hasRole('guru')) {
            $guruHome->assignRole('guru');
        }
        $this->command->info("✅ Guru Homelearning: guru.home@rainbow.edu / password123");

        // ============ 6. TAMPILKAN SUMMARY ============
        $this->command->info("\n📊 SUMMARY SEMUA AKUN:");
        $this->command->info("   Admin: admin@rainbowedu.com");
        $this->command->info("   Guru PAUD: guru.paud@rainbow.edu");
        $this->command->info("   Guru Learn: guru.learn@rainbow.edu");
        $this->command->info("   Guru Home: guru.home@rainbow.edu");
        $this->command->info("   Semua password: password123");
        $this->command->info("\n🎉 SEEDER SELESAI!");
    }
}