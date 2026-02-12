<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->foreignId('guru_id')
                  ->nullable()
                  ->after('layanan')
                  ->constrained('users')
                  ->nullOnDelete();
            $table->foreignId('orang_tua_id')
                  ->nullable()
                  ->after('guru_id')
                  ->constrained('users')
                  ->nullOnDelete();
            $table->enum('status_assign', ['pending', 'active', 'completed'])
                  ->default('pending')
                  ->after('orang_tua_id');
        });
    }

    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropForeign(['guru_id']);
            $table->dropForeign(['orang_tua_id']);
            $table->dropColumn(['guru_id', 'orang_tua_id', 'status_assign']);
        });
    }
};