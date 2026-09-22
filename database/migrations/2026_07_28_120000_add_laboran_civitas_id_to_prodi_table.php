<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prodi', function (Blueprint $table) {
            $table->unsignedBigInteger('laboran_civitas_id')
                ->nullable()
                ->after('admin_prodi_civitas_id');
            $table->index('laboran_civitas_id');
        });
    }

    public function down(): void
    {
        Schema::table('prodi', function (Blueprint $table) {
            $table->dropIndex(['laboran_civitas_id']);
            $table->dropColumn('laboran_civitas_id');
        });
    }
};
