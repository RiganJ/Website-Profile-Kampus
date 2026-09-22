<?php

namespace App\Http\Controllers\Admin;

use App\Support\AdminTable;

use App\Http\Controllers\Controller;
use App\Models\Civitas;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProdiAdminController extends Controller
{

    public function index()
    {
        $prodi = AdminTable::paginate(Prodi::with(['fakultas', 'dosen', 'kaprodiDosen', 'adminProdi', 'laborans'])
                    ->latest(), ['nama_prodi', 'kode_prodi', 'nama_kaprodi', 'fakultas.nama_fakultas'], 'prodi', 10);

        return view('admin.prodi.index', compact('prodi'));
    }

    public function heroIndex()
    {
        $prodi = AdminTable::paginate(Prodi::query()->orderBy('nama_prodi'), ['nama_prodi', 'hero_title', 'hero_subtitle'], 'prodi');

        return view('admin.prodi_hero.index', compact('prodi'));
    }

    public function heroEdit(Prodi $prodi)
    {
        File::ensureDirectoryExists(public_path('images'));
        $contentImageSlots = $this->contentImageSlots();

        return view('admin.prodi_hero.edit', compact('prodi', 'contentImageSlots'));
    }

    public function heroUpdate(Request $request, Prodi $prodi)
    {
        $validated = $request->validate([
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'hero_image_position' => 'nullable|string|max:100',
            'remove_hero_image' => 'nullable|boolean',
            'content_images' => 'nullable|array',
            'content_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'content_image_settings' => 'nullable|array',
            'content_image_settings.*.width' => 'nullable|integer|min:240|max:2400',
            'content_image_settings.*.height' => 'nullable|integer|min:180|max:1800',
            'content_image_settings.*.fit' => 'nullable|in:cover,contain,stretch',
            'content_image_settings.*.remove_background' => 'nullable|boolean',
            'content_image_settings.*.background_tolerance' => 'nullable|integer|min:12|max:96',
            'remove_content_images' => 'nullable|array',
            'remove_content_images.*' => 'nullable|boolean',
        ]);

        $heroImage = $prodi->hero_image;
        $contentImages = $this->syncContentImages($request, $prodi);

        if ($request->boolean('remove_hero_image')) {
            $this->deleteHeroImageFile($heroImage);
            $heroImage = null;
        }

        if ($request->hasFile('hero_image')) {
            $this->deleteHeroImageFile($heroImage);
            $heroImage = $this->storeHeroImage($request);
        }

        $prodi->update([
            'hero_title' => $validated['hero_title'] ?? null,
            'hero_subtitle' => $validated['hero_subtitle'] ?? null,
            'hero_image' => $heroImage,
            'hero_image_position' => $validated['hero_image_position'] ?? null,
            'content_images' => $contentImages,
        ]);

        if ($request->expectsJson()) {
            $prodi->refresh();

            return response()->json([
                'message' => 'Hero prodi berhasil diupdate',
                'content_images' => collect(array_keys($this->contentImageSlots()))
                    ->mapWithKeys(fn ($slot) => [
                        $slot => [
                            'url' => $prodi->contentImageUrl($slot),
                            'settings' => $prodi->contentImageSettings($slot),
                        ],
                    ]),
            ]);
        }

        return redirect()
            ->route('prodi-hero.edit', $prodi)
            ->with('success', 'Hero prodi berhasil diupdate');
    }



    public function create()
    {
        $fakultas = Fakultas::all();
        $dosenOptions = Dosen::orderBy('nama')->get(['id', 'nama']);
        $civitasOptions = Civitas::orderBy('nama')->get(['id', 'nama', 'jabatan']);
        $namaProdiOptions = Prodi::namaProdiOptions();
        File::ensureDirectoryExists(public_path('images'));

        return view('admin.prodi.create', compact('fakultas', 'dosenOptions', 'civitasOptions', 'namaProdiOptions'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_prodi' => 'required',
            'nama_prodi' => ['required', Rule::in(Prodi::namaProdiOptions())],
            'kaprodi_dosen_id' => 'nullable|exists:dosens,id',
            'admin_prodi_civitas_id' => 'nullable|exists:civitas,id',
            'laboran_civitas_ids' => 'nullable|array',
            'laboran_civitas_ids.*' => 'exists:civitas,id',
            'fakultas_id' => 'required|exists:fakultas,id',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'hero_image_position' => 'nullable|string|max:100',
            'dosen_ids' => 'nullable|array',
            'dosen_ids.*' => 'exists:dosens,id',
        ]);

        $heroImage = $this->storeHeroImage($request);

        $prodi = Prodi::create([
            'kode_prodi' => $validated['kode_prodi'],
            'nama_prodi' => $validated['nama_prodi'],
            'kaprodi_dosen_id' => $validated['kaprodi_dosen_id'] ?? null,
            'admin_prodi_civitas_id' => $validated['admin_prodi_civitas_id'] ?? null,
            'fakultas_id' => $validated['fakultas_id'],
            'hero_title' => $validated['hero_title'] ?? null,
            'hero_subtitle' => $validated['hero_subtitle'] ?? null,
            'hero_image' => $heroImage,
            'hero_image_position' => $validated['hero_image_position'] ?? null,
        ]);

        $prodi->dosen()->sync($validated['dosen_ids'] ?? []);
        $prodi->laborans()->sync($validated['laboran_civitas_ids'] ?? []);

        return redirect('/admin/prodi')
            ->with('success', 'Data prodi berhasil ditambahkan');
    }



    public function edit($id)
    {
        $prodi = Prodi::with(['dosen', 'kaprodiDosen', 'adminProdi', 'laborans'])->findOrFail($id);
        $fakultas = Fakultas::all();
        $dosenOptions = Dosen::orderBy('nama')->get(['id', 'nama']);
        $civitasOptions = Civitas::orderBy('nama')->get(['id', 'nama', 'jabatan']);
        $namaProdiOptions = Prodi::namaProdiOptions();
        File::ensureDirectoryExists(public_path('images'));

        return view('admin.prodi.edit', compact('prodi','fakultas', 'dosenOptions', 'civitasOptions', 'namaProdiOptions'));
    }



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode_prodi' => 'required',
            'nama_prodi' => ['required', Rule::in(Prodi::namaProdiOptions())],
            'kaprodi_dosen_id' => 'nullable|exists:dosens,id',
            'admin_prodi_civitas_id' => 'nullable|exists:civitas,id',
            'laboran_civitas_ids' => 'nullable|array',
            'laboran_civitas_ids.*' => 'exists:civitas,id',
            'fakultas_id' => 'required|exists:fakultas,id',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'hero_image_position' => 'nullable|string|max:100',
            'remove_hero_image' => 'nullable|boolean',
            'dosen_ids' => 'nullable|array',
            'dosen_ids.*' => 'exists:dosens,id',
        ]);

        $prodi = Prodi::findOrFail($id);
        $heroImage = $prodi->hero_image;

        if ($request->boolean('remove_hero_image')) {
            $this->deleteHeroImageFile($heroImage);
            $heroImage = null;
        }

        if ($request->hasFile('hero_image')) {
            $this->deleteHeroImageFile($heroImage);
            $heroImage = $this->storeHeroImage($request);
        }

        $prodi->update([
            'kode_prodi' => $validated['kode_prodi'],
            'nama_prodi' => $validated['nama_prodi'],
            'kaprodi_dosen_id' => $validated['kaprodi_dosen_id'] ?? null,
            'admin_prodi_civitas_id' => $validated['admin_prodi_civitas_id'] ?? null,
            'fakultas_id' => $validated['fakultas_id'],
            'hero_title' => $validated['hero_title'] ?? null,
            'hero_subtitle' => $validated['hero_subtitle'] ?? null,
            'hero_image' => $heroImage,
            'hero_image_position' => $validated['hero_image_position'] ?? null,
        ]);

        $prodi->dosen()->sync($validated['dosen_ids'] ?? []);
        $prodi->laborans()->sync($validated['laboran_civitas_ids'] ?? []);

        return redirect('/admin/prodi')
            ->with('success', 'Data prodi berhasil diupdate');
    }



    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);

        $this->deleteFotoKaprodiFile($prodi->foto_kaprodi);
        $this->deleteHeroImageFile($prodi->hero_image);
        foreach (($prodi->content_images ?? []) as $contentImage) {
            $this->deleteHeroImageFile($this->contentImageFilenameFromEntry($contentImage));
        }
        $prodi->delete();

        return redirect('/admin/prodi')
            ->with('success', 'Data prodi berhasil dihapus');
    }

    private function deleteFotoKaprodiFile(?string $fotoKaprodi): void
    {
        if (! $fotoKaprodi) {
            return;
        }

        $path = public_path('images/' . basename($fotoKaprodi));

        if (File::exists($path)) {
            File::delete($path);
        }
    }

    private function storeHeroImage(Request $request): ?string
    {
        if (! $request->hasFile('hero_image')) {
            return null;
        }

        File::ensureDirectoryExists(public_path('images'));

        $file = $request->file('hero_image');
        $filename = 'prodi-hero-' . Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);

        return $filename;
    }

    private function deleteHeroImageFile(?string $heroImage): void
    {
        if (! $heroImage) {
            return;
        }

        $path = public_path('images/' . basename($heroImage));

        if (File::exists($path)) {
            File::delete($path);
        }
    }

    private function contentImageSlots(): array
    {
        return [
            'visi_misi' => 'Foto Visi & Misi',
            'fokus_pembelajaran' => 'Foto Fokus Pembelajaran',
            'tujuan' => 'Foto Tujuan Prodi',
            'profil_lulusan' => 'Foto Profil Lulusan',
        ];
    }

    private function syncContentImages(Request $request, Prodi $prodi): array
    {
        $contentImages = $prodi->content_images ?? [];

        foreach (array_keys($this->contentImageSlots()) as $slot) {
            if ($request->boolean("remove_content_images.$slot")) {
                $this->deleteHeroImageFile($this->contentImageFilenameFromEntry($contentImages[$slot] ?? null));
                unset($contentImages[$slot]);
                continue;
            }

            $currentFile = $this->contentImageFilenameFromEntry($contentImages[$slot] ?? null);
            $settings = $this->contentImageSettingsFromRequest($request, $slot);

            if ($request->hasFile("content_images.$slot")) {
                $this->deleteHeroImageFile($currentFile);
                $currentFile = $this->storeNamedImage($request->file("content_images.$slot"), 'prodi-content');
            }

            if ($currentFile) {
                $contentImages[$slot] = [
                    'file' => $currentFile,
                    'settings' => $settings,
                ];
            }
        }

        return array_filter($contentImages);
    }

    private function contentImageFilenameFromEntry(mixed $entry): ?string
    {
        if (is_array($entry)) {
            return $entry['file'] ?? $entry['path'] ?? null;
        }

        return $entry;
    }

    private function contentImageSettingsFromRequest(Request $request, string $slot): array
    {
        $defaults = $this->contentImageDefaultSettings($slot);

        return [
            'width' => (int) $request->input("content_image_settings.$slot.width", $defaults['width']),
            'height' => (int) $request->input("content_image_settings.$slot.height", $defaults['height']),
            'fit' => $request->input("content_image_settings.$slot.fit", $defaults['fit']),
            'remove_background' => $request->boolean("content_image_settings.$slot.remove_background"),
            'background_tolerance' => (int) $request->input("content_image_settings.$slot.background_tolerance", 42),
        ];
    }

    private function contentImageDefaultSettings(string $slot): array
    {
        return match ($slot) {
            'visi_misi' => ['width' => 720, 'height' => 1120, 'fit' => 'contain'],
            'fokus_pembelajaran', 'profil_lulusan' => ['width' => 820, 'height' => 980, 'fit' => 'contain'],
            default => ['width' => 900, 'height' => 620, 'fit' => 'cover'],
        };
    }

    private function storeNamedImage($file, string $prefix): string
    {
        File::ensureDirectoryExists(public_path('images'));

        $filename = $prefix . '-' . Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);

        return $filename;
    }
}
