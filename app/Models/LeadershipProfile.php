<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LeadershipProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'position',
        'photo_path',
        'email',
        'phone',
        'summary',
        'content_html',
        'content_data',
        'academic_links',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'academic_links' => 'array',
        'content_data' => 'array',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function getPhotoUrlAttribute(): string
    {
        if (! $this->photo_path) {
            return asset('images/rektor.jpg');
        }

        if (Str::startsWith($this->photo_path, ['http://', 'https://'])) {
            return $this->photo_path;
        }

        if (Str::startsWith($this->photo_path, '/')) {
            return url($this->photo_path);
        }

        return asset($this->photo_path);
    }

    public function getAcademicLinkItemsAttribute(): array
    {
        $links = $this->academic_links ?: [];

        return collect([
            'scopus' => ['label' => 'Scopus', 'icon' => 'database'],
            'sinta' => ['label' => 'SINTA', 'icon' => 'award'],
            'google_scholar' => ['label' => 'Google Scholar', 'icon' => 'graduation-cap'],
            'orcid' => ['label' => 'ORCID', 'icon' => 'fingerprint'],
        ])
            ->map(fn (array $meta, string $key) => [
                'key' => $key,
                'label' => $meta['label'],
                'icon' => $meta['icon'],
                'url' => $links[$key] ?? null,
            ])
            ->filter(fn (array $item) => filled($item['url']))
            ->values()
            ->all();
    }
}
