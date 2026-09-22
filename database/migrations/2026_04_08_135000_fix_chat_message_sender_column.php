<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('chat_messages') || ! Schema::hasColumn('chat_messages', 'sender')) {
            return;
        }

        DB::statement("ALTER TABLE chat_messages MODIFY sender VARCHAR(30) NOT NULL");
    }

    public function down(): void
    {
        if (! Schema::hasTable('chat_messages') || ! Schema::hasColumn('chat_messages', 'sender')) {
            return;
        }

        DB::statement("ALTER TABLE chat_messages MODIFY sender VARCHAR(10) NOT NULL");
    }
};
