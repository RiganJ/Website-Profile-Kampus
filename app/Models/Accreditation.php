<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accreditation extends Model
{

    protected $table = 'accreditations';

    protected $fillable = [

        'accreditation_type',
        'prodi_id',
        'program_studi',
        'predicate',
        'tahun',
        'lembaga',
        'nomor_sk',
        'tanggal_sk',
        'tanggal_kadaluarsa',
        'file'

    ];

    protected $appends = [
        'file_url',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function getFileUrlAttribute(): ?string
    {
        if (! $this->file) {
            return null;
        }

        return route('akreditasi.file', $this);
    }

    public function getIsInstitutionAttribute(): bool
    {
        return $this->accreditation_type === 'institusi';
    }

}
