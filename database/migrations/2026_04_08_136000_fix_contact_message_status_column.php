<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('contact_messages') || ! Schema::hasColumn('contact_messages', 'status')) {
            return;
        }

        DB::statement("ALTER TABLE contact_messages MODIFY status VARCHAR(30) NULL DEFAULT 'new'");
    }

    public function down(): void
    {
        if (! Schema::hasTable('contact_messages') || ! Schema::hasColumn('contact_messages', 'status')) {
            return;
        }

        DB::statement("ALTER TABLE contact_messages MODIFY status VARCHAR(30) NULL DEFAULT 'unread'");
    }
};
