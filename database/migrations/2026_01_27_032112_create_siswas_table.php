<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();

            // === DATA PRIBADI ===
            $table->string('nama_lengkap', 100);
            $table->string('nama_panggilan', 50)->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('gender', ['Laki-laki', 'Perempuan'])->default('Laki-laki');
            $table->string('agama', 20)->nullable();
            $table->string('bahasa_sehari_hari', 50)->nullable();
            $table->text('alamat_domisili')->nullable();

            // === PENDAFTARAN ===
            $table->enum('status_pendaftaran', ['Baru', 'Pindahan'])->default('Baru');
            $table->string('asal_cabang', 50)->nullable();
            
            // ============ 3 LAYANAN ============
            $table->enum('layanan', [
                'PAUD',              // GABUNGAN PAUD Rainbow & Permata Montessori
                'Rainbow Course',    // TETAP
                'Rainbow Home Learning' // TETAP
            ])->nullable();
            
            // === RELASI DENGAN GURU DAN ORANG TUA ===
            $table->foreignId('guru_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('orang_tua_id')->nullable()->constrained('users')->nullOnDelete();
            
            // === STATUS ASSIGN ===
            $table->enum('status_assign', ['pending', 'active', 'completed'])->default('pending');
            
            // === KOLOM TAMBAHAN ===
            $table->string('foto')->nullable();
            $table->text('catatan_khusus')->nullable();

            $table->timestamps();
            
            // INDEX
            $table->index(['guru_id', 'status_assign']);
            $table->index(['orang_tua_id', 'layanan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};