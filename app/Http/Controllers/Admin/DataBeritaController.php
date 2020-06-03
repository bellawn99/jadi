<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Berita;
use App\User;
use Carbon\Carbon;
use Session;
use Maatwebsite\Excel\Facades\Excel;

class DataBeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::join('user','berita.user_id','=','user.id')
        ->where('user.id',Auth()->user()->id)
        ->select('berita.id','berita.judul','berita.isi','berita.foto','user.nama')
        ->get();
        // return $beritas;
        return view('admin.berita.berita',compact('beritas'));        
    }

    public function store(Request $request){
        $this->validate($request,[
            'judul' => 'required',
            'isi' => 'required',
            'foto' => 'required',
        ]);

        $now = Carbon::now();
        $id = 'B'.Carbon::now()->format('ymdHi').rand(100,999);

        $beritas = new Berita;

        $beritas->id = $id;
        $beritas->user_id = Auth()->user()->id;
        $beritas->judul = $request->input('judul');
        $beritas->isi = nl2br($request->input('isi'));
        $beritas->foto = $request->input('foto');
        $beritas->created_at = $now;

        $beritas->save();
        
        Session::flash('statuscode','success');
        return redirect('admin/berita')->with('status', 'Berhasil Menambahkan Data Berita');
    }

    public function edit(Request $request, $id)
    {
        $beritas = Berita::findOrFail($id);

        return view('admin.berita.edit', compact('beritas'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'judul' => 'required',
            'isi' => 'required',
            'foto' => 'required',
        ]);
        
        $beritas = Berita::find($id);
        $now = Carbon::now();

        $beritas->judul = $request->input('judul');
        $beritas->isi = nl2br($request->input('isi'));
        $beritas->foto = $request->input('foto');
        $beritas->created_at = $now;

        $beritas->update();

        Session::flash('statuscode','success');
        return redirect('admin/berita')->with('status','Data Berita Berhasil Diubah');
    }

    public function delete($id){

        $beritas = Berita::findOrFail($id);
        $beritas->delete();

        Session::flash('statuscode','success');
        return redirect('admin/berita')->with('status', 'Berhasil Hapus Berita');
        
    }
}
