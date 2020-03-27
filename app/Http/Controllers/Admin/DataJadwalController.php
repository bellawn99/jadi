<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jadwal;
use Carbon\Carbon;
use Session;
use App\Imports\JadwalImport;
use Maatwebsite\Excel\Facades\Excel;

class DataJadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::all();
        return view('admin.jadwal.jadwal',compact('jadwals'));        
    }

    public function csv_import()
    {
        Excel::import(new JadwalImport, request()->file('file'));
        Session::flash('statuscode','success');
            return redirect('master/jadwal')->with('status','Berhasil menambahkan data jadwal!');
    }

    public function store(Request $request){
        $this->validate($request,[
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_akhir' => 'required',
        ]);

    
        
        

        $jadwals = new Jadwal;
        
        $b = 'J'.Carbon::now()->format('ymdHi').rand(100,999);

        $jadwals->id = $b;
        $jadwals->hari = $request->input('hari');
        $jadwals->jam_mulai = $request->input('jam_mulai');
        $jadwals->jam_akhir = $request->input('jam_akhir');

        $jadwals->save();
        
        Session::flash('statuscode','success');
        return redirect('master/jadwal')->with('status', 'Berhasil Menambahkan Data Jadwal');
    }

    public function edit(Request $request, $id)
    {
        $jadwals = Jadwal::findOrFail($id);

        return view('admin.jadwal.edit', compact('jadwals'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_akhir' => 'required',
        ]);
        
        $jadwals = Jadwal::find($id);

        $jadwals->hari = $request->input('hari');
        $jadwals->jam_mulai = $request->input('jam_mulai');
        $jadwals->jam_akhir = $request->input('jam_akhir');

        $jadwals->update();

        Session::flash('statuscode','success');
        return redirect('master/jadwal')->with('status','Data Jadwal berhasil di ubah');
    }

    public function delete($id){

        $jadwals = Jadwal::findOrFail($id);
        $jadwals->delete();

        Session::flash('statuscode','success');
        return redirect('master/jadwal')->with('status', 'Berhasil Hapus Jadwal');
        
    }
}
