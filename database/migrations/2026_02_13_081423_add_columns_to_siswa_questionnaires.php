<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswa_questionnaires', function (Blueprint $table) {
            if (!Schema::hasColumn('siswa_questionnaires', 'minat_bakat')) {
                $table->text('minat_bakat')->nullable()->after('ekspektasi_ortu');
            }
            if (!Schema::hasColumn('siswa_questionnaires', 'catatan_kesehatan')) {
                $table->text('catatan_kesehatan')->nullable()->after('minat_bakat');
            }
        });
    }

    public function down(): void
    {
        Schema::table('siswa_questionnaires', function (Blueprint $table) {
            $table->dropColumn(['minat_bakat', 'catatan_kesehatan']);
        });
    }
};