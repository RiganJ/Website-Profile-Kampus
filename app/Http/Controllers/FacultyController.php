<?php

namespace App\Http\Controllers;

use App\Models\Civitas;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\LeadershipProfile;
use Illuminate\Support\Str;

class FacultyController extends Controller
{
    public function show(string $slug)
    {
        $faculties = $this->faculties();
        abort_unless(isset($faculties[$slug]), 404);

        $faculty = $faculties[$slug];
        $facultyRecord = Fakultas::query()
            ->where(function ($query) use ($faculty) {
                foreach ($faculty['database_terms'] as $term) {
                    $query->orWhere('nama_fakultas', 'like', '%' . $term . '%')
                        ->orWhere('kode_fakultas', 'like', '%' . $term . '%');
                }
            })
            ->first();

        $deanProfile = LeadershipProfile::query()
            ->where('slug', $faculty['dean_profile_slug'])
            ->where('is_active', true)
            ->first();

        $deanName = $facultyRecord?->dekan ?: ($deanProfile?->name ?: $faculty['dean_fallback']);
        $deanDosen = $this->findDeanDosen($deanName);
        $deanCivitas = $this->findDeanCivitas($deanName);

        $dean = [
            'name' => $deanName,
            'position' => $deanProfile?->position ?: 'Dekan ' . $faculty['name'],
            'photo_url' => $deanDosen?->foto_url
                ?: ($deanCivitas?->foto_url
                    ?: ($deanProfile?->photo_path ? $deanProfile->photo_url : null)),
            'summary' => $deanProfile?->summary ?: $faculty['dean_summary'],
            'profile_url' => $deanProfile
                ? route('pimpinan.show', $deanProfile->slug)
                : route('pimpinan.index'),
        ];

        return view('fakultas.show', compact('faculty', 'dean'));
    }

    private function findDeanDosen(string $name): ?Dosen
    {
        return $this->findPersonByName(Dosen::query()->whereNotNull('foto')->get(), $name);
    }

    private function findDeanCivitas(string $name): ?Civitas
    {
        return $this->findPersonByName(Civitas::query()->whereNotNull('foto')->get(), $name);
    }

    private function findPersonByName($people, string $name)
    {
        $targetTokens = $this->significantNameTokens($name);

        return $people
            ->map(function ($person) use ($targetTokens) {
                $personTokens = $this->significantNameTokens($person->nama);
                $matchedTokens = array_intersect($targetTokens, $personTokens);
                $person->dean_name_score = count($matchedTokens) / max(count($targetTokens), 1);

                return $person;
            })
            ->filter(fn ($person) => $person->dean_name_score >= 0.6)
            ->sortByDesc('dean_name_score')
            ->first();
    }

    private function significantNameTokens(string $name): array
    {
        $ignored = ['dr', 'ns', 'prof', 'skep', 'mkep', 'man', 'spsi', 'mkes', 'se', 'mm'];

        return collect(preg_split('/[^a-z0-9]+/', Str::lower(Str::ascii($name))))
            ->filter(fn (string $token) => strlen($token) > 2 && ! in_array($token, $ignored, true))
            ->unique()
            ->values()
            ->all();
    }

    private function faculties(): array
    {
        return [
            'kesehatan' => [
                'name' => 'Fakultas Ilmu Kesehatan',
                'short_name' => 'FIK',
                'eyebrow' => 'Sains, layanan, dan inovasi kesehatan',
                'description' => 'Fakultas Ilmu Kesehatan membentuk tenaga kesehatan profesional melalui pendidikan berbasis bukti, praktik klinis, riset, dan pengabdian kepada masyarakat.',
                'welcome' => 'Selamat datang di Fakultas Ilmu Kesehatan Universitas Fort De Kock. Kami berkomitmen menghadirkan pendidikan kesehatan yang bermutu, humanis, dan responsif terhadap perkembangan ilmu pengetahuan serta kebutuhan pelayanan masyarakat. Bersama para dosen, tenaga kependidikan, mitra, dan mahasiswa, kami membangun lingkungan akademik yang mendorong kompetensi profesional, integritas, inovasi, dan kepedulian sosial.',
                'accent' => '#F47E1F',
                'accent_dark' => '#F47E1F',
                'accent_soft' => '#ffedd5',
                'hero_image' => 'images/fik.png',
                'hero_position' => 'center top',
                'hero_transform' => 'translateY(28px)',
                'hero_background' => '#f3f2f3',
                'dean_profile_slug' => 'dekan-fakultas-kesehatan',
                'dean_fallback' => 'Dekan Fakultas Ilmu Kesehatan',
                'dean_summary' => 'Memimpin pengembangan pendidikan, penelitian, pengabdian, dan tata kelola Fakultas Ilmu Kesehatan Universitas Fort De Kock.',
                'database_terms' => ['Ilmu Kesehatan', 'Kesehatan', 'FIK'],
                'programs' => [
                    ['name' => 'S2 Kesehatan Masyarakat', 'level' => 'Magister', 'route' => 'prodi.pasca-sarjana.s2.kesmas', 'image' => 'images/banners2.png'],
                    ['name' => 'S1 Kesehatan Masyarakat', 'level' => 'Sarjana', 'route' => 'prodi.sarjana.s1.kesmas', 'image' => 'images/banners1kesmas.jpg'],
                    ['name' => 'Profesi Ners', 'level' => 'Profesi', 'route' => 'prodi.proefsiners', 'image' => 'images/bannerprofesiners.jpg'],
                    ['name' => 'Profesi Bidan', 'level' => 'Profesi', 'route' => 'prodi.profesibidan', 'image' => 'images/bannerprofesibidan.png'],
                    ['name' => 'S1 Farmasi', 'level' => 'Sarjana', 'route' => 'prodi.sarjana.s1.farmasi', 'image' => 'images/bannerfarmasi.jpg'],
                    ['name' => 'S1 Kebidanan', 'level' => 'Sarjana', 'route' => 'prodi.sarjana.s1.bidan', 'image' => 'images/bannerbidan.png'],
                    ['name' => 'S1 Keperawatan', 'level' => 'Sarjana', 'route' => 'prodi.sarjana.s1.keperawatan', 'image' => 'images/bannerkeperawatan.jpg'],
                    ['name' => 'S1 Fisioterapi', 'level' => 'Sarjana', 'route' => 'prodi.sarjana.s1.fisiotrapi', 'image' => 'images/bannerfisio.jpg'],
                    ['name' => 'D3 Fisioterapi', 'level' => 'Diploma', 'route' => 'prodi.diploma.d3.fisiotrapi', 'image' => 'images/bannerd3.jpg'],
                ],
            ],
            'sosial-ekonomi-humaniora' => [
                'name' => 'Fakultas Sosial, Ekonomi & Humaniora',
                'short_name' => 'FSEH',
                'eyebrow' => 'Kreativitas, bisnis, sosial, dan humaniora',
                'description' => 'FSEH mengembangkan lulusan yang adaptif, kreatif, berjiwa wirausaha, dan mampu memberi solusi bagi dinamika sosial serta ekonomi.',
                'welcome' => 'Selamat datang di Fakultas Sosial, Ekonomi & Humaniora Universitas Fort De Kock. Fakultas ini menjadi ruang kolaborasi lintas disiplin untuk menumbuhkan daya pikir kritis, kreativitas, kepekaan sosial, dan keberanian berinovasi. Kami mengajak mahasiswa mengembangkan kompetensi yang relevan dengan dunia kerja sekaligus memegang teguh etika, kearifan lokal, dan tanggung jawab kepada masyarakat.',
                'accent' => '#F47E1F',
                'accent_dark' => '#F47E1F',
                'accent_soft' => '#ffedd5',
                'hero_image' => 'images/fseh2.jpg',
                'hero_position' => 'center center',
                'hero_transform' => 'none',
                'hero_background' => '#0f172a',
                'dean_profile_slug' => 'dekan-fakultas-sosial-ekonomi-dan-humaniora',
                'dean_fallback' => 'Dekan Fakultas Sosial, Ekonomi & Humaniora',
                'dean_summary' => 'Memimpin pengembangan pendidikan, penelitian, pengabdian, dan tata kelola Fakultas Sosial, Ekonomi & Humaniora Universitas Fort De Kock.',
                'database_terms' => ['Sosial', 'Ekonomi', 'Humaniora', 'FSEH'],
                'programs' => [
                    ['name' => 'S1 Psikologi', 'level' => 'Sarjana', 'route' => 'prodi.sarjana.s1.psikologi', 'image' => 'images/bannerpsikologi.png'],
                    ['name' => 'S1 Bisnis Digital', 'level' => 'Sarjana', 'route' => 'prodi.sarjana.s1.bisnisdigital', 'image' => 'images/bannerbd.jpg'],
                    ['name' => 'S1 Desain Komunikasi Visual', 'level' => 'Sarjana', 'route' => 'prodi.sarjana.s1.dkv', 'image' => 'images/bannerdkv.png'],
                    ['name' => 'S1 Pariwisata', 'level' => 'Sarjana', 'route' => 'prodi.sarjana.s1.pariwisata', 'image' => 'images/bannerpariwisata.jpg'],
                    ['name' => 'S1 Hukum', 'level' => 'Sarjana', 'route' => 'prodi.sarjana.s1.hukum', 'image' => 'images/bannerhukum.png'],
                    ['name' => 'S1 Kewirausahaan', 'level' => 'Sarjana', 'route' => 'prodi.sarjana.s1.kewirausahaan', 'image' => 'images/bannerkwu.png'],
                ],
            ],
        ];
    }
}
