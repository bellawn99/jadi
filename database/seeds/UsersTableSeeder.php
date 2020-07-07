<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'id' => \Carbon\Carbon::now()->format('ymd').rand(1000,9999),
            'email' => 'admin@mail.com',
            'nama' => 'Admin',
            'username' => '123456',
            'password' => bcrypt('123456'),
            'no_hp' => '0877380088068',
            'foto' => 'avatar.png',
            'role' => 'Admin',
            'created_at' => Carbon::now()
        ]);

        User::create([
            'id' => \Carbon\Carbon::now()->format('ymd').rand(1000,9999),
            'email' => 'bwulan99@gmail.com',
            'nama' => 'Bella Wulan N',
            'username' => '410828',
            'password' => bcrypt('410828'),
            'no_hp' => '081804007078',
            'foto' => 'avatar.png',
            'role' => 'Mahasiswa',
            'created_at' => Carbon::now()
        ]);

    }
}
