<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->unsignedInteger('role_id');
            $table->string('nama')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('no_hp')->unique()->nullable();
            $table->string('foto')->nullable()->default('avatar.png');;
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('role', function (Blueprint $kolom) {
            $kolom->increments('id');
            $kolom->string('role');
        });

        Schema::table('user', function (Blueprint $kolom) {
            $kolom->foreign('role_id')->references('id')->on('role')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user');
        Schema::drop('role');
    }
}
