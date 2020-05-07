<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ketentuan;
use Carbon\Carbon;
use Session;
use App\Imports\KetentuanImport;
use Maatwebsite\Excel\Facades\Excel;

class DataKetentuanController extends Controller
{
    public function index()
    {
        $ketentuans = Ketentuan::all();
        return view('admin.ketentuan.ketentuan',compact('ketentuans'));        
    }

    public function csv_import()
    {
        Excel::import(new KetentuanImport, request()->file('file'));
        Session::flash('statuscode','success');
            return redirect('admin/master/ketentuan')->with('status','Berhasil Menambahkan Data Ketentuan');
    }

    public function store(Request $request){
        $this->validate($request,[
            'ketentuan' => 'required',
        ]);

    
        
        

        $ketentuans = new Ketentuan;

        $ketentuans->ketentuan = $request->input('ketentuan');

        $ketentuans->save();
        
        Session::flash('statuscode','success');
        return redirect('admin/master/ketentuan')->with('status', 'Berhasil Menambahkan Data Ketentuan');
    }

    public function edit(Request $request, $id)
    {
        $ketentuans = Ketentuan::findOrFail($id);

        return view('admin.ketentuan.edit', compact('ketentuans'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'ketentuan' => 'required',
        ]);
        
        $ketentuans = Ketentuan::find($id);

        $ketentuans->ketentuan = $request->input('ketentuan');

        $ketentuans->update();

        Session::flash('statuscode','success');
        return redirect('admin/master/ketentuan')->with('status','Data Ketentuan Berhasil Diubah');
    }

    public function delete($id){

        $ketentuans = Ketentuan::findOrFail($id);
        $ketentuans->delete();

        Session::flash('statuscode','success');
        return redirect('admin/master/ketentuan')->with('status', 'Berhasil Hapus Ketentuan');
        
    }
}
