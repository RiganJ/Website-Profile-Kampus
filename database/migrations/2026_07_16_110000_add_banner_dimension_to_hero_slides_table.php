<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            if (! Schema::hasColumn('hero_slides', 'banner_dimension')) {
                $table->string('banner_dimension', 20)->default('compact')->after('media_position');
            }
        });

        DB::table('hero_slides')
            ->update([
                'media_fit' => 'fill',
                'banner_dimension' => 'compact',
            ]);
    }

    public function down(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            if (Schema::hasColumn('hero_slides', 'banner_dimension')) {
                $table->dropColumn('banner_dimension');
            }
        });
    }
};
