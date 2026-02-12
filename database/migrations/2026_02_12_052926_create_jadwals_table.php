<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('guru_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('siswa_id')
                  ->constrained('siswa') // FIX DI SINI
                  ->onDelete('cascade');

            $table->foreignId('orang_tua_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->date('tanggal');
            $table->time('waktu');
            $table->integer('durasi')->default(60);
            $table->text('catatan')->nullable();

            $table->enum('status', [
                'pending',
                'disetujui',
                'selesai',
                'dibatalkan'
            ])->default('pending');

            $table->text('feedback_ortu')->nullable();
            $table->text('feedback_guru')->nullable();

            $table->timestamps();

            $table->index(['guru_id', 'tanggal']);
            $table->index(['siswa_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
