<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private array $allowedValues = [
        'S2 Kesehatan Masyarakat',
        'Profesi Ners',
        'Profesi Bidan',
        'S1 Kesehatan Masyarakat',
        'S1 Keperawatan',
        'S1 Kebidanan',
        'S1 Farmasi',
        'S1 Psikologi',
        'S1 Fisioterapi',
        'S1 Bisnis Digital',
        'S1 Kewirausahaan',
        'S1 Desain Komunikasi Visual',
        'S1 Hukum',
        'S1 Pariwisata',
        'D3 Fisioterapi',
    ];

    public function up(): void
    {
        DB::statement("
            UPDATE prodi
            SET nama_prodi = CASE LOWER(TRIM(nama_prodi))
                WHEN 's2 kesehatan masyarakat' THEN 'S2 Kesehatan Masyarakat'
                WHEN 'profesi ners' THEN 'Profesi Ners'
                WHEN 'profesi bidan' THEN 'Profesi Bidan'
                WHEN 's1 kesehatan masyarakat' THEN 'S1 Kesehatan Masyarakat'
                WHEN 'kesehatan masyarakat' THEN 'S1 Kesehatan Masyarakat'
                WHEN 's1 keperawatan' THEN 'S1 Keperawatan'
                WHEN 'keperawatan' THEN 'S1 Keperawatan'
                WHEN 's1 kebidanan' THEN 'S1 Kebidanan'
                WHEN 'kebidanan' THEN 'S1 Kebidanan'
                WHEN 's1 farmasi' THEN 'S1 Farmasi'
                WHEN 'farmasi' THEN 'S1 Farmasi'
                WHEN 's1 psikologi' THEN 'S1 Psikologi'
                WHEN 'psikologi' THEN 'S1 Psikologi'
                WHEN 's1 fisioterapi' THEN 'S1 Fisioterapi'
                WHEN 'fisioterapi' THEN 'S1 Fisioterapi'
                WHEN 's1 bisnis digital' THEN 'S1 Bisnis Digital'
                WHEN 'bisnis digital' THEN 'S1 Bisnis Digital'
                WHEN 's1 kewirausahaan' THEN 'S1 Kewirausahaan'
                WHEN 'kewirausahaan' THEN 'S1 Kewirausahaan'
                WHEN 's1 desain komunikasi visual' THEN 'S1 Desain Komunikasi Visual'
                WHEN 'desain komunikasi visual' THEN 'S1 Desain Komunikasi Visual'
                WHEN 's1 hukum' THEN 'S1 Hukum'
                WHEN 'hukum' THEN 'S1 Hukum'
                WHEN 's1 pariwisata' THEN 'S1 Pariwisata'
                WHEN 'pariwisata' THEN 'S1 Pariwisata'
                WHEN 'd3 fisioterapi' THEN 'D3 Fisioterapi'
                ELSE nama_prodi
            END
        ");

        $enumValues = collect($this->allowedValues)
            ->map(fn (string $value) => "'" . str_replace("'", "''", $value) . "'")
            ->implode(', ');

        DB::statement("ALTER TABLE prodi MODIFY nama_prodi ENUM($enumValues) NOT NULL");
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE prodi MODIFY nama_prodi VARCHAR(255) NOT NULL');
    }
};
