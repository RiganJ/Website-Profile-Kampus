<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leadership_profiles', function (Blueprint $table) {
            if (! Schema::hasColumn('leadership_profiles', 'content_data')) {
                $table->json('content_data')->nullable()->after('content_html');
            }
        });
    }

    public function down(): void
    {
        Schema::table('leadership_profiles', function (Blueprint $table) {
            if (Schema::hasColumn('leadership_profiles', 'content_data')) {
                $table->dropColumn('content_data');
            }
        });
    }
};
