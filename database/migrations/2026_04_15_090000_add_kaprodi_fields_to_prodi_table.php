<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prodi', function (Blueprint $table) {
            $table->string('nama_kaprodi')->nullable()->after('nama_prodi');
            $table->string('foto_kaprodi')->nullable()->after('nama_kaprodi');
        });
    }

    public function down(): void
    {
        Schema::table('prodi', function (Blueprint $table) {
            $table->dropColumn(['nama_kaprodi', 'foto_kaprodi']);
        });
    }
};
