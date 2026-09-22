<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Berita;
use Carbon\Carbon;

class BeritaSeeder extends Seeder
{
    public function run()
    {
        $dummyBerita = [
            [
                'judul' => 'Mahasiswa Berprestasi Raih Medali Emas',
                'kategori' => Berita::KATEGORI_PRESTASI_TERBARU,
                'thumbnail' => 'prestasi1.jpg',
                'konten' => '<p>Mahasiswa Politeknik berprestasi meraih medali emas di tingkat nasional.</p>',
                'tanggal' => Carbon::now()->subDays(3),
            ],
            [
                'judul' => 'Riset Unggulan AI untuk Pendidikan',
                'kategori' => Berita::KATEGORI_RISET_UNGGULAN,
                'thumbnail' => 'riset1.jpg',
                'konten' => '<p>Penelitian terbaru tentang pemanfaatan AI untuk meningkatkan kualitas pembelajaran.</p>',
                'tanggal' => Carbon::now()->subDays(5),
            ],
            [
                'judul' => 'Academic Reset Day 2026, PCR Perkuat Mutu Pembelajaran',
                'kategori' => Berita::KATEGORI_BERITA_TERKINI,
                'thumbnail' => 'berita1.jpg',
                'konten' => '<p>Acara Academic Reset Day memperkuat mutu pembelajaran di kampus.</p>',
                'tanggal' => Carbon::now()->subDays(10),
            ],
            [
                'judul' => 'Rakor dan RTM 2026 Bahas Target Kinerja Institusi',
                'kategori' => Berita::KATEGORI_BERITA_TERKINI,
                'thumbnail' => 'berita2.jpg',
                'konten' => '<p>Rapat koordinasi membahas target kinerja dan transformasi institusi.</p>',
                'tanggal' => Carbon::now()->subDays(15),
            ],
            [
                'judul' => 'PCR Raih 3 Juara Nasional IPEC 2025',
                'kategori' => Berita::KATEGORI_PRESTASI_TERBARU,
                'thumbnail' => 'prestasi2.jpg',
                'konten' => '<p>Tim PCR berhasil meraih 3 juara nasional dalam kompetisi IPEC.</p>',
                'tanggal' => Carbon::now()->subDays(20),
            ],
        ];

        foreach ($dummyBerita as $data) {
            Berita::create([
                'judul' => $data['judul'],
                'slug' => Str::slug($data['judul']),
                'kategori' => $data['kategori'],
                'thumbnail' => $data['thumbnail'],
                'konten' => $data['konten'],
                'tanggal' => $data['tanggal'],
            ]);
        }
    }
}
