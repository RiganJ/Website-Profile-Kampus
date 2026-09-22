<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosens', function (Blueprint $table) {

            $table->id();

            $table->string('nip')->unique();

            $table->string('nik')->unique();

            $table->string('nama');

            $table->enum('jenis_kelamin', ['L','P']);

            $table->string('tempat_lahir');

            $table->date('tanggal_lahir');

            $table->string('pendidikan_terakhir');

            $table->string('asal_pendidikan');

            $table->date('tanggal_masuk_kerja');

            $table->string('jabatan');

            $table->text('keterangan')->nullable();

            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};