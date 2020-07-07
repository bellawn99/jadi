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
            $table->string('id',20)->primary();
            $table->string('email',50)->unique()->nullable();
            $table->string('nama',30)->unique();
            $table->string('username',10)->unique();
            $table->string('password',191);
            $table->string('no_hp',15)->unique()->nullable();
            $table->string('foto',30)->nullable()->default('avatar.png');
            $table->enum('role',['Admin','Mahasiswa']);
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
        Schema::drop('user');
        Schema::drop('role');
    }
}
