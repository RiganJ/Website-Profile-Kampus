<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::where('kategori', Berita::KATEGORI_BERITA_TERKINI)
            ->orderBy('tanggal', 'desc')
            ->get();

        $prestasi = Berita::where('kategori', Berita::KATEGORI_PRESTASI_TERBARU)
            ->orderBy('tanggal', 'desc')
            ->get();

        $riset = Berita::where('kategori', Berita::KATEGORI_RISET_UNGGULAN)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('berita', compact('berita', 'prestasi', 'riset'));
    }

    public function beritaTerbaru()
    {
        $berita = Berita::where('kategori', Berita::KATEGORI_BERITA_TERKINI)
            ->orderBy('tanggal', 'desc')
            ->paginate(12);

        return view('berita.berita', compact('berita'));
    }

    public function prestasi()
    {
        $prestasi = Berita::where('kategori', Berita::KATEGORI_PRESTASI_TERBARU)
            ->orderBy('tanggal', 'desc')
            ->paginate(12);

        return view('berita.prestasi', compact('prestasi'));
    }

    public function riset()
    {
        $riset = Berita::where('kategori', Berita::KATEGORI_RISET_UNGGULAN)
            ->orderBy('tanggal', 'desc')
            ->paginate(12);

        return view('berita.riset', compact('riset'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        $relatedNews = Berita::query()
            ->where('id', '!=', $berita->id)
            ->where('kategori', $berita->kategori)
            ->orderBy('tanggal', 'desc')
            ->take(3)
            ->get();

        return view('berita.show', compact('berita', 'relatedNews'));
    }
}
