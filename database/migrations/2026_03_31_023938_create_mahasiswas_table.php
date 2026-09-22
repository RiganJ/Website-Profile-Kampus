<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

public function up()
{

Schema::create('mahasiswas', function (Blueprint $table) {

$table->id();

$table->string('nama');

$table->string('nim');

$table->foreignId('prodi_id');

$table->year('angkatan');

$table->timestamps();

});
}



public function down()
{

Schema::table('mahasiswas', function (Blueprint $table) {

$table->dropColumn('jenis_kelamin');

});

}

};