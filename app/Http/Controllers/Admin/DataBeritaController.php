<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Berita;
use App\User;
use App\Admin;
use Carbon\Carbon;
use Session;
use Maatwebsite\Excel\Facades\Excel;

class DataBeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::join('admin','berita.admin_id','=','admin.id')
        ->join('user','admin.user_id','=','user.id')
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
            'foto' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'judul.required' => 'Judul Wajib Diisi',
            'isi.required' => 'Isi Wajib Diisi',
            'foto.required' => 'Foto Wajib Diisi',
            'foto.mimes' => 'Foto Harus Berupa File: jpeg, png, jpg, atau gif!',
        ]);

        $now = Carbon::now();
        $id = 'B'.Carbon::now()->format('ymdHi').rand(100,999);

        $a = Admin::where('user_id',Auth::user()->id)->first();

        $beritas = new Berita;

        $beritas->id = $id;
        $beritas->admin_id = $a->id;
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
            'foto' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'judul.required' => 'Judul Wajib Diisi',
            'isi.required' => 'Isi Wajib Diisi',
            'foto.required' => 'Foto Wajib Diisi',
            'foto.mimes' => 'Foto Harus Berupa File: jpeg, png, jpg, atau gif!',
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
