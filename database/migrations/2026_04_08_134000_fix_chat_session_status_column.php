<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('chat_sessions') || ! Schema::hasColumn('chat_sessions', 'status')) {
            return;
        }

        DB::statement("ALTER TABLE chat_sessions MODIFY status VARCHAR(50) NOT NULL DEFAULT 'waiting'");
    }

    public function down(): void
    {
        if (! Schema::hasTable('chat_sessions') || ! Schema::hasColumn('chat_sessions', 'status')) {
            return;
        }

        DB::statement("ALTER TABLE chat_sessions MODIFY status VARCHAR(20) NOT NULL DEFAULT 'waiting'");
    }
};
