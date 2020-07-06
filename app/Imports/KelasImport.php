<?php

namespace App\Imports;

use App\Kelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Session;
use App\Validator;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class KelasImport implements ToCollection
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
		$total_data=0;
		$berhasil=0;
        $gagal=0;
        
        // \Validator::make($collection->toArray(), [
        //     '*' => 'string','required',
        // ],
        // ['*.string' => 'Nama Kelas Baris :attribute Harus String',
        // '*.required'=> 'Nama Kelas Harus Diisi'])->validate();

        $rules = ['0' => 'regex:/(^([a-zA-Z]+)(\d+)?$)/u'];

        $pesan = ['0.regex' => 'Nama Kelas Hanya Alfabet Dan Spasi'];

        foreach($collection as $key => $row){
            if($key>=1){
                $validator = \Validator::make($row->toArray(),$rules,$pesan);
                if($validator->fails()){ $gagal++; continue; }
                if(Kelas::where(['nama'=>$row[0]])->exists()){
                    $gagal++;
                }
				else{
					$b = 'K'.Carbon::now()->format('ymdHi').rand(100,999);
                    Kelas::create([    
                        'id' => $b,
                        'nama' => $row[0]
                    ]);
					$berhasil++;
                }
				$total_data++;
            }
        }
        if($berhasil==0 && $gagal>0){
            Session::flash('statuscode','error');
            return redirect('admin/master/kelas')->with('status', "Gagal menambahkan ".$gagal." data"); 
        }elseif($gagal>0 && $berhasil>0){
            Session::flash('statuscode','error');
            return redirect('admin/master/kelas')->with('status', "Berhasil menambahkan ".$berhasil." data. Gagal menambahkan ".$gagal." data"); 
        }elseif($gagal==0){
            Session::flash('statuscode','success');
            return redirect('admin/master/kelas')->with('status', "Berhasil menambahkan ".$berhasil." data");
        }
		// $status = "Dari Total Data: ".$total_data." Data berhasil ditambahkan: ".$berhasil." Data gagal ditambahkan: ".$gagal;
        
        
    }
}
