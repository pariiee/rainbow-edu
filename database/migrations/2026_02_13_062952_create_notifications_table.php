<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->enum('target', ['semua', 'guru', 'orang_tua', 'siswa']);
            $table->json('target_ids')->nullable(); // Untuk broadcast spesifik
            $table->foreignId('created_by')->constrained('users');
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->enum('status', ['draft', 'terjadwal', 'terkirim'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};