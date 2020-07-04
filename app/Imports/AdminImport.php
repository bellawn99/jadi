<?php

namespace App\Imports;

use App\User;
use App\Admin;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Role;
use Carbon\Carbon;
use Session;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AdminImport implements ToCollection
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
                if(User::where(['nama'=>$row[0],'username'=>substr ($row[1], 0, 6)])->exists()){
                    Session::flash('statuscode','error');
                    return redirect('admin/pengguna/user-admin')->with('status', 'Data Admin Sudah Ada Dalam Sistem');
                }else{
                $a = Role::select('id')->where('role','admin')->get()->first()->toArray();
                $b = Carbon::now()->format('ymd').rand(1000,9999);
                $c = 'A'.Carbon::now()->format('ymdHi').rand(100,999);
                User::create([
                    'id' => $b,
                    'role_id' => $a['id'],
                    'nama' =>  $row[0],
                    'username' =>  substr ($row[1], 0, 6),
                    'password' => \Hash::make($row[1]),
                ]);
                Admin::create([
                    'id' => $c,
                    'user_id' => $b,
                    'nip' => $row[1]
                ]);
                Session::flash('statuscode','success');
                return redirect('admin/pengguna/user-admin')->with('status', 'Berhasil Menambahkan Data Admin');
                }
            }
        }
    }
}