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
        if (Schema::hasTable('kerjasama')) {
            Schema::table('kerjasama', function (Blueprint $table) {
                if (! Schema::hasColumn('kerjasama', 'skala')) {
                    $table->string('skala')->nullable()->default('Nasional')->after('kriteria');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('kerjasama')) {
            Schema::table('kerjasama', function (Blueprint $table) {
                if (Schema::hasColumn('kerjasama', 'skala')) {
                    $table->dropColumn('skala');
                }
            });
        }
    }
};
