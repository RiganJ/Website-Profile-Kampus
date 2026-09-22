<?php

namespace App\Http\Controllers;

use App\Models\Accreditation;
use App\Models\Prodi;

class SejarahController extends Controller
{
    public function index()
    {
        $accreditations = Accreditation::query()
            ->where('accreditation_type', 'program_studi')
            ->select(['id', 'prodi_id', 'program_studi', 'predicate', 'tahun', 'lembaga', 'file'])
            ->orderByDesc('tahun')
            ->orderByDesc('id')
            ->get();

        $prodiCards = Prodi::query()
            ->with('fakultas:id,nama_fakultas')
            ->orderBy('fakultas_id')
            ->orderBy('nama_prodi')
            ->get(['id', 'nama_prodi', 'kode_prodi', 'fakultas_id'])
            ->map(function (Prodi $prodi) use ($accreditations) {
                $accreditation = $this->findMatchedAccreditation($prodi, $accreditations);
                $jenjang = $this->inferJenjang($prodi->kode_prodi, $prodi->nama_prodi);

                return [
                    'icon' => $this->iconForProgram($prodi->nama_prodi),
                    'fakultas' => $prodi->fakultas?->nama_fakultas ?: 'Fakultas Lainnya',
                    'jenjang' => $jenjang,
                    'nama' => $this->cleanProgramName($prodi->nama_prodi),
                    'status' => 'Aktif',
                    'akred' => strtoupper($accreditation->predicate ?? 'BELUM TERSEDIA'),
                    'tahun' => $accreditation->tahun ?? null,
                    'lembaga' => $accreditation->lembaga ?? null,
                    'file_url' => $accreditation?->file_url,
                    'url' => $this->programUrl($prodi->nama_prodi),
                ];
            });

        $prodiGroups = $prodiCards->groupBy('fakultas');

        return view('sejarah', compact('prodiCards', 'prodiGroups'));
    }

    private function inferJenjang(?string $kodeProdi, ?string $namaProdi): string
    {
        $kode = strtoupper((string) $kodeProdi);
        $nama = strtoupper((string) $namaProdi);

        if (str_contains($kode, 'S2') || str_contains($nama, 'MAGISTER')) {
            return 'Magister (S2)';
        }

        if (str_contains($kode, 'S1') || str_contains($nama, 'SARJANA')) {
            return 'Sarjana (S1)';
        }

        if (str_contains($kode, 'D3') || str_contains($kode, 'D-3') || str_contains($nama, 'DIPLOMA')) {
            return 'Diploma 3 (D3)';
        }

        if (str_contains($nama, 'PROFESI') || str_contains($nama, 'NERS') || str_contains($nama, 'BIDAN')) {
            return 'Profesi';
        }

        return 'Program Studi';
    }

    private function iconForJenjang(string $jenjang): string
    {
        $jenjang = strtoupper($jenjang);

        if (str_contains($jenjang, 'S2')) {
            return 'graduation-cap';
        }

        if (str_contains($jenjang, 'S1')) {
            return 'book-open';
        }

        if (str_contains($jenjang, 'D3')) {
            return 'briefcase-medical';
        }

        if (str_contains($jenjang, 'PROFESI')) {
            return 'shield-check';
        }

        return 'school';
    }

    private function iconForProgram(?string $namaProdi): string
    {
        $nama = strtoupper((string) $namaProdi);

        return match (true) {
            str_contains($nama, 'KESEHATAN MASYARAKAT') => 'activity',
            str_contains($nama, 'KEPERAWATAN') || str_contains($nama, 'NERS') => 'heart-pulse',
            str_contains($nama, 'KEBIDANAN') || str_contains($nama, 'BIDAN') => 'baby',
            str_contains($nama, 'FARMASI') => 'pill',
            str_contains($nama, 'FISIOTERAPI') => 'dumbbell',
            str_contains($nama, 'PSIKOLOGI') => 'brain',
            str_contains($nama, 'BISNIS DIGITAL') => 'monitor',
            str_contains($nama, 'KEWIRAUSAHAAN') => 'briefcase',
            str_contains($nama, 'DESAIN KOMUNIKASI VISUAL') => 'palette',
            str_contains($nama, 'HUKUM') => 'scale',
            str_contains($nama, 'PARIWISATA') => 'map',
            default => 'graduation-cap',
        };
    }

    private function findMatchedAccreditation(Prodi $prodi, $accreditations): ?Accreditation
    {
        $byProdiId = $accreditations->first(fn (Accreditation $accreditation) => (int) $accreditation->prodi_id === (int) $prodi->id);

        if ($byProdiId) {
            return $byProdiId;
        }

        $normalizedName = $this->normalizeProgramName($prodi->nama_prodi);
        $normalizedCode = $this->normalizeProgramName($prodi->kode_prodi ?? '');
        $aliases = $this->nameAliases($normalizedName);

        return $accreditations->first(function (Accreditation $accreditation) use ($normalizedName, $normalizedCode, $aliases) {
            $accName = $this->normalizeProgramName($accreditation->program_studi);

            if ($accName === '') {
                return false;
            }

            if ($normalizedName !== '' && (str_contains($accName, $normalizedName) || str_contains($normalizedName, $accName))) {
                return true;
            }

            if ($normalizedCode !== '' && (str_contains($accName, $normalizedCode) || str_contains($normalizedCode, $accName))) {
                return true;
            }

            foreach ($aliases as $alias) {
                if ($alias !== '' && str_contains($accName, $alias)) {
                    return true;
                }
            }

            return false;
        });
    }

    private function nameAliases(string $normalizedName): array
    {
        $aliases = [];

        if (str_contains($normalizedName, 'kesehatanmasyarakat')) {
            $aliases[] = 'kesmas';
        }

        if (str_contains($normalizedName, 'desainkomunikasivisual')) {
            $aliases[] = 'dkv';
        }

        if (str_contains($normalizedName, 'kebidanan')) {
            $aliases[] = 'bidan';
        }

        if (str_contains($normalizedName, 'keperawatan')) {
            $aliases[] = 'ners';
        }

        if (str_contains($normalizedName, 'bisnisdigital')) {
            $aliases[] = 'bisdig';
        }

        return $aliases;
    }

    private function normalizeProgramName(?string $value): string
    {
        $value = strtolower((string) $value);
        $value = preg_replace('/[^a-z0-9]+/i', '', $value) ?? '';

        return trim($value);
    }

    private function cleanProgramName(?string $namaProdi): string
    {
        $nama = trim((string) $namaProdi);
        $nama = preg_replace('/^\s*(s1|s2|d3|d-3|profesi)\s*/i', '', $nama) ?? $nama;

        return trim($nama);
    }

    private function programUrl(?string $namaProdi): string
    {
        return match ($this->normalizeProgramName($namaProdi)) {
            's2kesehatanmasyarakat', 'magisterkesehatanmasyarakat' => route('prodi.pasca-sarjana.s2.kesmas', [], false),
            'profesiners', 'ners' => route('prodi.proefsiners', [], false),
            'profesibidan', 'bidanprofesi' => route('prodi.profesibidan', [], false),
            's1kesehatanmasyarakat', 'sarjanakesehatanmasyarakat' => route('prodi.sarjana.s1.kesmas', [], false),
            's1keperawatan', 'sarjanakeperawatan' => route('prodi.sarjana.s1.keperawatan', [], false),
            's1kebidanan', 'sarjanakebidanan' => route('prodi.sarjana.s1.bidan', [], false),
            's1farmasi', 'sarjanafarmasi' => route('prodi.sarjana.s1.farmasi', [], false),
            's1psikologi', 'sarjanapsikologi' => route('prodi.sarjana.s1.psikologi', [], false),
            's1fisioterapi', 'sarjanafisioterapi' => route('prodi.sarjana.s1.fisiotrapi', [], false),
            's1bisnisdigital', 'sarjanabisnisdigital' => route('prodi.sarjana.s1.bisnisdigital', [], false),
            's1kewirausahaan', 'sarjanakewirausahaan' => route('prodi.sarjana.s1.kewirausahaan', [], false),
            's1desainkomunikasivisual', 'sarjanadesainkomunikasivisual', 'dkv' => route('prodi.sarjana.s1.dkv', [], false),
            's1hukum', 'sarjanahukum' => route('prodi.sarjana.s1.hukum', [], false),
            's1pariwisata', 'sarjanapariwisata' => route('prodi.sarjana.s1.pariwisata', [], false),
            'd3fisioterapi', 'diploma3fisioterapi', 'diplomafisioterapi' => route('prodi.diploma.d3.fisiotrapi', [], false),
            default => route('prodi.index', [], false),
        };
    }
}
