<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('prodi', 'content_images')) {
            $afterColumn = Schema::hasColumn('prodi', 'hero_image_position')
                ? 'hero_image_position'
                : 'fakultas_id';

            Schema::table('prodi', function (Blueprint $table) use ($afterColumn) {
                $table->json('content_images')->nullable()->after($afterColumn);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('prodi', 'content_images')) {
            Schema::table('prodi', function (Blueprint $table) {
                $table->dropColumn('content_images');
            });
        }
    }
};
