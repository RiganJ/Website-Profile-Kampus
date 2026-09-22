<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{

protected $fillable = [

'nama',
'nim',
'prodi_id',
'angkatan',
'jenis_kelamin'

];



public function prodi()
{
return $this->belongsTo(Prodi::class);
}

}