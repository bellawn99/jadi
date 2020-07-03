<?php

namespace App\Imports;

use App\Jadwal;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class JadwalImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     $a = Role::select('id')->where('role','mahasiswa')->get()->first()->toArray();
    //     $b = Carbon::now()->format('ymd').rand(1000,9999);
    //     return new User([
           

    //         'id' => $b,
    //         'role_id' => $a['id'],
    //         'nama' =>  $row[0],
    //         'username' =>  $row[1],
    //         'password' => \Hash::make( array_get($row, 'niu')),
    //     ]);
    // }

    public function collection(Collection $collection){
        foreach($collection as $key => $row){
            if($key>=1){
                $b = 'J'.Carbon::now()->format('ymdHi').rand(100,999);
                    Jadwal::create([    
                        'id' => $b,
                        'hari' => $row[0],
                        'jam_mulai' =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['1'])->format('H:i:s'),
                        'jam_akhir' =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['2'])->format('H:i:s'),
                    ]);
            }
        }
    }
}
