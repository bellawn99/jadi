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
            $table->string('id',20)->primary();
            $table->string('user_id')->nullable();
            $table->string('nik');
            $table->string('npwp')->nullable();
            $table->enum('jk',['P','L']);
            $table->string('tempat');
            $table->date('tgl_lahir');
            $table->string('alamat');
            $table->string('prodi');
            $table->string('status');
            $table->string('krs');
            $table->integer('semester');
            $table->string('thn_lulus');
            $table->string('nama_bank');
            $table->string('no_rekening')->unique();
            $table->string('nama_rekening');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('user');
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
