<?php

namespace App\Imports;

use App\Matkul;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Session;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MatkulImport implements ToCollection
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
                if(Matkul::where(['kode_vmk'=>$row[0],'nama_matkul'=>$row[1],'sks'=>$row[2]])->exists()){
                    Session::flash('statuscode','error');
                    return redirect('admin/master/matkul')->with('status', 'Data Matakuliah Sudah Ada Dalam Sistem');
                }else{
                $b = 'M'.Carbon::now()->format('ymdHi').rand(100,999);
                    Matkul::create([    
                        'id' => $b,
                        'kode_vmk' => $row[0],
                        'nama_matkul' =>  $row[1],
                        'sks' =>  $row[2]
                    ]);
                    Session::flash('statuscode','success');
                    return redirect('admin/master/matkul')->with('status', 'Berhasil Menambahkan Data Matakuliah');
                }
            }
        }
    }
}
