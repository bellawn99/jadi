<?php

use Illuminate\Database\Seeder;
use App\Mahasiswa;
use App\User;
use Carbon\Carbon;

class MahasiswasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = User::select('id')->where('role_id', 2 )->get()->first();

        Mahasiswa::create([
            'id' => 'M'.Carbon::now()->format('ymdHi').rand(100,999),
            'user_id' => $a->id,
            'nik' => '3402100031199001',
            'npwp' => '00',
            'jk' => 'P',
            'tempat' => 'Bantul',
            'tgl_lahir' => '1999-11-03',
            'alamat' => 'Bantul',
            'prodi' => 'Komsi',
            'status' => 'Mahasiswa',
            'krs' => 'ini.pdf',
            'semester' => 6,
            'thn_lulus' => ' ',
            'nama_bank' => 'BNI',
            'no_rekening' => '00123',
            'nama_rekening' => 'Mahasiswa'



        ]);
    }
}
