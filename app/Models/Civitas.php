<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Civitas extends Model
{
    protected $table = 'civitas';

    protected $fillable = [
        'nip',
        'nama',
        'jenis_kelamin',
        'pendidikan_terakhir',
        'asal_pendidikan',
        'tanggal_masuk_kerja',
        'jabatan',
        'keterangan',
        'unit',
        'foto',
    ];

    protected $appends = [
        'foto_url',
    ];

    public function getFotoUrlAttribute(): ?string
    {
        if (! $this->foto) {
            return null;
        }

        return asset('images/' . basename($this->foto));
    }
}
