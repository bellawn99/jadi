<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode;
use Carbon\Carbon;
use Session;

class DataPeriodeController extends Controller
{
    public function index()
    {
        $periodes = Periode::all();
        
       return view('admin.periode.periode',compact('periodes'));        
    }

    public function store(Request $request){
        $this->validate($request,[
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'thn_ajaran' => 'required',
        ]);

    
        
        

        $periodes = new Periode;
        
        $b = 'P'.Carbon::now()->format('ymdHi').rand(100,999);

        $periodes->id = $b;
        $periodes->tgl_mulai = $request->input('tgl_mulai');
        $periodes->tgl_selesai = $request->input('tgl_selesai');
        $periodes->thn_ajaran = $request->input('thn_ajaran');

        $periodes->save();
        
        Session::flash('statuscode','success');
        return redirect('admin/periode')->with('status', 'Berhasil Menambahkan Data Periode');
    }

    public function edit(Request $request, $id)
    {
        $periodes = Periode::findOrFail($id);
        return view('admin.periode.edit', compact('periodes'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'thn_ajaran' => 'required',
            
        ]);
        
        $periodes = Periode::find($id);

        $periodes->tgl_mulai = $request->input('tgl_mulai');
        $periodes->tgl_selesai = $request->input('tgl_selesai');
        $periodes->thn_ajaran = $request->input('thn_ajaran');

        $periodes->update();

        Session::flash('statuscode','success');
        return redirect('admin/periode')->with('status','Data Periode berhasil di ubah');
    }

    public function delete($id){

        $periodes = Periode::findOrFail($id);
        $periodes->delete();

        Session::flash('statuscode','success');
        return redirect('admin/periode')->with('status', 'Berhasil Hapus Periode');
        
    }

}
