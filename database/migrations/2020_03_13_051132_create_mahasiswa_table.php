<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nik');
            $table->string('npwp');
            $table->string('jk');
            $table->string('tempat');
            $table->date('tgl_lahir');
            $table->string('alamat');
            $table->string('prodi');
            $table->string('status');
            $table->string('krs');
            $table->string('semester');
            $table->string('thn_lulus');
            $table->string('nama_bank');
            $table->string('no_rekening');
            $table->string('nama_rekening');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
}
