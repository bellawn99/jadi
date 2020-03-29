<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(DosensTableSeeder::class);
        $this->call(MatkulsTableSeeder::class);
        $this->call(RuangansTableSeeder::class);
        $this->call(JadwalsTableSeeder::class);
        $this->call(KelassTableSeeder::class);
    }
}
