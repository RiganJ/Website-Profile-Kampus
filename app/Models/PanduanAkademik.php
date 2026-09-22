<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanduanAkademik extends Model
{
    protected $table = 'panduan_akademik';

    protected $fillable = [
        'judul',
        'kategori',
        'deskripsi',
        'file',
        'is_active',
        'published_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected $appends = [
        'file_url',
        'download_url',
    ];

    public const KATEGORI_OPTIONS = [
        'panduan_akademik' => 'Panduan Akademik UFDK',
        'panduan_aplikasi' => 'Panduan Aplikasi UFDK',
        'yudisium_wisuda' => 'Form Yudisium & Wisuda',
    ];

    public function getKategoriLabelAttribute(): string
    {
        return self::KATEGORI_OPTIONS[$this->kategori] ?? self::KATEGORI_OPTIONS['panduan_akademik'];
    }

    public function getFileUrlAttribute(): ?string
    {
        if (! $this->file) {
            return null;
        }

        return route('panduan-akademik.file', $this);
    }

    public function getDownloadUrlAttribute(): ?string
    {
        if (! $this->file) {
            return null;
        }

        return route('panduan-akademik.download', $this);
    }
}
