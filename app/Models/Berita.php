<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    public const KATEGORI_BERITA_TERKINI = 'berita terkini';
    public const KATEGORI_PRESTASI_TERBARU = 'prestasi terbaru';
    public const KATEGORI_RISET_UNGGULAN = 'riset unggulan';

    public const KATEGORI_OPTIONS = [
        self::KATEGORI_BERITA_TERKINI => 'Berita Terkini',
        self::KATEGORI_PRESTASI_TERBARU => 'Prestasi Terbaru',
        self::KATEGORI_RISET_UNGGULAN => 'Riset Unggulan',
    ];

    protected $table = 'berita';


    protected $fillable = [

        'judul',
        'slug',
        'thumbnail',
        'gallery_images',
        'kategori',
        'konten',
        'attachments',
        'tanggal'

    ];

    protected $casts = [
        'gallery_images' => 'array',
        'attachments' => 'array',
    ];

    protected $appends = [
        'thumbnail_url',
    ];

    public function getThumbnailUrlAttribute(): string
    {
        if (! $this->thumbnail) {
            return asset('images/news1.jpg');
        }

        if (Str::startsWith($this->thumbnail, ['berita/', 'berita\\'])) {
            return asset('storage/' . str_replace('\\', '/', $this->thumbnail));
        }

        return asset('images/' . basename($this->thumbnail));
    }
}
