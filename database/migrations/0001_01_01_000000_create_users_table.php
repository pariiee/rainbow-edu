<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // === BASIC AUTH (Breeze) ===
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(); // STANDAR LARAVEL
            $table->string('password');

            // === ROLE DOMAIN (custom, non-spatie) ===
            $table->enum('role_type', ['admin', 'orang_tua', 'guru'])->default('orang_tua');
            $table->enum('guru_type', [
                'PAUD', 
                'Learn kursus', 
                'Homelearning kursus private'
            ])->nullable();
            
            // UNTUK ORANG TUA - NAMA ANAK
            $table->string('nama_anak', 100)->nullable()->comment('Nama anak untuk orang tua');

            // === DATA TAMBAHAN UNTUK ADMIN ===
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('avatar')->nullable();

            // === OTP ===
            $table->string('otp')->nullable();              // hashed OTP
            $table->string('otp_plain', 6)->nullable();     // ⚠️ opsional (dev only)
            $table->dateTime('otp_expiry')->nullable();
            $table->unsignedTinyInteger('otp_attempt')->default(0);
            $table->dateTime('otp_cooldown')->nullable();

            // === PASSWORD RESET (custom) ===
            $table->string('reset_token')->nullable()->index();
            $table->dateTime('reset_token_expiry')->nullable();
            $table->unsignedTinyInteger('reset_attempt')->default(0);

            // === VERIFICATION ===
            $table->boolean('is_verified')->default(false);
            $table->dateTime('verified_at')->nullable();

            // === META ===
            $table->dateTime('last_login')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->string('created_by')->nullable();
            $table->rememberToken();
            $table->softDeletes(); // TAMBAHKAN SOFT DELETE
            $table->timestamps();

            // Indexes
            $table->index(['is_verified', 'created_at']);
            $table->index(['role_type', 'guru_type']);
            $table->index(['email', 'deleted_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};