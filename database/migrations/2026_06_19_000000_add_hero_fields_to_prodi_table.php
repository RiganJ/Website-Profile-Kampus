<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $afterColumn = Schema::hasColumn('prodi', 'admin_prodi_civitas_id')
            ? 'admin_prodi_civitas_id'
            : 'fakultas_id';

        if (! Schema::hasColumn('prodi', 'hero_title')) {
            Schema::table('prodi', function (Blueprint $table) use ($afterColumn) {
                $table->string('hero_title')->nullable()->after($afterColumn);
            });
        }

        if (! Schema::hasColumn('prodi', 'hero_subtitle')) {
            Schema::table('prodi', function (Blueprint $table) {
                $table->text('hero_subtitle')->nullable()->after('hero_title');
            });
        }

        if (! Schema::hasColumn('prodi', 'hero_image')) {
            Schema::table('prodi', function (Blueprint $table) {
                $table->string('hero_image')->nullable()->after('hero_subtitle');
            });
        }

        if (! Schema::hasColumn('prodi', 'hero_image_position')) {
            Schema::table('prodi', function (Blueprint $table) {
                $table->string('hero_image_position')->nullable()->after('hero_image');
            });
        }
    }

    public function down(): void
    {
        foreach (['hero_image_position', 'hero_image', 'hero_subtitle', 'hero_title'] as $column) {
            if (Schema::hasColumn('prodi', $column)) {
                Schema::table('prodi', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
