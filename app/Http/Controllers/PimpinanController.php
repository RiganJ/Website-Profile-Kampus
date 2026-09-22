<?php

namespace App\Http\Controllers;

use App\Models\LeadershipProfile;
use App\Models\Civitas;
use App\Models\Dosen;
use App\Models\Fakultas;
use Illuminate\Support\Collection;

class PimpinanController extends Controller
{
    public function index()
    {
        $pimpinan = $this->profiles();

        return view('pimpinan', compact('pimpinan'));
    }

    public function show(string $slug)
    {
        $profile = $this->profiles()
            ->firstWhere('slug', $slug);

        abort_unless($profile, 404);

        return view('pimpinan-show', compact('profile'));
    }

    private function profiles(): Collection
    {
        $details = LeadershipProfile::query()
            ->where('is_active', true)
            ->get()
            ->keyBy('slug');

        $universityLeaders = $this->leadershipDosens()
            ->map(function (Dosen $dosen) use ($details) {
                $slug = $this->roleSlug($dosen->jabatan);
                $detail = $details->get($slug);

                return (object) [
                    'group' => 'university',
                    'name' => $dosen->nama,
                    'slug' => $slug,
                    'position' => $this->roleLabel($dosen->jabatan),
                    'photo_url' => $dosen->foto_url ?: ($detail?->photo_url ?: asset('images/rektor.jpg')),
                    'email' => $detail?->email,
                    'phone' => $detail?->phone,
                    'summary' => $detail?->summary ?: $this->defaultSummary($dosen->jabatan),
                    'content_html' => $detail?->content_html ?: $this->fallbackContent($dosen),
                    'academic_link_items' => $detail?->academic_link_items ?: [],
                ];
            });

        return $universityLeaders
            ->concat($this->facultyDeanProfiles($details))
            ->values();
    }

    private function leadershipDosens(): Collection
    {
        return Dosen::query()
            ->where(function ($query) {
                $query->where('jabatan', 'like', '%Rektor%')
                    ->orWhere('jabatan', 'like', '%Wakil Rektor%')
                    ->orWhere('jabatan', 'like', '%Warek%');
            })
            ->orderByRaw("
                CASE
                    WHEN LOWER(jabatan) = 'rektor' THEN 1
                    WHEN LOWER(jabatan) LIKE '%wakil rektor i%' THEN 2
                    WHEN LOWER(jabatan) LIKE '%warek i%' THEN 2
                    WHEN LOWER(jabatan) LIKE '%wakil rektor ii%' THEN 3
                    WHEN LOWER(jabatan) LIKE '%warek ii%' THEN 3
                    WHEN LOWER(jabatan) LIKE '%wakil rektor iii%' THEN 4
                    WHEN LOWER(jabatan) LIKE '%warek iii%' THEN 4
                    WHEN LOWER(jabatan) LIKE '%wakil rektor%' THEN 5
                    WHEN LOWER(jabatan) LIKE '%warek%' THEN 5
                    ELSE 6
                END
            ")
            ->orderBy('nama')
            ->get();
    }

    private function roleSlug(?string $jabatan): string
    {
        $jabatan = strtolower((string) $jabatan);

        return match (true) {
            str_contains($jabatan, 'warek iii') || str_contains($jabatan, 'wakil rektor iii') => 'warek-iii',
            str_contains($jabatan, 'warek ii') || str_contains($jabatan, 'wakil rektor ii') => 'warek-ii',
            str_contains($jabatan, 'warek i') || str_contains($jabatan, 'wakil rektor i') => 'warek-i',
            str_contains($jabatan, 'rektor') => 'rektor',
            default => str($jabatan)->slug()->value(),
        };
    }

    private function facultyDeanProfiles(Collection $details): Collection
    {
        return Fakultas::query()
            ->whereNotNull('dekan')
            ->where('dekan', '<>', '')
            ->orderBy('nama_fakultas')
            ->get()
            ->map(function (Fakultas $faculty) use ($details) {
                $slug = 'dekan-' . str($faculty->nama_fakultas)->slug()->value();
                $detail = $details->get($slug);
                $dosen = $this->deanDosen($faculty->dekan);
                $civitas = $this->deanCivitas($faculty->dekan);
                $facultyName = $faculty->nama_fakultas ?: 'Fakultas';

                return (object) [
                    'group' => 'faculty',
                    'name' => $faculty->dekan,
                    'slug' => $slug,
                    'position' => 'Dekan ' . $facultyName,
                    'photo_url' => $dosen?->foto_url ?: ($civitas?->foto_url ?: ($detail?->photo_url ?: asset('images/rektor.jpg'))),
                    'email' => $detail?->email,
                    'phone' => $detail?->phone,
                    'summary' => $detail?->summary ?: 'Memimpin pengembangan akademik, mutu program studi, dan tata kelola ' . $facultyName . ' di Universitas Fort De Kock.',
                    'content_html' => $detail?->content_html ?: $this->fallbackFacultyContent($faculty, $dosen),
                    'academic_link_items' => $detail?->academic_link_items ?: [],
                ];
            });
    }

    private function deanDosen(?string $name): ?Dosen
    {
        if (! filled($name)) {
            return null;
        }

        $normalizedName = trim($name);
        $coreName = $this->corePersonName($normalizedName);
        $searchName = $this->searchablePersonName($normalizedName);

        $exactMatch = Dosen::query()
            ->where('nama', $normalizedName)
            ->orWhere('nama', 'like', '%' . $coreName . '%')
            ->orWhere('nama', 'like', '%' . $normalizedName . '%')
            ->orWhereRaw('? like CONCAT("%", nama, "%")', [$normalizedName])
            ->first();

        if ($exactMatch) {
            return $exactMatch;
        }

        $bestMatch = Dosen::query()
            ->whereNotNull('foto')
            ->get()
            ->map(function (Dosen $dosen) use ($searchName) {
                $dosenSearchName = $this->searchablePersonName($dosen->nama);

                return [
                    'dosen' => $dosen,
                    'score' => $this->personNameScore($searchName, $dosenSearchName),
                ];
            })
            ->filter(fn (array $match) => $match['score'] >= 70)
            ->sortByDesc('score')
            ->first();

        if ($bestMatch) {
            return $bestMatch['dosen'];
        }

        return Dosen::query()
            ->where('jabatan', 'like', '%Dekan%')
            ->whereNotNull('foto')
            ->first();
    }

    private function deanCivitas(?string $name): ?Civitas
    {
        if (! filled($name)) {
            return null;
        }

        $normalizedName = trim($name);
        $coreName = $this->corePersonName($normalizedName);
        $searchName = $this->searchablePersonName($normalizedName);

        $exactMatch = Civitas::query()
            ->where('nama', $normalizedName)
            ->orWhere('nama', 'like', '%' . $coreName . '%')
            ->orWhere('nama', 'like', '%' . $normalizedName . '%')
            ->orWhereRaw('? like CONCAT("%", nama, "%")', [$normalizedName])
            ->first();

        if ($exactMatch?->foto_url) {
            return $exactMatch;
        }

        $bestMatch = Civitas::query()
            ->whereNotNull('foto')
            ->get()
            ->map(function (Civitas $civitas) use ($searchName) {
                $civitasSearchName = $this->searchablePersonName($civitas->nama);

                return [
                    'civitas' => $civitas,
                    'score' => $this->personNameScore($searchName, $civitasSearchName),
                ];
            })
            ->filter(fn (array $match) => $match['score'] >= 70)
            ->sortByDesc('score')
            ->first();

        if ($bestMatch) {
            return $bestMatch['civitas'];
        }

        return Civitas::query()
            ->where('jabatan', 'like', '%Dekan%')
            ->whereNotNull('foto')
            ->first();
    }

    private function searchablePersonName(?string $name): string
    {
        $name = strtolower((string) $name);
        $name = preg_replace('/\b(prof|dr|dra|drs|hj|h|ns|apt|assoc|professor)\b/u', ' ', $name);
        $name = preg_replace('/\b(sst|s\.st|skep|s\.kep|mkep|m\.kep|mkm|m\.biomed|mbiomed|mpd|m\.pd|m\.sc|msc|m\.kes|mkes|phd|s\.pd)\b/u', ' ', $name);
        $name = preg_replace('/[^a-z0-9]+/u', ' ', $name);

        return trim(preg_replace('/\s+/', ' ', $name));
    }

    private function corePersonName(string $name): string
    {
        $name = preg_replace('/,.*/', '', $name);
        $name = preg_replace('/\b(Prof|Dr|Dra|Drs|Hj|H|Ns|Apt|Assoc)\.?\b/i', ' ', $name);
        $name = preg_replace('/[^A-Za-z0-9]+/', ' ', (string) $name);

        return trim(preg_replace('/\s+/', ' ', (string) $name));
    }

    private function personNameScore(string $needle, string $candidate): int
    {
        if ($needle === '' || $candidate === '') {
            return 0;
        }

        if ($needle === $candidate) {
            return 100;
        }

        if (str_contains($needle, $candidate) || str_contains($candidate, $needle)) {
            return 90;
        }

        $needleTokens = collect(explode(' ', $needle))->filter(fn (string $token) => strlen($token) > 2)->unique();
        $candidateTokens = collect(explode(' ', $candidate))->filter(fn (string $token) => strlen($token) > 2)->unique();

        if ($needleTokens->isEmpty() || $candidateTokens->isEmpty()) {
            return 0;
        }

        $matches = $needleTokens->intersect($candidateTokens)->count();

        return (int) round(($matches / max($needleTokens->count(), $candidateTokens->count())) * 100);
    }

    private function roleLabel(?string $jabatan): string
    {
        $jabatan = strtolower((string) $jabatan);

        return match (true) {
            str_contains($jabatan, 'warek iii') || str_contains($jabatan, 'wakil rektor iii') => 'Wakil Rektor III',
            str_contains($jabatan, 'warek ii') || str_contains($jabatan, 'wakil rektor ii') => 'Wakil Rektor II',
            str_contains($jabatan, 'warek i') || str_contains($jabatan, 'wakil rektor i') => 'Wakil Rektor I',
            str_contains($jabatan, 'rektor') => 'Rektor',
            default => ucwords((string) $jabatan),
        };
    }

    private function defaultSummary(?string $jabatan): string
    {
        $descriptions = [
            'rektor' => 'Memimpin penyelenggaraan Tridharma Perguruan Tinggi serta tata kelola institusi secara menyeluruh.',
            'warek-i' => 'Wakil Rektor Bidang Akademik bertanggung jawab dalam pengembangan kurikulum, mutu pembelajaran, penelitian, dan program akademik.',
            'warek-ii' => 'Wakil Rektor Bidang Umum, SDM, dan Keuangan mengelola sumber daya manusia, tata kelola keuangan, sarana dan prasarana kampus.',
            'warek-iii' => 'Wakil Rektor Bidang Kemahasiswaan, Inovasi, dan Kerjasama membina organisasi mahasiswa, prestasi, kewirausahaan, serta kolaborasi eksternal.',
        ];

        return $descriptions[$this->roleSlug($jabatan)] ?? 'Informasi profil pimpinan akan segera dilengkapi.';
    }

    private function fallbackContent(Dosen $dosen): string
    {
        $name = e($dosen->nama);
        $position = e($this->roleLabel($dosen->jabatan));
        $education = e($dosen->pendidikan_terakhir ?: '-');
        $origin = e($dosen->asal_pendidikan ?: '-');
        $note = e($dosen->keterangan ?: 'Informasi detail profil dapat dilengkapi melalui menu Profil Pimpinan di admin.');

        return <<<HTML
<section class="profile-block">
    <h2>Identitas Diri</h2>
    <div class="identity-grid">
        <div><span>Nama Lengkap</span><strong>{$name}</strong></div>
        <div><span>Jabatan Struktural</span><strong>{$position}</strong></div>
        <div><span>Pendidikan Terakhir</span><strong>{$education}</strong></div>
        <div><span>Asal Pendidikan</span><strong>{$origin}</strong></div>
    </div>
</section>
<section class="profile-block">
    <h2>Profil Singkat</h2>
    <p>{$note}</p>
</section>
HTML;
    }

    private function fallbackFacultyContent(Fakultas $faculty, ?Dosen $dosen): string
    {
        $name = e($faculty->dekan);
        $facultyName = e($faculty->nama_fakultas ?: 'Fakultas');
        $facultyCode = e($faculty->kode_fakultas ?: '-');
        $education = e($dosen?->pendidikan_terakhir ?: '-');
        $origin = e($dosen?->asal_pendidikan ?: '-');
        $note = e($dosen?->keterangan ?: 'Informasi detail dekan dapat dilengkapi melalui menu Profil Pimpinan di admin dengan slug dekan-' . str($faculty->nama_fakultas)->slug()->value() . '.');

        return <<<HTML
<section class="profile-block">
    <h2>Identitas Diri</h2>
    <div class="identity-grid">
        <div><span>Nama Lengkap</span><strong>{$name}</strong></div>
        <div><span>Jabatan Struktural</span><strong>Dekan {$facultyName}</strong></div>
        <div><span>Fakultas</span><strong>{$facultyName}</strong></div>
        <div><span>Kode Fakultas</span><strong>{$facultyCode}</strong></div>
        <div><span>Pendidikan Terakhir</span><strong>{$education}</strong></div>
        <div><span>Asal Pendidikan</span><strong>{$origin}</strong></div>
    </div>
</section>
<section class="profile-block">
    <h2>Profil Singkat</h2>
    <p>{$note}</p>
</section>
HTML;
    }
}
