<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar', function (Blueprint $table) {
            $table->string('id',20)->primary();
            $table->string('user_id',20)->nullable();
            $table->integer('praktikum_id')->nullable()->unsigned();
            $table->enum('status',['menunggu','diproses','diterima','ditolak'])->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('praktikum_id')->references('id')->on('praktikum');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar');
    }
}
