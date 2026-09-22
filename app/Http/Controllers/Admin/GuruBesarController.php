<?php

namespace App\Http\Controllers\Admin;

use App\Support\AdminTable;

use App\Http\Controllers\Controller;
use App\Models\GuruBesar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GuruBesarController extends Controller
{


    public function index()
    {

        $guru_besars = AdminTable::paginate(GuruBesar::latest(), ['nama', 'bidang_keahlian', 'tahun_pengangkatan'], 'guru_besars', 10);

        return view(
            'admin.guru_besar.index',
            compact('guru_besars')
        );

    }



    public function create()
    {
        File::ensureDirectoryExists(public_path('images'));

        return view('admin.guru_besar.create');

    }



    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'bidang_keahlian' => 'required',
            'tahun_pengangkatan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            File::ensureDirectoryExists(public_path('images'));
            $file = $request->file('foto');
            $foto = 'guru-besar-' . Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $foto);
        }

        GuruBesar::create([

            'nama' => $request->nama,
            'bidang_keahlian' => $request->bidang_keahlian,
            'tahun_pengangkatan' => $request->tahun_pengangkatan,
            'foto' => $foto

        ]);

        return redirect('/admin/guru-besar')
            ->with('success', 'Data berhasil ditambahkan');

    }



    public function edit($id)
    {

        $guru_besar = GuruBesar::findOrFail($id);
        File::ensureDirectoryExists(public_path('images'));

        return view(
            'admin.guru_besar.edit',
            compact('guru_besar')
        );

    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'bidang_keahlian' => 'required',
            'tahun_pengangkatan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $guru_besar = GuruBesar::findOrFail($id);

        $foto = $guru_besar->foto;

        if ($request->hasFile('foto')) {
            File::ensureDirectoryExists(public_path('images'));
            $this->deleteFotoFile($guru_besar->foto);

            $file = $request->file('foto');
            $foto = 'guru-besar-' . Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $foto);
        }

        $guru_besar->update([

            'nama' => $request->nama,
            'bidang_keahlian' => $request->bidang_keahlian,
            'tahun_pengangkatan' => $request->tahun_pengangkatan,
            'foto' => $foto

        ]);

        return redirect('/admin/guru-besar')
            ->with('success', 'Data berhasil diupdate');

    }



    public function destroy($id)
    {
        $guru_besar = GuruBesar::findOrFail($id);

        $this->deleteFotoFile($guru_besar->foto);
        $guru_besar->delete();

        return back()
            ->with('success', 'Data berhasil dihapus');

    }

    private function deleteFotoFile(?string $foto): void
    {
        if (! $foto) {
            return;
        }

        $path = public_path('images/' . basename($foto));

        if (File::exists($path)) {
            File::delete($path);
        }
    }


}
