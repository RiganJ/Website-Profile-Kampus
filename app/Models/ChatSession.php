<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    protected $fillable = [
        'visitor_name',
        'visitor_email',
        'visitor_phone',
        'source',
        'subject',
        'status',
        'queue_position',
        'admin_user_id',
        'unread_admin_count',
        'unread_visitor_count',
        'last_message_at',
        'started_at',
        'ended_at',
        'notified_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'notified_at' => 'datetime',
    ];

    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'session_id');
    }

    public function adminUser()
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }

    public function latestMessage()
    {
        return $this->hasOne(ChatMessage::class, 'session_id')->latestOfMany();
    }

    public function scopeWaiting(Builder $query): Builder
    {
        return $query->where('status', 'waiting');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    public function scopeOpen(Builder $query): Builder
    {
        return $query->whereIn('status', ['waiting', 'active']);
    }
}
