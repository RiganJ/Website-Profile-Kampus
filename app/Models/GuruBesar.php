<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruBesar extends Model
{

    protected $table = 'guru_besars';


    protected $fillable = [

        'nama',
        'bidang_keahlian',
        'tahun_pengangkatan',
        'foto'

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
