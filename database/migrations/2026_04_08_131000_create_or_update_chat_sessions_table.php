<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('chat_sessions')) {
            Schema::create('chat_sessions', function (Blueprint $table) {
                $table->id();
                $table->string('visitor_name');
                $table->string('visitor_email')->nullable();
                $table->string('visitor_phone')->nullable();
                $table->string('source')->default('live_chat');
                $table->string('subject')->nullable();
                $table->string('status')->default('waiting');
                $table->unsignedInteger('queue_position')->nullable();
                $table->unsignedBigInteger('admin_user_id')->nullable();
                $table->unsignedInteger('unread_admin_count')->default(0);
                $table->unsignedInteger('unread_visitor_count')->default(0);
                $table->timestamp('last_message_at')->nullable();
                $table->timestamp('started_at')->nullable();
                $table->timestamp('ended_at')->nullable();
                $table->timestamp('notified_at')->nullable();
                $table->timestamps();
            });

            return;
        }

        Schema::table('chat_sessions', function (Blueprint $table) {
            $columns = [
                'visitor_phone' => fn () => $table->string('visitor_phone')->nullable()->after('visitor_email'),
                'source' => fn () => $table->string('source')->default('live_chat')->after('visitor_phone'),
                'subject' => fn () => $table->string('subject')->nullable()->after('source'),
                'queue_position' => fn () => $table->unsignedInteger('queue_position')->nullable()->after('status'),
                'admin_user_id' => fn () => $table->unsignedBigInteger('admin_user_id')->nullable()->after('queue_position'),
                'unread_admin_count' => fn () => $table->unsignedInteger('unread_admin_count')->default(0)->after('admin_user_id'),
                'unread_visitor_count' => fn () => $table->unsignedInteger('unread_visitor_count')->default(0)->after('unread_admin_count'),
                'last_message_at' => fn () => $table->timestamp('last_message_at')->nullable()->after('unread_visitor_count'),
                'started_at' => fn () => $table->timestamp('started_at')->nullable()->after('last_message_at'),
                'ended_at' => fn () => $table->timestamp('ended_at')->nullable()->after('started_at'),
                'notified_at' => fn () => $table->timestamp('notified_at')->nullable()->after('ended_at'),
            ];

            foreach ($columns as $column => $definition) {
                if (! Schema::hasColumn('chat_sessions', $column)) {
                    $definition();
                }
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('chat_sessions')) {
            return;
        }

        Schema::table('chat_sessions', function (Blueprint $table) {
            foreach ([
                'visitor_phone',
                'source',
                'subject',
                'queue_position',
                'admin_user_id',
                'unread_admin_count',
                'unread_visitor_count',
                'last_message_at',
                'started_at',
                'ended_at',
                'notified_at',
            ] as $column) {
                if (Schema::hasColumn('chat_sessions', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
