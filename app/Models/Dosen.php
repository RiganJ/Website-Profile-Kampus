<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $fillable = [

        'nip',

        'nama',

        'jenis_kelamin',

        'pendidikan_terakhir',

        'asal_pendidikan',

        'tanggal_masuk_kerja',

        'jabatan',

        'foto',

        'keterangan'

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

    public function prodi()
    {
        return $this->belongsToMany(Prodi::class, 'dosen_prodi')
            ->withTimestamps()
            ->orderBy('nama_prodi');
    }

}
