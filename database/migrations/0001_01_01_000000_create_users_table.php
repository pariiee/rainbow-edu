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

            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            // === ROLE DOMAIN (bukan Spatie role) ===
            $table->enum('role_type', ['orang_tua', 'guru'])->default('orang_tua');
            $table->string('id_guru', 5)->nullable()->comment('ID 5 digit untuk guru');
            $table->string('nama_anak')->nullable()->comment('Nama anak untuk orang tua');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};