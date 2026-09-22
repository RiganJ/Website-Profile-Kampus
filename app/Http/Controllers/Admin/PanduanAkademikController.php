<?php

namespace App\Http\Controllers\Admin;

use App\Support\AdminTable;

use App\Http\Controllers\Controller;
use App\Models\PanduanAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PanduanAkademikController extends Controller
{
    public function index()
    {
        $guides = AdminTable::paginate(PanduanAkademik::query()
            ->latest('published_at')
            ->latest(), ['judul', 'kategori', 'deskripsi'], 'guides', 10);

        return view('admin.panduan-akademik.index', compact('guides'));
    }

    public function create()
    {
        $categoryOptions = PanduanAkademik::KATEGORI_OPTIONS;

        return view('admin.panduan-akademik.create', compact('categoryOptions'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['file'] = $request->file('file')->store('panduan-akademik', 'public');

        PanduanAkademik::create($data);

        return redirect('/admin/panduan-akademik')
            ->with('success', 'Panduan akademik berhasil ditambahkan');
    }

    public function edit($id)
    {
        $guide = PanduanAkademik::findOrFail($id);
        $categoryOptions = PanduanAkademik::KATEGORI_OPTIONS;

        return view('admin.panduan-akademik.edit', compact('guide', 'categoryOptions'));
    }

    public function update(Request $request, $id)
    {
        $guide = PanduanAkademik::findOrFail($id);
        $data = $this->validatedData($request, false);

        if ($request->hasFile('file')) {
            $this->deleteFile($guide->file);
            $data['file'] = $request->file('file')->store('panduan-akademik', 'public');
        }

        $guide->update($data);

        return redirect('/admin/panduan-akademik')
            ->with('success', 'Panduan akademik berhasil diupdate');
    }

    public function destroy($id)
    {
        $guide = PanduanAkademik::findOrFail($id);
        $this->deleteFile($guide->file);
        $guide->delete();

        return back()->with('success', 'Panduan akademik berhasil dihapus');
    }

    private function validatedData(Request $request, bool $fileRequired = true): array
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:panduan_akademik,panduan_aplikasi,yudisium_wisuda',
            'deskripsi' => 'nullable|string',
            'published_at' => 'nullable|date',
            'is_active' => 'nullable|boolean',
            'file' => ($fileRequired ? 'required' : 'nullable').'|file|mimes:pdf|max:10240',
        ]) + [
            'is_active' => false,
        ];
    }

    private function deleteFile(?string $file): void
    {
        if ($file && Storage::disk('public')->exists($file)) {
            Storage::disk('public')->delete($file);
        }
    }
}
