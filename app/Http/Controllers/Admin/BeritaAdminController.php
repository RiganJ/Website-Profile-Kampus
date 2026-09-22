<?php

namespace App\Http\Controllers\Admin;

use App\Support\AdminTable;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BeritaAdminController extends Controller
{
    public function index()
    {
        $berita = AdminTable::paginate(Berita::orderBy('tanggal', 'desc'), ['judul', 'kategori', 'tanggal'], 'berita', 10);

        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        $kategoriOptions = Berita::KATEGORI_OPTIONS;

        return view('admin.berita.create', compact('kategoriOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', Rule::in(array_keys(Berita::KATEGORI_OPTIONS))],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'konten' => ['required', 'string'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar', 'max:10240'],
            'tanggal' => ['required', 'date'],
        ]);

        $slug = Str::slug($validated['judul']);
        $originalSlug = $slug;
        $counter = 1;

        while (Berita::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $this->storeThumbnail($request->file('thumbnail'));
        }

        if ($request->hasFile('gallery_images')) {
            $validated['gallery_images'] = $this->storeGalleryImages($request->file('gallery_images'));
        }

        if ($request->hasFile('attachments')) {
            $validated['attachments'] = $this->storeAttachments($request->file('attachments'));
        }

        $validated['slug'] = $slug;

        Berita::create($validated);

        return redirect('/admin/berita')
            ->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $kategoriOptions = Berita::KATEGORI_OPTIONS;

        return view('admin.berita.edit', compact('berita', 'kategoriOptions'));
    }

    public function show($id)
    {
        return redirect("/admin/berita/{$id}/edit");
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', Rule::in(array_keys(Berita::KATEGORI_OPTIONS))],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'konten' => ['required', 'string'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar', 'max:10240'],
            'tanggal' => ['required', 'date'],
        ]);

        if ($berita->judul !== $validated['judul']) {
            $slug = Str::slug($validated['judul']);
            $originalSlug = $slug;
            $counter = 1;

            while (Berita::where('slug', $slug)->where('id', '!=', $berita->id)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $validated['slug'] = $slug;
        }

        if ($request->hasFile('thumbnail')) {
            $this->deleteThumbnail($berita->thumbnail);
            $validated['thumbnail'] = $this->storeThumbnail($request->file('thumbnail'));
        }

        if ($request->hasFile('gallery_images')) {
            $validated['gallery_images'] = array_merge(
                $berita->gallery_images ?? [],
                $this->storeGalleryImages($request->file('gallery_images'))
            );
        }

        if ($request->hasFile('attachments')) {
            $validated['attachments'] = array_merge(
                $berita->attachments ?? [],
                $this->storeAttachments($request->file('attachments'))
            );
        }

        $berita->update($validated);

        return redirect('/admin/berita')
            ->with('success', 'Berita berhasil diupdate');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        $this->deleteThumbnail($berita->thumbnail);
        $this->deleteStoredFiles($berita->gallery_images ?? []);
        $this->deleteStoredFiles($berita->attachments ?? []);

        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus');
    }

    private function storeThumbnail($file): string
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $destination = base_path('images');

        if (! File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        $file->move($destination, $filename);

        return $filename;
    }

    private function storeGalleryImages(array $files): array
    {
        $stored = [];
        $destination = base_path('images/berita');

        if (! File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        foreach ($files as $file) {
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $originalName = $file->getClientOriginalName();
            $mime = $file->getClientMimeType();
            $size = $file->getSize();

            $file->move($destination, $filename);

            $stored[] = [
                'name' => $originalName,
                'path' => 'images/berita/' . $filename,
                'mime' => $mime,
                'size' => $size,
            ];
        }

        return $stored;
    }

    private function storeAttachments(array $files): array
    {
        $stored = [];
        $destination = base_path('files/berita');

        if (! File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        foreach ($files as $file) {
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $originalName = $file->getClientOriginalName();
            $mime = $file->getClientMimeType();
            $size = $file->getSize();

            $file->move($destination, $filename);

            $stored[] = [
                'name' => $originalName,
                'path' => 'files/berita/' . $filename,
                'mime' => $mime,
                'size' => $size,
            ];
        }

        return $stored;
    }

    private function deleteThumbnail(?string $thumbnail): void
    {
        if (! $thumbnail) {
            return;
        }

        $imagePath = base_path('images/' . basename($thumbnail));

        if (File::exists($imagePath)) {
            File::delete($imagePath);
            return;
        }

        $legacyStoragePath = storage_path('app/public/' . str_replace('\\', '/', $thumbnail));

        if (File::exists($legacyStoragePath)) {
            File::delete($legacyStoragePath);
        }
    }

    private function deleteStoredFiles(array $files): void
    {
        foreach ($files as $file) {
            $path = $file['path'] ?? null;

            if (! $path) {
                continue;
            }

            $publicPath = base_path(str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path));

            if (File::exists($publicPath)) {
                File::delete($publicPath);
            }
        }
    }
}
