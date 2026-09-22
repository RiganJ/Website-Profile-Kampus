<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('accreditations') || ! Schema::hasTable('prodi')) {
            return;
        }

        $prodiRows = DB::table('prodi')->get(['id', 'nama_prodi']);

        foreach ($prodiRows as $prodi) {
            DB::table('accreditations')
                ->whereNull('prodi_id')
                ->where('program_studi', $prodi->nama_prodi)
                ->update([
                    'accreditation_type' => 'program_studi',
                    'prodi_id' => $prodi->id,
                ]);
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('accreditations')) {
            return;
        }

        DB::table('accreditations')->update(['prodi_id' => null]);
    }
};
