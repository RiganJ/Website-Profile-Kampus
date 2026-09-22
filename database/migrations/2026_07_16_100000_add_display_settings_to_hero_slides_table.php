<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            if (! Schema::hasColumn('hero_slides', 'media_fit')) {
                $table->string('media_fit', 20)->default('cover')->after('media_type');
            }

            if (! Schema::hasColumn('hero_slides', 'media_position')) {
                $table->string('media_position', 30)->default('center center')->after('media_fit');
            }
        });
    }

    public function down(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            if (Schema::hasColumn('hero_slides', 'media_position')) {
                $table->dropColumn('media_position');
            }

            if (Schema::hasColumn('hero_slides', 'media_fit')) {
                $table->dropColumn('media_fit');
            }
        });
    }
};
