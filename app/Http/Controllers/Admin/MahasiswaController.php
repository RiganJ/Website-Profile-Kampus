<?php

namespace App\Http\Controllers\Admin;

use App\Support\AdminTable;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{


public function index()
{

$mahasiswa = AdminTable::paginate(Mahasiswa::with('prodi')
->latest(), ['nama', 'nim', 'angkatan', 'prodi.nama_prodi'], 'mahasiswa', 10);

return view('admin.mahasiswa.index', compact('mahasiswa'));

}



public function create()
{

$prodi = Prodi::all();

return view('admin.mahasiswa.create', compact('prodi'));

}



public function store(Request $request)
{

$request->validate([

'nama'=>'required',

'nim'=>'required|unique:mahasiswas',

'prodi_id'=>'required',

'angkatan'=>'required',

'jenis_kelamin'=>'required'

]);



Mahasiswa::create([

'nama'=>$request->nama,

'nim'=>$request->nim,

'prodi_id'=>$request->prodi_id,

'angkatan'=>$request->angkatan,

'jenis_kelamin'=>$request->jenis_kelamin

]);



return redirect('/admin/mahasiswa')
->with('success','Data berhasil ditambah');

}



public function edit($id)
{

$mhs = Mahasiswa::findOrFail($id);

$prodi = Prodi::all();

return view('admin.mahasiswa.edit', compact('mhs','prodi'));

}



public function update(Request $request,$id)
{

$request->validate([

'nama'=>'required',

'nim'=>"required|unique:mahasiswas,nim,$id",

'prodi_id'=>'required',

'angkatan'=>'required',

'jenis_kelamin'=>'required'

]);



$mhs = Mahasiswa::findOrFail($id);



$mhs->update([

'nama'=>$request->nama,

'nim'=>$request->nim,

'prodi_id'=>$request->prodi_id,

'angkatan'=>$request->angkatan,

'jenis_kelamin'=>$request->jenis_kelamin

]);



return redirect('/admin/mahasiswa')
->with('success','Data berhasil diupdate');

}



public function destroy($id)
{

Mahasiswa::destroy($id);

return back()->with('success','Data berhasil dihapus');

}


}