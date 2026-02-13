<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();

            $table->foreignId('siswa_id')
                  ->constrained('siswa') // FIX DI SINI
                  ->onDelete('cascade');

            $table->foreignId('pengirim_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('penerima_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->text('pesan');
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();

            $table->timestamps();

            $table->index(['pengirim_id', 'penerima_id']);
            $table->index(['siswa_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
