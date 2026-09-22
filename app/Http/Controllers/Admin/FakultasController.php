<?php

namespace App\Http\Controllers\Admin;

use App\Support\AdminTable;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{

    public function index()
    {
        $fakultas = AdminTable::paginate(Fakultas::latest(), ['nama_fakultas', 'kode_fakultas', 'dekan'], 'fakultas', 10);

        return view(
            'admin.fakultas.index',
            compact('fakultas')
        );
    }



    public function create()
    {
        return view(
            'admin.fakultas.create'
        );
    }



    public function store(Request $request)
    {
        $request->validate([

            'kode_fakultas' => 'required',
            'nama_fakultas' => 'required',
            'dekan' => 'required',

        ]);



        Fakultas::create([

            'kode_fakultas' => $request->kode_fakultas,
            'nama_fakultas' => $request->nama_fakultas,
            'dekan' => $request->dekan,

        ]);



        return redirect('/admin/fakultas')
                ->with('success','Data berhasil disimpan');
    }



    public function edit($id)
    {
        $fakultas = Fakultas::findOrFail($id);

        return view(
            'admin.fakultas.edit',
            compact('fakultas')
        );
    }



    public function update(Request $request, $id)
    {
        $request->validate([

            'kode_fakultas' => 'required',
            'nama_fakultas' => 'required',
            'dekan' => 'required',

        ]);



        $fakultas = Fakultas::findOrFail($id);



        $fakultas->update([

            'kode_fakultas' => $request->kode_fakultas,
            'nama_fakultas' => $request->nama_fakultas,
            'dekan' => $request->dekan,

        ]);



        return redirect('/admin/fakultas')
                ->with('success','Data berhasil diupdate');
    }



    public function destroy($id)
    {
        $fakultas = Fakultas::findOrFail($id);

        $fakultas->delete();



        return redirect('/admin/fakultas')
                ->with('success','Data berhasil dihapus');
    }

}