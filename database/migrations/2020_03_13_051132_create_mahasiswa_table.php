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
            $table->string('user_id');
            $table->string('nik')->nullable();
            $table->string('npwp')->nullable();
            $table->enum('jk',['P','L'])->nullable();
            $table->string('tempat')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('prodi')->nullable();
            $table->string('status')->nullable();
            $table->string('krs')->nullable();
            $table->integer('semester')->nullable();
            $table->string('thn_lulus')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('no_rekening')->unique()->nullable();
            $table->string('nama_rekening')->nullable();
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
