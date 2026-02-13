<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // HAPUS KOLOM LAYANAN LAMA
        if (Schema::hasColumn('siswa', 'layanan')) {
            DB::statement('ALTER TABLE siswa DROP COLUMN layanan');
        }

        // TAMBAHKAN KOLOM BARU DENGAN 3 PILIHAN
        Schema::table('siswa', function (Blueprint $table) {
            $table->enum('layanan', [
                'PAUD',
                'Rainbow Course',
                'Rainbow Home Learning'
            ])->nullable()->after('asal_cabang');
        });
    }

    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn('layanan');
        });
    }
};