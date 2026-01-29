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
    Schema::create('siswa_profiles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('siswa_id')
              ->constrained('siswa')
              ->cascadeOnDelete();

        // PROFIL BELAJAR
        $table->enum('gaya_belajar', ['Visual', 'Auditori', 'Kinestetik'])->nullable();
        $table->text('minat_khusus')->nullable();
        $table->set('temperamen', [
            'Berani/Ekspresif',
            'Observatif/Pendiam',
            'Mudah Beradaptasi',
            'Butuh Waktu Adaptasi'
        ])->nullable();

        $table->text('trigger_emosi')->nullable();
        $table->text('strategi_menenangkan')->nullable();

        // DATA KELUARGA
        $table->string('nama_ayah', 100)->nullable();
        $table->string('pekerjaan_ayah', 100)->nullable();
        $table->string('alamat_kantor_ayah', 100)->nullable();
        $table->string('nohp_ayah', 20)->nullable();

        $table->string('nama_ibu', 100)->nullable();
        $table->string('pekerjaan_ibu', 100)->nullable();
        $table->string('alamat_kantor_ibu', 100)->nullable();
        $table->string('nohp_ibu', 20)->nullable();

        $table->enum('decision_maker', ['Ayah', 'Ibu'])->nullable();

        $table->text('saudara_kandung')->nullable();
        $table->text('harapan_ortu')->nullable();

        // KESEHATAN
        $table->text('riwayat_alergi')->nullable();
        $table->text('kondisi_khusus')->nullable();
        $table->string('kontak_darurat', 100)->nullable();

        // MARKETING
        $table->set('sumber_informasi', [
            'WA Broadcast',
            'Instagram',
            'Facebook',
            'Papan Nama',
            'Rekomendasi Teman',
            'Lainnya'
        ])->nullable();

        $table->enum('consent_konten', ['Ya', 'Tidak'])->default('Tidak');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_profiles');
    }
};
