<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('civitas', function (Blueprint $table) {
            $table->string('nip')->nullable()->unique()->after('id');
            $table->string('nik')->nullable()->unique()->after('nip');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->after('nama');
            $table->string('tempat_lahir')->nullable()->after('jenis_kelamin');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->string('pendidikan_terakhir')->nullable()->after('tanggal_lahir');
            $table->string('asal_pendidikan')->nullable()->after('pendidikan_terakhir');
            $table->date('tanggal_masuk_kerja')->nullable()->after('asal_pendidikan');
            $table->text('keterangan')->nullable()->after('jabatan');
            $table->string('unit')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('civitas', function (Blueprint $table) {
            $table->dropUnique(['nip']);
            $table->dropUnique(['nik']);
            $table->dropColumn([
                'nip',
                'nik',
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
                'pendidikan_terakhir',
                'asal_pendidikan',
                'tanggal_masuk_kerja',
                'keterangan',
            ]);
            $table->string('unit')->nullable(false)->change();
        });
    }
};
