<?php

use Illuminate\Database\Seeder;
use App\Periode;
use Carbon\Carbon;

class PeriodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    

        Periode::create([
            'id' => 'P'.Carbon::now()->format('ymdHi').rand(100,999),
            'tgl_mulai' => '2020-01-15',
            'tgl_selesai' => '2020-01-30',
            'thn_ajaran' => '2019/2020',
            'semester' => 'genap',
            'status' => 'daftar',
            'created_at' => '2020-01-15'
        ]);
    }
}
