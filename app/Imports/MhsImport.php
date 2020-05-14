<?php

namespace App\Imports;

use App\User;
use App\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Role;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MhsImport implements ToCollection
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
                $a = Role::select('id')->where('role','admin')->get()->first()->toArray();
        $b = Carbon::now()->format('ymd').rand(1000,9999);
        $c = 'M'.Carbon::now()->format('ymdHi').rand(100,999);
        User::create([
            'id' => $b,
            'role_id' => $a['id'],
            'nama' =>  $row[0],
            'username' =>  $row[1],
            'password' => \Hash::make($row[1]),
        ]);
        Mahasiswa::create([
            'id' => $c,
            'user_id' => $b,
            'nim' => $row[1]
        ]);
            }
        }
    }
}
