<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';

    public const NAMA_PRODI_OPTIONS = [
        'S2 Kesehatan Masyarakat',
        'Profesi Ners',
        'Profesi Bidan',
        'S1 Kesehatan Masyarakat',
        'S1 Keperawatan',
        'S1 Kebidanan',
        'S1 Farmasi',
        'S1 Psikologi',
        'S1 Fisioterapi',
        'S1 Bisnis Digital',
        'S1 Kewirausahaan',
        'S1 Desain Komunikasi Visual',
        'S1 Hukum',
        'S1 Pariwisata',
        'D3 Fisioterapi',
    ];

    protected $fillable = [
        'nama_prodi',
        'kode_prodi',
        'fakultas_id',
        'nama_kaprodi',
        'foto_kaprodi',
        'kaprodi_dosen_id',
        'admin_prodi_civitas_id',
        'laboran_civitas_id',
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'hero_image_position',
        'content_images',
    ];

    protected $casts = [
        'content_images' => 'array',
    ];

    protected $appends = [
        'foto_kaprodi_url',
        'hero_image_url',
    ];

    public function getFotoKaprodiUrlAttribute(): ?string
    {
        if (! $this->foto_kaprodi) {
            return null;
        }

        return asset('images/' . basename($this->foto_kaprodi));
    }

    public function getHeroImageUrlAttribute(): ?string
    {
        if (! $this->hero_image) {
            return null;
        }

        return asset('images/' . basename($this->hero_image));
    }

    public function contentImageUrl(string $key, ?string $defaultImage = null): ?string
    {
        $images = $this->content_images ?? [];
        $image = $this->contentImageFilename($key);

        if ($image) {
            return asset('images/' . basename($image));
        }

        if ($defaultImage) {
            return asset('images/' . basename($defaultImage));
        }

        return null;
    }

    public function contentImageFilename(string $key): ?string
    {
        $images = $this->content_images ?? [];
        $image = $images[$key] ?? null;

        if (is_array($image)) {
            return $image['file'] ?? $image['path'] ?? null;
        }

        return $image;
    }

    public function contentImageSettings(string $key): array
    {
        $images = $this->content_images ?? [];
        $image = $images[$key] ?? [];
        $settings = is_array($image) ? ($image['settings'] ?? []) : [];
        $defaults = $this->contentImageDefaultSettings($key);
        $usesOldLandscapeDefault = $key === 'visi_misi'
            && (int) ($settings['width'] ?? 0) === 900
            && (int) ($settings['height'] ?? 0) === 620;

        if ($usesOldLandscapeDefault) {
            $settings = [];
        }

        return [
            'width' => (int) ($settings['width'] ?? $defaults['width']),
            'height' => (int) ($settings['height'] ?? $defaults['height']),
            'fit' => $settings['fit'] ?? $defaults['fit'],
            'remove_background' => (bool) ($settings['remove_background'] ?? false),
            'background_tolerance' => (int) ($settings['background_tolerance'] ?? 42),
        ];
    }

    private function contentImageDefaultSettings(string $key): array
    {
        return match ($key) {
            'visi_misi' => ['width' => 720, 'height' => 1120, 'fit' => 'contain'],
            'fokus_pembelajaran', 'profil_lulusan' => ['width' => 820, 'height' => 980, 'fit' => 'contain'],
            default => ['width' => 900, 'height' => 620, 'fit' => 'cover'],
        };
    }

    public static function namaProdiOptions(): array
    {
        return self::NAMA_PRODI_OPTIONS;
    }


    /*
    |--------------------------------------------------------------------------
    | Relasi (optional tapi disiapkan dari sekarang)
    |--------------------------------------------------------------------------
    */

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'dosen_prodi')
            ->withTimestamps()
            ->orderBy('nama');
    }

    public function kaprodiDosen()
    {
        return $this->belongsTo(Dosen::class, 'kaprodi_dosen_id');
    }

    public function adminProdi()
    {
        return $this->belongsTo(Civitas::class, 'admin_prodi_civitas_id');
    }

    public function laboran()
    {
        return $this->belongsTo(Civitas::class, 'laboran_civitas_id');
    }

    public function laborans()
    {
        return $this->belongsToMany(Civitas::class, 'prodi_laboran', 'prodi_id', 'civitas_id')
            ->withTimestamps()
            ->orderBy('nama');
    }


    // relasi ke mahasiswa
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }
}
