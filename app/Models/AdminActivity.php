<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminActivity extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'role',
        'module',
        'action',
        'description',
        'method',
        'path',
        'ip_address',
        'user_agent',
        'performed_at',
    ];

    protected $casts = [
        'performed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
