<?php

use App\Models\Berita;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('berita')
            ->where('kategori', 'berita')
            ->update(['kategori' => Berita::KATEGORI_BERITA_TERKINI]);

        DB::table('berita')
            ->where('kategori', 'prestasi')
            ->update(['kategori' => Berita::KATEGORI_PRESTASI_TERBARU]);

        DB::table('berita')
            ->where('kategori', 'riset')
            ->update(['kategori' => Berita::KATEGORI_RISET_UNGGULAN]);

        DB::statement("
            ALTER TABLE berita
            MODIFY kategori ENUM('berita terkini', 'prestasi terbaru', 'riset unggulan')
            NOT NULL DEFAULT 'berita terkini'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE berita
            MODIFY kategori ENUM('berita', 'prestasi', 'riset')
            NOT NULL DEFAULT 'berita'
        ");

        DB::table('berita')
            ->where('kategori', Berita::KATEGORI_BERITA_TERKINI)
            ->update(['kategori' => 'berita']);

        DB::table('berita')
            ->where('kategori', Berita::KATEGORI_PRESTASI_TERBARU)
            ->update(['kategori' => 'prestasi']);

        DB::table('berita')
            ->where('kategori', Berita::KATEGORI_RISET_UNGGULAN)
            ->update(['kategori' => 'riset']);
    }
};
