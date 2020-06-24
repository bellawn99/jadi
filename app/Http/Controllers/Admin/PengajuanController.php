<?php

namespace App\Http\Controllers\Admin;

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
use App\Mahasiswa;
use App\Daftar;
use Session;
use Auth;
use Carbon\Carbon;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = Daftar::leftJoin('mahasiswa','daftar.mahasiswa_id','=','mahasiswa.id')
        ->leftJoin('user','mahasiswa.user_id','=','user.id')
        ->leftJoin('praktikum','daftar.praktikum_id','=','praktikum.id')
        ->leftJoin('dosen','praktikum.dosen_id','=','dosen.id')
        ->leftJoin('matkul','praktikum.matkul_id','=','matkul.id')
        ->leftJoin('jadwal','praktikum.jadwal_id','=','jadwal.id')
        ->leftJoin('ruangan','praktikum.ruangan_id','=','ruangan.id')
        ->join('kelas','praktikum.kelas_id','=','kelas.id')
        ->select('user.nama as user','mahasiswa.khs','mahasiswa.ipk','daftar.id as noDaftar','daftar.status','praktikum.id','kelas.id as id_kelas','praktikum.matkul_id','praktikum.jadwal_id','praktikum.dosen_id','praktikum.ruangan_id','kelas.nama','praktikum.kelas_id','jadwal.hari','jadwal.jam_mulai','jadwal.jam_akhir','praktikum.matkul_id','matkul.nama_matkul','dosen.id as id_dosen','dosen.nama as nama_dosen','jadwal.id as id_jadwal','ruangan.id as id_ruangan','ruangan.nama_ruangan')
        ->get();  
        
       // $status = Praktikum::leftJoint()->leftJoin('daftar','daftar.praktikum_id','=','praktikum.id')
       // ->select('status')->first();
        //return $daftars;
       return view('admin.pengajuan.pengajuan',compact('pengajuans'));        
    }

    public function editStat($id)
{
    //
    $pengajuans = Daftar::findOrFail($id);
    return view('admin.pengajuan.pengajuan', ['id' => $id]);
}

    public function statusUpdate(Request $request,$id=0){    

        $a = Daftar::where('status','=','daftar')->first();
        $b = Daftar::where('status','=','diterima')->first();

        $id = $request->noDaftar;
            $daftars = Daftar::find($id);
            $daftars = Daftar::where('id',$id)->first();
        if($daftars->status === "daftar" || $daftars->status === "ditolak"){
            
            $daftars->status = 'diterima';

            $daftars->save();
        
            Session::flash('statuscode','success');
            return redirect('admin/pengajuan')->with('status', 'Berhasil Menerima Asistensi');
        }else if($daftars->status === "diterima"){
            // $daftars = new Daftar;
            // $daftars->id = $request->noDaftar;
            // $daftars->praktikum_id = $request->id;
            // $daftars->user_id = $request->user;
            // $daftars->status = 'ditolak';

            // $daftars->save();
        
            // Session::flash('statuscode','success');
            // return redirect('admin/pengajuan')->with('status', 'Berhasil Menolak Asistensi');
            $daftars->status = 'ditolak';

            $daftars->save();

            Session::flash('statuscode','success');
            return redirect('admin/pengajuan')->with('status', 'Berhasil Menolak Asistensi');
        }
    }
}
