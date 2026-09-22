<?php

namespace App\Http\Controllers\Admin;

use App\Support\AdminTable;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{

public function index()
{

$beasiswas = AdminTable::paginate(Beasiswa::latest(), ['nama_mahasiswa', 'jenis_beasiswa', 'prodi', 'tahun'], 'beasiswas', 10);

return view(
'admin.beasiswa.index',
compact('beasiswas')
);

}



public function create()
{

return view('admin.beasiswa.create');

}



public function store(Request $request)
{

Beasiswa::create([

'nama_beasiswa' => $request->nama_beasiswa,
'penyelenggara' => $request->penyelenggara,
'jenis_beasiswa' => $request->jenis_beasiswa,
'periode' => $request->periode,
'kuota' => $request->kuota,
'keterangan' => $request->keterangan

]);

return redirect('/admin/beasiswa')
->with('success','Data berhasil ditambahkan');

}



public function edit($id)
{

$beasiswa = Beasiswa::findOrFail($id);

return view(
'admin.beasiswa.edit',
compact('beasiswa')
);

}



public function update(Request $request,$id)
{

$beasiswa = Beasiswa::findOrFail($id);

$beasiswa->update([

'nama_beasiswa' => $request->nama_beasiswa,
'penyelenggara' => $request->penyelenggara,
'jenis_beasiswa' => $request->jenis_beasiswa,
'periode' => $request->periode,
'kuota' => $request->kuota,
'keterangan' => $request->keterangan

]);

return redirect('/admin/beasiswa')
->with('success','Data berhasil diupdate');

}



public function destroy($id)
{

Beasiswa::destroy($id);

return back()
->with('success','Data berhasil dihapus');

}

}