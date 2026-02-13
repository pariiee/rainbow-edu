<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa_questionnaires', function (Blueprint $table) {
            $table->id();

            // FIX DI SINI (tabel siswa singular)
            $table->foreignId('siswa_id')
                  ->constrained('siswa')
                  ->cascadeOnDelete();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->string('sekolah_sebelumnya')->nullable();
            $table->integer('usia_anak')->nullable();
            $table->text('tujuan_pendaftaran')->nullable();
            $table->enum('tingkat_kemandirian', [
                'Mandiri',
                'Butuh Bantuan',
                'Sangat Butuh Bantuan'
            ])->nullable();

            $table->text('ekspektasi_ortu')->nullable();
            $table->boolean('is_skipped')->default(false);
            $table->timestamp('skipped_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa_questionnaires');
    }
};
