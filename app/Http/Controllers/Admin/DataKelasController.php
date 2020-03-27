<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelas;
use App\Jadwal;
use App\Matkul;
use App\Dosen;
use Carbon\Carbon;
use Session;
use App\Imports\KelasImport;
use Maatwebsite\Excel\Facades\Excel;

class DataKelasController extends Controller
{
    public function index()
    {
        $kelass = Kelas::join('dosen','kelas.dosen_id','=','dosen.id')
        ->join('matkul','')
        ->select('kelas.id', 'kelas.nama', 'kelas.semester', 'jadwal.id as nomor', 'jadwal.hari')
        ->distinct()->get();

        $a = Kelas::all();
        return view('admin.kelas.kelas',compact('kelass','a'));        
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
        ]);

    
        
        

        $kelass = new Kelas;
        
        $b = 'K'.Carbon::now()->format('ymdHi').rand(100,999);

        $kelass->id = $b;
        $kelass->nama = $request->input('nama');
        $kelass->semester = $request->input('semester');
        $kelass->jadwal_id = $request->input('jadwal_id');

        $kelass->save();
        
        Session::flash('statuscode','success');
        return redirect('master/kelas')->with('status', 'Berhasil Menambahkan Data Kelas');
    }

    public function edit(Request $request, $id)
    {
        $kelass = Kelas::findOrFail($id);

        return view('admin.kelas.edit', compact('kelass'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'nama' => ['required', 'string', 'max:255'],
            'semester' => 'required',
        ]);
        
        $kelass = Kelas::find($id);

        $kelass->nama = $request->input('nama');
        $kelass->semester = $request->input('semester');

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
