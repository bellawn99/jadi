<?php

use Illuminate\Database\Seeder;
use App\Dosen;
use Carbon\Carbon;

class DosensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dosen::create([
            'id' => 'D'.Carbon::now()->format('ymdHi').rand(100,999),
            'nidn' => '0005058902',
            'nama' => 'Irkham Huda',
            'no_hp' => '081804030301',
            'alamat' => 'Yogyakarta'

        ]);
        Dosen::create([
            'id' => 'D'.Carbon::now()->format('ymdHi').rand(100,999),
            'nidn' => '0012018803',
            'nama' => 'Imam Fahrurrozi',
            'no_hp' => '087738838888',
            'alamat' => 'Yogyakarta'
            ]);
    }
}
