<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('siswa_berkas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa')
                  ->constrained('siswa')
                  ->onDelete('cascade');

            $table->string('nama_berkas')->nullable();
            $table->string('file_path');
            $table->text('keterangan')->nullable();
            $table->timestamp('uploaded_at')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswa_berkas');
    }
};
