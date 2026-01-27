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

        $table->string('nama_lengkap', 100);
        $table->string('nama_panggilan', 50)->nullable();

        $table->string('tempat_lahir', 50)->nullable();
        $table->date('tanggal_lahir')->nullable();
        $table->enum('gender', ['Laki-laki', 'Perempuan']);
        $table->string('agama', 20)->nullable();
        $table->string('bahasa_sehari_hari', 50)->nullable();

        $table->text('alamat_domisili')->nullable();

        $table->enum('status_pendaftaran', ['Baru', 'Pindahan'])->default('Baru');
        $table->string('asal_cabang', 50)->nullable();

        $table->set('layanan', [
            'PAUD Rainbow',
            'Permata Montessori',
            'Rainbow Course',
            'Rainbow Home Learning'
        ])->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
