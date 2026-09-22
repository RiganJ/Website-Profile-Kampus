<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HeroSlide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'media_path',
        'media_type',
        'media_fit',
        'media_position',
        'banner_dimension',
        'sort_order',
        'is_active'
    ];

    protected $attributes = [
        'media_fit' => 'fill',
        'media_position' => 'center center',
        'banner_dimension' => 'compact',
        'sort_order' => 0,
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getMediaUrlAttribute()
    {
        if (! $this->media_path) {
            return null;
        }

        if (Str::startsWith($this->media_path, ['http://', 'https://'])) {
            return $this->media_path;
        }

        if (Str::startsWith($this->media_path, '/')) {
            return asset(ltrim($this->media_path, '/'));
        }

        if (Str::startsWith($this->media_path, 'storage/')) {
            return asset($this->media_path);
        }

        if (Str::startsWith($this->media_path, 'images/')) {
            return asset($this->media_path);
        }

        if (Str::startsWith($this->media_path, 'banner/')) {
            return route('banner.file', ['slide' => $this->getKey()]);
        }

        return asset($this->media_path);
    }
}
