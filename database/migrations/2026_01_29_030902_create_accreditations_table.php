<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('accreditations', function (Blueprint $table) {
            $table->id();
            $table->string('program_studi');
            $table->string('predicate'); // Baik, Baik Sekali, Unggul
            $table->year('tahun');
            $table->string('lembaga')->nullable(); // LAM-PTKes dll
            $table->string('file'); // path pdf
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accreditations');
    }
};
