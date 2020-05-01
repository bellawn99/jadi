<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Matkul;
use Carbon\Carbon;
use Session;
use App\Imports\MatkulImport;
use Maatwebsite\Excel\Facades\Excel;

class DataMatkulController extends Controller
{
    public function index()
    {
        $matkuls = Matkul::all();
        return view('admin.matkul.matkul',compact('matkuls'));        
    }

    public function csv_import()
    {
        Excel::import(new MatkulImport, request()->file('file'));
        Session::flash('statuscode','success');
            return redirect('admin/master/matkul')->with('status','Berhasil menambahkan data matakuliah!');
    }

    public function store(Request $request){
        $this->validate($request,[
            'kode_vmk' => ['required', 'string', 'max:10'],
            'nama_matkul' => ['required', 'string', 'max:255'],
            'sks' => ['required', 'string', 'max:2'],
        ]);

    
        
        

        $matkuls = new Matkul;
        
        $b = 'M'.Carbon::now()->format('ymdHi').rand(100,999);

        $matkuls->id = $b;
        $matkuls->kode_vmk = $request->input('kode_vmk');
        $matkuls->nama_matkul = $request->input('nama_matkul');
        $matkuls->sks = $request->input('sks');

        $matkuls->save();
        
        Session::flash('statuscode','success');
        return redirect('admin/master/matkul')->with('status', 'Berhasil Menambahkan Data Matakuliah');
    }

    public function edit(Request $request, $id)
    {
        $matkuls = Matkul::findOrFail($id);

        return view('admin.matkul.edit', compact('matkuls'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'kode_vmk' => ['required', 'string', 'max:10'],
            'nama_matkul' => ['required', 'string', 'max:255'],
            'sks' => ['required', 'string', 'max:2'],
        ]);
        
        $matkuls = Matkul::find($id);

        $matkuls->kode_vmk = $request->input('kode_vmk');
        $matkuls->nama_matkul = $request->input('nama_matkul');
        $matkuls->sks = $request->input('sks');

        $matkuls->update();

        Session::flash('statuscode','success');
        return redirect('admin/master/matkul')->with('status','Data Matakuliah berhasil di ubah');
    }

    public function delete($id){

        $matkuls = Matkul::findOrFail($id);
        $matkuls->delete();

        Session::flash('statuscode','success');
        return redirect('admin/master/matkul')->with('status', 'Berhasil Hapus Matakuliah');
        
    }
}
