<?php

use Illuminate\Database\Seeder;
use App\Kelas;
use App\Dosen;
use App\Matkul;
use App\Jadwal;
use App\Ruangan;
use Carbon\Carbon;

class KelassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $a = Dosen::select('id')->where('nidn','0005058902')->get()->first();
        $b = Dosen::select('id')->where('nidn','0012018803')->get()->first();

        $c = Matkul::select('id')->where('kode_vmk','V3KI2212')->get()->first();
        $d = Matkul::select('id')->where('kode_vmk','VMK 1204')->get()->first();

        $e = Jadwal::select('id')->where('hari','Rabu')->get()->first();
        $f = Jadwal::select('id')->where('hari','Kamis')->get()->first();

        $g = Ruangan::select('id')->where('nama_ruangan','HY Labkom 5')->get()->first();
        $h = Ruangan::select('id')->where('nama_ruangan','HY RPL 1')->get()->first();

        Kelas::create([
            'id' => 'K'.Carbon::now()->format('ymdHi').rand(100,999),
            'dosen_id' => $a->id,
            'matkul_id' => $c->id,
            'jadwal_id' => $e->id,
            'ruangan_id' => $g->id,
            'nama' => 'BB',
            'semester' => 4
        ]);
        Kelas::create([
            'id' => 'K'.Carbon::now()->format('ymdHi').rand(100,999),
            'dosen_id' => $b->id,
            'matkul_id' => $d->id,
            'jadwal_id' => $f->id,
            'ruangan_id' => $h->id,
            'nama' => 'AB',
            'semester' => 1
            ]);
    }
}
