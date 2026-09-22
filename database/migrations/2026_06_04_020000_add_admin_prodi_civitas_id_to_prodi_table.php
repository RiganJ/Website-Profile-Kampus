<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prodi', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_prodi_civitas_id')->nullable()->after('kaprodi_dosen_id');
            $table->index('admin_prodi_civitas_id');
        });
    }

    public function down(): void
    {
        Schema::table('prodi', function (Blueprint $table) {
            $table->dropIndex(['admin_prodi_civitas_id']);
            $table->dropColumn('admin_prodi_civitas_id');
        });
    }
};
