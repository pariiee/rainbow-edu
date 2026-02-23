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
        Schema::table('jadwals', function (Blueprint $table) {
            $table->boolean('is_pengajuan_pengganti')->default(false)->after('status');
            $table->date('tanggal_pengganti')->nullable()->after('is_pengajuan_pengganti');
            $table->time('waktu_pengganti')->nullable()->after('tanggal_pengganti');
            $table->text('alasan_pengganti')->nullable()->after('waktu_pengganti');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropColumn([
                'is_pengajuan_pengganti',
                'tanggal_pengganti',
                'waktu_pengganti',
                'alasan_pengganti'
            ]);
        });
    }
};
