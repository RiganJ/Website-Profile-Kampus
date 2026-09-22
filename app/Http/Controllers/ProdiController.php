<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdiController extends Controller
{
    // Halaman daftar semua fakultas dan prodi
    public function index()
    {
        // Contoh data fakultas + prodi
        $fakultas = [
            [
                'nama_fakultas' => 'Fakultas Sains & Teknologi',
                'prodi' => [
                    [
                        'nama_prodi' => 'Teknik Informatika',
                        'slug' => 'teknik-informatika',
                        'foto' => 'ti.jpg',
                        'deskripsi_singkat' => 'Belajar software dan hardware.',
                    ],
                    [
                        'nama_prodi' => 'Sistem Informasi',
                        'slug' => 'sistem-informasi',
                        'foto' => 'si.jpg',
                        'deskripsi_singkat' => 'Fokus pada manajemen informasi & data.',
                    ],
                ],
            ],
            [
                'nama_fakultas' => 'Fakultas Ekonomi & Bisnis',
                'prodi' => [
                    [
                        'nama_prodi' => 'Manajemen',
                        'slug' => 'manajemen',
                        'foto' => 'manajemen.jpg',
                        'deskripsi_singkat' => 'Belajar strategi bisnis & organisasi.',
                    ],
                    [
                        'nama_prodi' => 'Akuntansi',
                        'slug' => 'akuntansi',
                        'foto' => 'akuntansi.jpg',
                        'deskripsi_singkat' => 'Belajar pembukuan dan laporan keuangan.',
                    ],
                ],
            ],
        ];

        return view('prodi', compact('fakultas'));
    }

    // Halaman detail prodi
    public function show($slug)
    {
        // Contoh data prodi detail
        $prodiDetail = [
            'teknik-informatika' => [
                'nama_prodi' => 'Teknik Informatika',
                'deskripsi' => 'Prodi Teknik Informatika fokus pada pengembangan software, sistem komputer, jaringan, dan teknologi terkini.',
                'foto' => 'ti.jpg',
            ],
            'sistem-informasi' => [
                'nama_prodi' => 'Sistem Informasi',
                'deskripsi' => 'Prodi Sistem Informasi mempelajari analisis data, manajemen informasi, dan sistem pendukung keputusan.',
                'foto' => 'si.jpg',
            ],
            'manajemen' => [
                'nama_prodi' => 'Manajemen',
                'deskripsi' => 'Prodi Manajemen fokus pada strategi bisnis, organisasi, dan kepemimpinan.',
                'foto' => 'manajemen.jpg',
            ],
            'akuntansi' => [
                'nama_prodi' => 'Akuntansi',
                'deskripsi' => 'Prodi Akuntansi fokus pada pembukuan, laporan keuangan, dan audit.',
                'foto' => 'akuntansi.jpg',
            ],
        ];

        if(!isset($prodiDetail[$slug])){
            abort(404);
        }

        $prodi = $prodiDetail[$slug];

        return view('prodi-detail', compact('prodi'));
    }
}