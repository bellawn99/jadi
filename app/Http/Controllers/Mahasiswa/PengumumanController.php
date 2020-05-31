<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Daftar;
use App\Kelas;
use App\Matkul;
use App\Semester;
use App\Ruangan;
use App\Praktikum;
use App\User;
use App\Periode;
use Session;
use Auth;
use Carbon\Carbon;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Daftar::join('praktikum','praktikum.id','=','daftar.praktikum_id')
        ->join('user','user.id','=','daftar.user_id')
        ->join('matkul','praktikum.matkul_id','=','matkul.id')
        ->join('jadwal','praktikum.jadwal_id','=','jadwal.id')
        ->join('ruangan','praktikum.ruangan_id','=','ruangan.id')
        ->join('dosen','praktikum.dosen_id','=','dosen.id')
        ->join('kelas','praktikum.kelas_id','=','kelas.id')
        ->join('semester','praktikum.semester_id','=','semester.id')
        ->where('user.id',Auth::user()->id)
        ->select('daftar.id as noDaftar','daftar.status','praktikum.id','kelas.id as id_kelas','praktikum.matkul_id','praktikum.jadwal_id','praktikum.dosen_id','praktikum.ruangan_id','kelas.nama','semester.semester','praktikum.kelas_id','jadwal.hari','jadwal.jam_mulai','jadwal.jam_akhir','praktikum.matkul_id','matkul.nama_matkul','dosen.id as id_dosen','dosen.nama as nama_dosen','jadwal.id as id_jadwal','ruangan.id as id_ruangan','ruangan.nama_ruangan')
        ->get();  
        
        $now = Carbon::now()->subday(14);

        $awals = Periode::select('tgl_mulai')
        ->where('status','pengumuman')
        ->whereDate('tgl_mulai', '>=', $now->toDateString())
        ->get();

       // $status = Praktikum::leftJoint()->leftJoin('daftar','daftar.praktikum_id','=','praktikum.id')
       // ->select('status')->first();
        //return $awals;
       return view('mahasiswa.pengumuman.pengumuman',compact('pengumumans','awals'));        
    }

}
