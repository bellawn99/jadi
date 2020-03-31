<?php

use Illuminate\Database\Seeder;
use App\Ketentuan;

class KetentuansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ketentuan::create([
            'id' => 1,
            'ketentuan' => 'Mahasiswa aktif Universitas Gadjah Mada'
        ]);

        Ketentuan::create([
            'id' => 2,
            'ketentuan' => 'IPK minimal 3.00'
        ]);

        Ketentuan::create([
            'id' => 3,
            'ketentuan' => 'Minimal memperoleh nilai B pada matakuliah
            yang bersangkutan'
        ]);

        Ketentuan::create([
            'id' => 4,
            'ketentuan' => 'Pernah mengambil matakuliah yang sama atau
            disetarakan'
        ]);

        Ketentuan::create([
            'id' => 5,
            'ketentuan' => 'Tidak sedang mengulang matakuliah yang
            diasisteni'
        ]);
    }
}
