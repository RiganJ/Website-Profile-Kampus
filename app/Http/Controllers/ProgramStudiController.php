<?php

namespace App\Http\Controllers;

use App\Models\Accreditation;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    protected function latestAccreditationFor(?Prodi $prodiProfile, string $namaProdi)
    {
        return Accreditation::query()
            ->where('accreditation_type', 'program_studi')
            ->where(function ($query) use ($prodiProfile, $namaProdi) {
                if ($prodiProfile) {
                    $query->where('prodi_id', $prodiProfile->id)
                        ->orWhere('program_studi', $prodiProfile->nama_prodi);
                } else {
                    $query->where('program_studi', $namaProdi);
                }
            })
            ->latest()
            ->first();
    }

    protected function prodiProfile(string $namaProdi): ?Prodi
    {
        return Prodi::query()
            ->with(['dosen', 'kaprodiDosen', 'adminProdi', 'laborans', 'fakultas'])
            ->where('nama_prodi', $namaProdi)
            ->first();
    }

    /**
     * Program Studi S2 Kesehatan Masyarakat
     */
    public function s2Kesmas()
    {
        $prodiProfile = $this->prodiProfile('S2 Kesehatan Masyarakat');
        $accreditation = $this->latestAccreditationFor($prodiProfile, 'S2 Kesehatan Masyarakat');

        return view('prodi.pasca-sarjana.s2-kesmas', compact('accreditation', 'prodiProfile'));
    }
    public function profesiners()
    {
        $prodiProfile = $this->prodiProfile('Profesi Ners');
        $accreditation = $this->latestAccreditationFor($prodiProfile, 'Profesi Ners');

        return view('prodi.profesi.profesiners', compact('accreditation', 'prodiProfile'));
    }
    public function profesibidan()
    {
        $prodiProfile = $this->prodiProfile('Profesi Bidan');
        $accreditation = $this->latestAccreditationFor($prodiProfile, 'Profesi Bidan');

        return view('prodi.profesi.profesibidan', compact('accreditation', 'prodiProfile'));
    }
    public function s1kesmas()
    {
        $prodiProfile = $this->prodiProfile('S1 Kesehatan Masyarakat');
        $accreditation = $this->latestAccreditationFor($prodiProfile, 'S1 Kesehatan Masyarakat');

        return view('prodi.sarjana.s1-kesmas', compact('accreditation', 'prodiProfile'));
    }
    public function s1bidan()
    {
        $prodiProfile = $this->prodiProfile('S1 Kebidanan');
        $accreditation = $this->latestAccreditationFor($prodiProfile, 'S1 Kebidanan');

        return view('prodi.sarjana.s1-bidan', compact('accreditation', 'prodiProfile'));
    }
        public function s1perawat()
    {
        $prodiProfile = $this->prodiProfile('S1 Keperawatan');
        $accreditation = $this->latestAccreditationFor($prodiProfile, 'S1 Keperawatan');

        return view('prodi.sarjana.s1-keperawatan', compact('accreditation', 'prodiProfile'));
    }
        public function s1farmasi()
    {
        $prodiProfile = $this->prodiProfile('S1 Farmasi');
        $accreditation = $this->latestAccreditationFor($prodiProfile, 'S1 Farmasi');

        return view('prodi.sarjana.s1-farmasi', compact('accreditation', 'prodiProfile'));
    }
        public function s1psikologi()
    {
        $prodiProfile = $this->prodiProfile('S1 Psikologi');
        $accreditation = $this->latestAccreditationFor($prodiProfile, 'S1 Psikologi');

        return view('prodi.sarjana.s1-psikologi', compact('accreditation', 'prodiProfile'));
    }
        public function s1fisiotrapi()
    {
        $prodiProfile = $this->prodiProfile('S1 Fisioterapi');
        $accreditation = $this->latestAccreditationFor($prodiProfile, 'S1 Fisioterapi');

        return view('prodi.sarjana.s1-fisiotrapi', compact('accreditation', 'prodiProfile'));
    }
        public function s1bisdig()
    {
        $prodiProfile = $this->prodiProfile('S1 Bisnis Digital');
        $accreditation = $this->latestAccreditationFor($prodiProfile, 'S1 Bisnis Digital');

        return view('prodi.sarjana.s1-bisnisdigital', compact('accreditation', 'prodiProfile'));
    }
        public function s1pariwisata()
    {
        $prodiProfile = $this->prodiProfile('S1 Pariwisata');
        $accreditation = $this->latestAccreditationFor($prodiProfile, 'S1 Pariwisata');

        return view('prodi.sarjana.s1-pariwisata', compact('accreditation', 'prodiProfile'));
    }
        public function s1dkv()
    {
        $prodiProfile = $this->prodiProfile('S1 Desain Komunikasi Visual');
        $accreditation = $this->latestAccreditationFor($prodiProfile, 'S1 Desain Komunikasi Visual');

        return view('prodi.sarjana.s1-dkv', compact('accreditation', 'prodiProfile'));
    }

    public function s1hukum()
    {
        $prodiProfile = $this->prodiProfile('S1 Hukum');
        $accreditation = $this->latestAccreditationFor($prodiProfile, 'S1 Hukum');

        return view('prodi.sarjana.s1-hukum', compact('accreditation', 'prodiProfile'));
    }

    public function s1kewirausahaan()
    {
        $prodiProfile = $this->prodiProfile('S1 Kewirausahaan');
        $accreditation = $this->latestAccreditationFor($prodiProfile, 'S1 Kewirausahaan');

        return view('prodi.sarjana.s1-kewirausahaan', compact('accreditation', 'prodiProfile'));
    }

    
    public function d3fisioterapi()
    {
        $prodiProfile = $this->prodiProfile('D3 Fisioterapi');
        $accreditation = $this->latestAccreditationFor($prodiProfile, 'D3 Fisioterapi');

        return view('prodi.diploma.d3-fisioterapi', compact('accreditation', 'prodiProfile'));
    }

    
}
