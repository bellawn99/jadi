<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dosen;
use Carbon\Carbon;
use Session;
use App\Imports\DosenImport;
use Maatwebsite\Excel\Facades\Excel;

class DataDosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::all();
        return view('admin.dosen.dosen')->with('dosens',$dosens);  
    }

    public function csv_import()
    {
        Excel::import(new DosenImport, request()->file('file'));
        Session::flash('statuscode','success');
            return redirect('admin/master/dosen')->with('status','Berhasil Menambahkan Data Dosen');
    }

    public function store(Request $request){
        $this->validate($request,[
            'nidn' => ['required', 'string', 'max:255'],
            'nama' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:15'],
            'alamat' => ['required', 'string', 'max:255']
        ]);

    
        
        

        $dosens = new Dosen;
        
        $b = 'D'.Carbon::now()->format('ymdHi').rand(100,999);

        $dosens->id = $b;
        $dosens->nidn = $request->input('nidn');
        $dosens->nama = $request->input('nama');
        $dosens->no_hp = $request->input('no_hp');
        $dosens->alamat = $request->input('alamat');

        $dosens->save();
        
        Session::flash('statuscode','success');
        return redirect('admin/master/dosen')->with('status', 'Berhasil Menambahkan Data Dosen');
    }

    public function edit(Request $request, $id)
    {
        $dosens = Dosen::findOrFail($id);
        return view('admin.dosen.edit', compact('dosens'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'nidn' => ['required', 'string', 'max:255'],
            'nama' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:15'],
            'alamat' => ['required', 'string', 'max:255']
        ]);
        
        $dosens = Dosen::find($id);
        $dosens->nidn = $request->input('nidn');
        $dosens->nama = $request->input('nama');
        $dosens->no_hp = $request->input('no_hp');
        $dosens->alamat = $request->input('alamat');

        $dosens->update();

        Session::flash('statuscode','success');
        return redirect('admin/master/dosen')->with('status','Data Dosen Berhasil Diubah');
    }

    public function delete($id){

        $dosens = Dosen::findOrFail($id);
        $dosens->delete();

        Session::flash('statuscode','success');
        return redirect('admin/master/dosen')->with('status', 'Berhasil Hapus Dosen');
        
    }
}
