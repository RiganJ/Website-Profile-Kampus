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
                if (! Schema::hasColumn('kerjasama', 'nama')) {
                    $table->string('nama')->nullable()->after('id');
                }
                if (! Schema::hasColumn('kerjasama', 'tahun_mulai')) {
                    $table->integer('tahun_mulai')->nullable()->after('nama');
                }
                if (! Schema::hasColumn('kerjasama', 'tahun_berakhir')) {
                    $table->integer('tahun_berakhir')->nullable()->after('tahun_mulai');
                }
                if (! Schema::hasColumn('kerjasama', 'kriteria')) {
                    $table->tinyInteger('kriteria')->nullable()->default(5)->after('tahun_berakhir');
                }
                if (! Schema::hasColumn('kerjasama', 'logo')) {
                    $table->string('logo')->nullable()->after('kriteria');
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
                if (Schema::hasColumn('kerjasama', 'logo')) {
                    $table->dropColumn('logo');
                }
                if (Schema::hasColumn('kerjasama', 'kriteria')) {
                    $table->dropColumn('kriteria');
                }
                if (Schema::hasColumn('kerjasama', 'tahun_berakhir')) {
                    $table->dropColumn('tahun_berakhir');
                }
                if (Schema::hasColumn('kerjasama', 'tahun_mulai')) {
                    $table->dropColumn('tahun_mulai');
                }
                if (Schema::hasColumn('kerjasama', 'nama')) {
                    $table->dropColumn('nama');
                }
            });
        }
    }
};
