<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kerjasama extends Model
{

    protected $table = 'kerjasama';

    protected $fillable = [
        // simplified fields for cooperation data
        'nama',                 // partner name
        'tahun_mulai',          // year started (YYYY as integer)
        'tahun_berakhir',       // year ended (nullable)
        'kriteria',             // numeric code for category (1=Industri,2=Pemerintahan,3=Pendidikan,4=NGO,5=Lainnya)
        'skala',                // scale (Lokal, Nasional, Internasional)
        'logo',                 // path to uploaded logo (nullable)
        // keep legacy fields for backward compatibility (optional)
        'partner_mou',
        'kriteria_mitra',
    ];

    // Helper mapping for kriteria codes
    public static function kriteriaOptions(): array
    {
        return [
            1 => 'Industri',
            2 => 'Pemerintahan',
            3 => 'Pendidikan',
            4 => 'NGO',
            5 => 'Lainnya',
        ];
    }

    // Helper mapping for skala
    public static function skalaOptions(): array
    {
        return [
            'Lokal' => 'Lokal',
            'Nasional' => 'Nasional',
            'Internasional' => 'Internasional',
        ];
    }

    public function getKriteriaLabelAttribute(): string
    {
        $map = self::kriteriaOptions();
        $key = $this->kriteria ?? $this->kriteria_mitra ?? null;
        return $map[$key] ?? ($this->kriteria_mitra ?: 'Lainnya');
    }


}