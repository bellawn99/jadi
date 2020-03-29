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
use Carbon\Carbon;
use Session;
use App\Imports\KelasImport;
use Maatwebsite\Excel\Facades\Excel;

class DataKelasController extends Controller
{
    public function index()
    {
        $kelass = Kelas::leftJoin('dosen','kelas.dosen_id','=','dosen.id')
        ->leftJoin('matkul','kelas.matkul_id','=','matkul.id')
        ->leftJoin('jadwal','kelas.jadwal_id','=','jadwal.id')
        ->leftJoin('ruangan','kelas.ruangan_id','=','ruangan.id')
        ->select('kelas.id','kelas.matkul_id','kelas.jadwal_id','kelas.dosen_id','kelas.ruangan_id','kelas.nama','kelas.semester','jadwal.hari','jadwal.jam_mulai','jadwal.jam_akhir','kelas.matkul_id','matkul.nama_matkul','dosen.id as id_dosen','dosen.nama as nama_dosen','jadwal.id as id_jadwal','ruangan.id as id_ruangan','ruangan.nama_ruangan')
        ->get();
        
       return view('admin.kelas.kelas',compact('kelass'));        
    }

    public function csv_import()
    {
        Excel::import(new KelasImport, request()->file('file'));
        Session::flash('statuscode','success');
            return redirect('master/kelas')->with('status','Berhasil menambahkan data jadwal!');
    }

    public function store(Request $request){
        $this->validate($request,[
            'nama' => ['required', 'string', 'max:255'],
            'semester' => 'required',
            'ruangan_id' => 'required',
            'dosen_id' => 'required',
            'matkul_id' => 'required',
            'jadwal_id' => 'required',
        ]);

    
        
        

        $kelass = new Kelas;
        
        $b = 'K'.Carbon::now()->format('ymdHi').rand(100,999);

        $kelass->id = $b;
        $kelass->nama = $request->input('nama');
        $kelass->semester = $request->input('semester');
        $kelass->jadwal_id = $request->input('jadwal_id');
        $kelass->dosen_id = $request->input('dosen_id');
        $kelass->matkul_id = $request->input('matkul_id');
        $kelass->ruangan_id = $request->input('ruangan_id');

        $kelass->save();
        
        Session::flash('statuscode','success');
        return redirect('master/kelas')->with('status', 'Berhasil Menambahkan Data Kelas');
    }

    public function edit(Request $request, $id)
    {
        $kelass = Kelas::findOrFail($id);

        $matkuls = Matkul::all();
        $idMatkul = $kelass->pluck('matkul_id');

        $dosens = Dosen::all();
        $idDosen = $kelass->pluck('dosen_id');

        $jadwals = Jadwal::all();
        $idJadwal = $kelass->pluck('jadwal_id');

        $ruangans = Ruangan::all();
        $idRuangan = $kelass->pluck('ruangan_id');
        return view('admin.kelas.edit', compact('kelass','matkuls','idMatkul','dosens','idDosen','jadwals','idJadwal','ruangans','idRuangan'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'nama' => ['required', 'string', 'max:255'],
            'semester' => 'required',
            'ruangan_id' => 'required',
            'dosen_id' => 'required',
            'matkul_id' => 'required',
            'jadwal_id' => 'required',
            
        ]);
        
        $kelass = Kelas::find($id);

        $kelass->nama = $request->input('nama');
        $kelass->semester = $request->input('semester');
        $kelass->ruangan_id = $request->input('ruangan_id');
        $kelass->dosen_id = $request->input('dosen_id');
        $kelass->matkul_id = $request->input('matkul_id');
        $kelass->jadwal_id = $request->input('jadwal_id');

        $kelass->update();

        Session::flash('statuscode','success');
        return redirect('master/kelas')->with('status','Data Kelas berhasil di ubah');
    }

    public function delete($id){

        $kelass = Kelas::findOrFail($id);
        $kelass->delete();

        Session::flash('statuscode','success');
        return redirect('master/kelas')->with('status', 'Berhasil Hapus Kelas');
        
    }
}
