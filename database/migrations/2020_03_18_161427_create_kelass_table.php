<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->string('id',20)->primary();
            $table->string('dosen_id',20)->nullable();
            $table->string('matkul_id',20)->nullable();
            $table->string('jadwal_id',20)->nullable();
            $table->string('nama');
            $table->integer('semester');
            $table->timestamps();
            $table->foreign('dosen_id')->references('id')->on('dosen');
            $table->foreign('matkul_id')->references('id')->on('matkul');
            $table->foreign('jadwal_id')->references('id')->on('jadwal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
