<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prodi_laboran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id');
            $table->unsignedBigInteger('civitas_id');
            $table->timestamps();
            $table->unique(['prodi_id', 'civitas_id']);
            $table->index('civitas_id');
        });

        if (Schema::hasColumn('prodi', 'laboran_civitas_id')) {
            DB::table('prodi')
                ->whereNotNull('laboran_civitas_id')
                ->orderBy('id')
                ->each(function ($prodi) {
                    DB::table('prodi_laboran')->insertOrIgnore([
                        'prodi_id' => $prodi->id,
                        'civitas_id' => $prodi->laboran_civitas_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('prodi_laboran');
    }
};
