<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('leadership_profiles')) {
            return;
        }

        $profile = DB::table('leadership_profiles')
            ->where('slug', 'warek-ii')
            ->first(['content_html']);

        if (! $profile?->content_html) {
            return;
        }

        $content = preg_replace(
            '/\s*<section class="profile-block">\s*<h2>Peran sebagai PPID Utama<\/h2>.*?<\/section>\s*/s',
            "\n",
            $profile->content_html
        );

        DB::table('leadership_profiles')
            ->where('slug', 'warek-ii')
            ->update([
                'content_html' => trim($content),
                'updated_at' => now(),
            ]);
    }

    public function down(): void
    {
        //
    }
};
