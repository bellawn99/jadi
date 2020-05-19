<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelas;
use App\Jadwal;
use App\Matkul;
use App\Dosen;
use App\Ruangan;
use App\Praktikum;
use App\Semester;
use App\Daftar;
use Session;
use Auth;
use Carbon\Carbon;

class DaftarController extends Controller
{
    public function index()
    {
        $daftars = Praktikum::leftJoin('dosen','praktikum.dosen_id','=','dosen.id')
        ->leftJoin('matkul','praktikum.matkul_id','=','matkul.id')
        ->leftJoin('jadwal','praktikum.jadwal_id','=','jadwal.id')
        ->leftJoin('ruangan','praktikum.ruangan_id','=','ruangan.id')
        ->leftJoin('daftar','daftar.praktikum_id','=','praktikum.id')
        ->join('kelas','praktikum.kelas_id','=','kelas.id')
        ->join('semester','praktikum.semester_id','=','semester.id')
        ->select('daftar.id as noDaftar','daftar.status','praktikum.id','kelas.id as id_kelas','praktikum.matkul_id','praktikum.jadwal_id','praktikum.dosen_id','praktikum.ruangan_id','kelas.nama','semester.semester','praktikum.kelas_id','jadwal.hari','jadwal.jam_mulai','jadwal.jam_akhir','praktikum.matkul_id','matkul.nama_matkul','dosen.id as id_dosen','dosen.nama as nama_dosen','jadwal.id as id_jadwal','ruangan.id as id_ruangan','ruangan.nama_ruangan')
        ->get();  
        
       // $status = Praktikum::leftJoint()->leftJoin('daftar','daftar.praktikum_id','=','praktikum.id')
       // ->select('status')->first();
        //return $daftars;
       return view('mahasiswa.daftar.daftar',compact('daftars'));        
    }

    public function store(Request $request){
    
        $a = Daftar::where(['user_id'=>Auth::user()->id])->get();

        //return $a[1];

        if($a->count() > 1){
            Session::flash('statuscode','error');
        return redirect('mahasiswa/daftar')->with('status', 'Gagal Mendaftar!');
        }else{
        

        $daftars = new Daftar;
        
        $b = 'D'.Carbon::now()->format('ymdHi').rand(100,999);

        $daftars->id = $b;
        $daftars->user_id = Auth::user()->id;
        $daftars->praktikum_id = $request->id;
        $daftars->status = 'daftar';

        $daftars->save();
        
        Session::flash('statuscode','success');
        return redirect('mahasiswa/daftar')->with('status', 'Berhasil Mendaftar');
        }
        //return $request->id;
        
    }

    public function delete($id){

        $daftars = Daftar::findOrFail($id);
        $daftars->delete();

        Session::flash('statuscode','success');
        return redirect('mahasiswa/daftar')->with('status', 'Berhasil Membatalkan Pendaftaran');
        
    }

}
