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
use Session;

class DataPraktikumController extends Controller
{
    public function index()
    {
        $praktikums = Praktikum::leftJoin('dosen','praktikum.dosen_id','=','dosen.id')
        ->leftJoin('matkul','praktikum.matkul_id','=','matkul.id')
        ->leftJoin('jadwal','praktikum.jadwal_id','=','jadwal.id')
        ->leftJoin('ruangan','praktikum.ruangan_id','=','ruangan.id')
        ->join('kelas','praktikum.kelas_id','=','kelas.id')
        ->select('praktikum.id','kelas.id as id_kelas','praktikum.matkul_id','praktikum.jadwal_id','praktikum.dosen_id','praktikum.ruangan_id','kelas.nama','kelas.semester','praktikum.kelas_id','jadwal.hari','jadwal.jam_mulai','jadwal.jam_akhir','praktikum.matkul_id','matkul.nama_matkul','dosen.id as id_dosen','dosen.nama as nama_dosen','jadwal.id as id_jadwal','ruangan.id as id_ruangan','ruangan.nama_ruangan')
        ->get();

        $matkuls = Matkul::all();
        $idMatkul = $praktikums->pluck('matkul_id');

        $dosens = Dosen::all();
        $idDosen = $praktikums->pluck('dosen_id');

        $jadwals = Jadwal::all();
        $idJadwal = $praktikums->pluck('jadwal_id');

        $ruangans = Ruangan::all();
        $idRuangan = $praktikums->pluck('ruangan_id');

        $kelass = Kelas::all();
        $idKelas = $kelass->pluck('kelas_id');
        
       return view('admin.praktikum.praktikum',compact('praktikums','kelass','idKelas','matkuls','idMatkul','dosens','idDosen','jadwals','idJadwal','ruangans','idRuangan'));        
    }

    public function store(Request $request){
        $this->validate($request,[
            'ruangan_id' => 'required',
            'dosen_id' => 'required',
            'matkul_id' => 'required',
            'jadwal_id' => 'required',
            'kelas_id' => 'required'
        ]);
        
        $a = Praktikum::where(['ruangan_id'=>$request->ruangan_id,'dosen_id'=>$request->dosen_id,'matkul_id'=>$request->matkul_id,'jadwal_id'=>$request->jadwal_id,'kelas_id'=>$request->kelas_id])->get();

        //return $a[1];

        if($a->count() > 0){
            Session::flash('statuscode','error');
        return redirect('admin/praktikum')->with('status', 'Gagal Menambahkan Data Praktikum');
        }else{

        $praktikums = new Praktikum;
        
        $praktikums->jadwal_id = $request->input('jadwal_id');
        $praktikums->dosen_id = $request->input('dosen_id');
        $praktikums->matkul_id = $request->input('matkul_id');
        $praktikums->ruangan_id = $request->input('ruangan_id');
        $praktikums->kelas_id = $request->input('kelas_id');

        $praktikums->save();
        
        Session::flash('statuscode','success');
        return redirect('admin/praktikum')->with('status', 'Berhasil Menambahkan Data Praktikum');
        }
    }

    public function edit(Request $request, $id)
    {
        $praktikums = Praktikum::findOrFail($id);

        $matkuls = Matkul::all();
        $idMatkul = $praktikums->pluck('matkul_id');

        $dosens = Dosen::all();
        $idDosen = $praktikums->pluck('dosen_id');

        $jadwals = Jadwal::all();
        $idJadwal = $praktikums->pluck('jadwal_id');

        $ruangans = Ruangan::all();
        $idRuangan = $praktikums->pluck('ruangan_id');

        $kelass = Kelas::all();
        $idKelas = $kelass->pluck('kelas_id');
        return view('admin.praktikum.edit', compact('praktikums','kelass','idKelas','matkuls','idMatkul','dosens','idDosen','jadwals','idJadwal','ruangans','idRuangan'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'ruangan_id' => 'required',
            'dosen_id' => 'required',
            'matkul_id' => 'required',
            'jadwal_id' => 'required',
            'kelas_id' => 'required'
        ]);
        
        $praktikums = Praktikum::find($id);

        $praktikums->ruangan_id = $request->input('ruangan_id');
        $praktikums->dosen_id = $request->input('dosen_id');
        $praktikums->matkul_id = $request->input('matkul_id');
        $praktikums->jadwal_id = $request->input('jadwal_id');
        $praktikums->kelas_id = $request->input('kelas_id');

        $praktikums->update();

        Session::flash('statuscode','success');
        return redirect('admin/praktikum')->with('status','Data Praktikum berhasil di ubah');
    }

    public function delete($id){

        $praktikums = Praktikum::findOrFail($id);
        $praktikums->delete();

        Session::flash('statuscode','success');
        return redirect('admin/praktikum')->with('status', 'Berhasil Hapus Praktikum');
        
    }
}
