<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('address')->nullable()->after('phone');
            $table->date('birth_date')->nullable()->after('address');
            $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable()->after('birth_date');
            $table->string('avatar')->nullable()->after('gender');
            $table->string('last_login_ip')->nullable()->after('last_login');
            $table->string('created_by')->nullable()->after('last_login_ip');
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'address', 'birth_date', 'gender', 'avatar', 'last_login_ip', 'created_by']);
            $table->dropSoftDeletes();
        });
    }
};