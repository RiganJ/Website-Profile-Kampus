<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{

protected $table = 'beasiswas';

protected $fillable = [

'nama_mahasiswa',
'jenis_beasiswa',
'prodi',
'angkatan',
'tahun'

];

}