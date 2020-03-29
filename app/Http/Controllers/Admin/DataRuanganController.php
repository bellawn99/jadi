<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ruangan;
use Carbon\Carbon;
use Session;
use App\Imports\RuanganImport;
use Maatwebsite\Excel\Facades\Excel;

class DataRuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::all();
        return view('admin.ruangan.ruangan',compact('ruangans'));        
    }

    public function csv_import()
    {
        Excel::import(new RuanganImport, request()->file('file'));
        Session::flash('statuscode','success');
            return redirect('master/ruangan')->with('status','Berhasil menambahkan data ruangan!');
    }

    public function store(Request $request){
        $this->validate($request,[
            'nama_ruangan' => ['required', 'string', 'max:255'],
        ]);

    
        
        

        $ruangans = new Ruangan;
        
        $b = 'R'.Carbon::now()->format('ymdHi').rand(100,999);

        $ruangans->id = $b;
        $ruangans->nama_ruangan = $request->input('nama_ruangan');

        $ruangans->save();
        
        Session::flash('statuscode','success');
        return redirect('master/ruangan')->with('status', 'Berhasil Menambahkan Data Ruangan');
    }

    public function edit(Request $request, $id)
    {
        $ruangans = Ruangan::findOrFail($id);

        return view('admin.ruangan.edit', compact('ruangans'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'nama_ruangan' => ['required', 'string', 'max:255'],
        ]);
        
        $ruangans = Ruangan::find($id);

        $ruangans->nama_ruangan = $request->input('nama_ruangan');

        $ruangans->update();

        Session::flash('statuscode','success');
        return redirect('master/ruangan')->with('status','Data Ruangan berhasil di ubah');
    }

    public function delete($id){

        $ruangans = Ruangan::findOrFail($id);
        $ruangans->delete();

        Session::flash('statuscode','success');
        return redirect('master/ruangan')->with('status', 'Berhasil Hapus Ruangan');
        
    }
}
