<?php

namespace App\Http\Controllers\Admin;

use App\Support\AdminTable;

use App\Http\Controllers\Controller;
use App\Models\Accreditation;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AccreditationController extends Controller
{
    public function index()
    {
        $accreditations = AdminTable::paginate(Accreditation::with('prodi')
            ->latest(), ['program_studi', 'predicate', 'lembaga', 'nomor_sk', 'tahun'], 'accreditations', 10);

        return view('admin.akreditasi.index', compact('accreditations'));
    }

    public function create()
    {
        $prodiOptions = $this->prodiOptions();

        return view('admin.akreditasi.create', compact('prodiOptions'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        if ($request->hasFile('file')) {
            $data['file'] = $this->storeFile($request->file('file'));
        }

        Accreditation::create($data);

        return redirect('/admin/akreditasi')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $accreditation = Accreditation::findOrFail($id);
        $prodiOptions = $this->prodiOptions();

        return view(
            'admin.akreditasi.edit',
            compact('accreditation', 'prodiOptions')
        );
    }

    public function update(Request $request, $id)
    {
        $accreditation = Accreditation::findOrFail($id);
        $data = $this->validatedData($request);

        if ($request->hasFile('file')) {
            $this->deleteFile($accreditation->file);

            $data['file'] = $this->storeFile(
                $request->file('file')
            );
        }

        $accreditation->update($data);

        return redirect('/admin/akreditasi')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $accreditation = Accreditation::findOrFail($id);

        $this->deleteFile($accreditation->file);

        $accreditation->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'accreditation_type' => [
                'required',
                Rule::in([
                    'institusi',
                    'program_studi'
                ])
            ],

            'prodi_id' => [
                'nullable',
                'required_if:accreditation_type,program_studi',
                'exists:prodi,id'
            ],

            'predicate' => [
                'required'
            ],

            'tahun' => [
                'required',
                'digits:4'
            ],

            'lembaga' => [
                'required'
            ],

            'nomor_sk' => [
                'required'
            ],

            'tanggal_sk' => [
                'required',
                'date'
            ],

            'tanggal_kadaluarsa' => [
                'nullable',
                'date'
            ],

            'file' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120'
            ],
        ]);

        if ($validated['accreditation_type'] === 'institusi') {
            $validated['prodi_id'] = null;
            $validated['program_studi'] = 'Institusi';
        } else {
            $prodi = Prodi::findOrFail($validated['prodi_id']);

            $validated['program_studi'] = $prodi->nama_prodi;
        }

        unset($validated['file']);

        return $validated;
    }

    private function prodiOptions()
    {
        return Prodi::query()
            ->orderBy('nama_prodi')
            ->get([
                'id',
                'nama_prodi'
            ]);
    }

    /**
     * Simpan file akreditasi
     */
    private function storeFile($file): string
    {
        $filename = Str::uuid() . '.' .
            $file->getClientOriginalExtension();

        $destination = base_path('images/accreditations');

        if (! File::exists($destination)) {
            File::makeDirectory(
                $destination,
                0755,
                true
            );
        }

        $file->move(
            $destination,
            $filename
        );

        return 'images/accreditations/' . $filename;
    }

    /**
     * Hapus file akreditasi
     */
    private function deleteFile(?string $file): void
    {
        if (! $file) {
            return;
        }

        $path = base_path(
            str_replace(
                ['/', '\\'],
                DIRECTORY_SEPARATOR,
                $file
            )
        );

        if (File::exists($path)) {
            File::delete($path);
        }
    }
}