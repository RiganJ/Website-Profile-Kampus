<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Dosen;
use App\Models\GuruBesar;
use App\Models\HeroSlide;
use App\Models\Kerjasama;
use App\Models\Mahasiswa;
use App\Models\Mitra;
use App\Models\Prodi;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::where('is_active', true)
            ->orderByDesc('sort_order')
            ->latest()
            ->get();

        $statistics = [
            'prodi' => Prodi::count(),
            'dosen' => Dosen::count(),
            'mahasiswa' => Mahasiswa::count(),
            'guru_besar' => GuruBesar::count(),
            'mitra_kerjasama' => $this->getMitraKerjasamaCount(),
        ];

        $partnerItems = $this->getPartnerItems();
        $partnerChartData = $this->buildPartnerChartData($partnerItems);
        $partnerRailGroups = $this->buildPartnerRailGroups($partnerItems);
        $featuredNews = Berita::query()
            ->orderBy('tanggal', 'desc')
            ->first();
        $latestBerita = Berita::query()
            ->where('kategori', Berita::KATEGORI_BERITA_TERKINI)
            ->orderBy('tanggal', 'desc')
            ->first();
        $latestPrestasi = Berita::query()
            ->where('kategori', Berita::KATEGORI_PRESTASI_TERBARU)
            ->orderBy('tanggal', 'desc')
            ->first();
        $latestRiset = Berita::query()
            ->where('kategori', Berita::KATEGORI_RISET_UNGGULAN)
            ->orderBy('tanggal', 'desc')
            ->first();

        return view('home', compact(
            'slides',
            'statistics',
            'partnerItems',
            'partnerChartData',
            'partnerRailGroups',
            'featuredNews',
            'latestBerita',
            'latestPrestasi',
            'latestRiset'
        ));
    }

    private function getMitraKerjasamaCount(): int
    {
        if (Schema::hasTable('kerjasama')) {
            return Kerjasama::count();
        }

        if (Schema::hasTable('mitras')) {
            return Mitra::count();
        }

        return 0;
    }

    private function getPartnerItems(): Collection
    {
        // prefer the simplified kerjasama table (nama, kriteria, logo)
        if (Schema::hasTable('kerjasama')) {
          return Kerjasama::query()
    ->select(['id','nama','kriteria','logo','partner_mou','kriteria_mitra'])
    ->latest()
    ->get()
    ->map(fn (Kerjasama $item) => [
        'id' => $item->id,
        'name' => $item->nama ?: ($item->partner_mou ?: 'Mitra Kerja Sama #' . $item->id),
        'category' => $item->kriteria_label,
        'logo' => !empty($item->logo) && file_exists(base_path($item->logo)) 
                    ? $item->logo 
                    : null,
    ])
    ->values();
        }

        // fallback to old mitras table
        if (Schema::hasTable('mitras')) {
            return Mitra::query()
                ->select(['id','nama_mitra', 'jenis_mitra'])
                ->latest()
                ->get()
                ->filter(fn (Mitra $item) => filled($item->nama_mitra))
                ->unique(fn (Mitra $item) => mb_strtolower(trim($item->nama_mitra)))
                ->values()
                ->map(fn (Mitra $item) => [
                    'id' => $item->id,
                    'name' => $item->nama_mitra,
                    'category' => $item->jenis_mitra ?: 'Lainnya',
                    'logo' => null,
                ]);
        }

        return collect();
    }

    private function buildPartnerChartData(Collection $partnerItems): array
    {
        if ($partnerItems->isEmpty()) {
            return [
                [
                    'category' => 'Belum Ada Data',
                    'value' => 0,
                    'full' => 1,
                ],
            ];
        }

        $categories = $partnerItems
            ->groupBy('category')
            ->map(fn (Collection $items) => $items->count())
            ->sortDesc()
            ->take(6);

        // Determine maximum count among categories. Use that as the full scale so chart adapts to actual data.
        $maxCount = ($categories->max()) ?: 1;

        // Use maxCount as 'full' for background bars so each category's background equals the same maximum
        return $categories
            ->map(fn (int $count, string $category) => [
                'category' => $category,
                'value' => $count,
                'full' => $maxCount,
            ])
            ->values()
            ->all();
    }

    private function buildPartnerRailGroups(Collection $partnerItems): array
    {
        $partners = $partnerItems->map(fn ($i) => ['name' => $i['name'], 'logo' => $i['logo']])->values();
        $groups = [[], [], [], []];

        $partners->each(function (array $partner, int $index) use (&$groups) {
            $groups[$index % count($groups)][] = $partner;
        });

        return $groups;
    }
}
