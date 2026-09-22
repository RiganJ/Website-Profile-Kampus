<?php

namespace App\Http\Controllers;

use App\Models\PanduanAkademik;
use Illuminate\Support\Facades\Storage;

class PanduanAkademikController extends Controller
{
    public function index()
    {
        $guides = PanduanAkademik::query()
            ->where('is_active', true)
            ->latest('published_at')
            ->latest()
            ->get();
        $guideSections = collect(PanduanAkademik::KATEGORI_OPTIONS)->map(function (string $label, string $key) use ($guides) {
            return [
                'key' => $key,
                'label' => $label,
                'guides' => $guides->where('kategori', $key)->values(),
            ];
        })->values();

        return view('panduan-akademik.index', compact('guideSections'));
    }

    public function file(PanduanAkademik $panduanAkademik)
    {
        abort_unless($panduanAkademik->file && Storage::disk('public')->exists($panduanAkademik->file), 404);

        return Storage::disk('public')->response($panduanAkademik->file);
    }

    public function download(PanduanAkademik $panduanAkademik)
    {
        abort_unless($panduanAkademik->file && Storage::disk('public')->exists($panduanAkademik->file), 404);

        return Storage::disk('public')->download($panduanAkademik->file, $panduanAkademik->judul.'.pdf');
    }
}
