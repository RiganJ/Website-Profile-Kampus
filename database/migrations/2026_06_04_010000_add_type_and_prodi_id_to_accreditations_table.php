<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('accreditations', function (Blueprint $table) {
            $table->string('accreditation_type')->default('program_studi')->after('id');
            $table->unsignedBigInteger('prodi_id')->nullable()->after('accreditation_type');
            $table->index('prodi_id');
        });
    }

    public function down(): void
    {
        Schema::table('accreditations', function (Blueprint $table) {
            $table->dropIndex(['prodi_id']);
            $table->dropColumn(['accreditation_type', 'prodi_id']);
        });
    }
};
