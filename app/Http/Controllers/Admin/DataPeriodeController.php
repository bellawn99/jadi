<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode;
use App\Berita;
use Auth;
use Carbon\Carbon;
use Session;

class DataPeriodeController extends Controller
{
    public function index()
    {
        $periodes = Periode::all();
        $beritas = Berita::all();
        
       return view('admin.periode.periode',compact('periodes','beritas'));        
    }

    public function store(Request $request){
        $this->validate($request,[
            'tgl_mulai' => 'required',
            'thn_ajaran' => 'required',
            'status' => 'required',
            'semester' => 'required'
        ]);

        $periodes = new Periode;
        
        $b = 'P'.Carbon::now()->format('ymdHi').rand(100,999);

        $periodes->id = $b;
        $periodes->berita_id = 'B'.Carbon::now()->format('ymdHi').rand(100,999);
        $periodes->tgl_mulai = $request->input('tgl_mulai');
        $periodes->tgl_selesai = $request->input('tgl_selesai');
        $periodes->thn_ajaran = $request->input('thn_ajaran');
        $periodes->status = $request->input('status');
        $periodes->semester = $request->input('semester');
        $periodes->created_at = Carbon::now();
        if($request->get('status')=='Daftar'){
            $beritas = new Berita;
            $beritas->id = $periodes->berita_id;
            $beritas->user_id = Auth()->user()->id;
            $judul = "Pendaftaran Asistensi Semester ".$request->input('semester')." TA ".$request->input('thn_ajaran');
            $isi = "PERSIAPKAN DIRIMU !
            
Kami dari Admin Asistensi menyelenggarakan Open Recruitment Asisten Praktikum Semester Genap Tahun Akademik 2020/2021.
                        
Catat tanggalnya :
Pendaftaran : ".$request->input('tgl_mulai')."-".$request->input('tgl_selesai')."
                        
Informasi lebih lanjut
CP : 088-888-888-888
Daftarkan segera dan jadilah bagian dari kami.";
            $count = Berita::where('judul',$judul)->get()->count();
            if($count < 1){
            $beritas->judul = $judul;
            $beritas->isi = $isi;
            $beritas->foto = "daftar.png";
            $beritas->created_at = Carbon::now();
            $beritas->save();
            }
        }else{
            $beritas = new Berita;
            $beritas->id = $periodes->berita_id;
            $beritas->user_id = Auth()->user()->id;
            $judul2 = "Pengumuman Penerimaan Asisten Praktikum Semester ".$request->input('semester')." TA ".$request->input('thn_ajaran');
            $isi2 = "Assalamualaikum Wr Wb
Salam sejahtera bagi kita semua.
            
Kami dari Admin Asistensi memberitahukan kepada seluruh calon Asisten Praktikum Semester Genap Tahun Akademik".$request->input('thn_ajaran').", ingin menginformasikan bahwa sudah ada daftar nama Asisten Praktikum Tahun Ajaran ini. Untuk lebih lengkapnya silahkan login dengan akun masing-masing.";
            $count = Berita::where('judul',$judul2)->get()->count();
            if($count < 1){
            $beritas->judul = $judul2;
            $beritas->isi = $isi2;
            $beritas->foto = "terima.png";
            $beritas->created_at = Carbon::now();
            $beritas->save();
            }
        }

        $periodes->save();
       
        
        Session::flash('statuscode','success');
        return redirect('admin/periode')->with('status', 'Berhasil Menambahkan Data Periode');
    }

    public function edit(Request $request, $id)
    {
        $periodes = Periode::where('berita_id','=',$id)->firstOrFail();
        
        return view('admin.periode.edit', compact('periodes'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'tgl_mulai' => 'required',
            'thn_ajaran' => 'required',
            'status' => 'required',
            'semester' => 'required'            
        ]);
        
        
        if($request->get('status') == "Daftar"){
        $judul = "Pendaftaran Asistensi Semester ".$request->input('semester')." TA ".$request->input('thn_ajaran');
        $isi = "PERSIAPKAN DIRIMU !
            
Kami dari Admin Asistensi menyelenggarakan Open Recruitment Asisten Praktikum Semester Genap Tahun Akademik 2020/2021.
                        
Catat tanggalnya :
Pendaftaran : ".$request->input('tgl_mulai')."-".$request->input('tgl_selesai')."
                        
Informasi lebih lanjut
CP : 088-888-888-888
Daftarkan segera dan jadilah bagian dari kami.";
        
        $beritas = Berita::where('id','=',$id)->first();
        if($beritas->judul != $judul){
            $beritas->user_id = Auth()->user()->id;
            $beritas->judul = $judul;
            $beritas->isi = $isi;
            $beritas->foto = "daftar.png";
            $beritas->created_at = Carbon::now();
            if($beritas->update()){
                $periodes = Periode::where('berita_id','=',$id)->firstOrFail();
        

                $periodes->tgl_mulai = $request->input('tgl_mulai');
                $periodes->tgl_selesai = $request->input('tgl_selesai');
                $periodes->thn_ajaran = $request->input('thn_ajaran');
                $periodes->status = $request->input('status');
                $periodes->semester = $request->input('semester');
                if($periodes->update()){
                    $beritas->update();
                }
                
            } 
        }
              

        }elseif($request->get('status') == "Pengumuman"){
            $judul2 = "Pengumuman Penerimaan Asisten Praktikum Semester ".$request->input('semester')." TA ".$request->input('thn_ajaran');
            $isi2 = "Assalamualaikum Wr Wb
Salam sejahtera bagi kita semua.
            
Kami dari Admin Asistensi memberitahukan kepada seluruh calon Asisten Praktikum Semester Genap Tahun Akademik".$request->input('thn_ajaran').", ingin menginformasikan bahwa sudah ada daftar nama Asisten Praktikum Tahun Ajaran ini. Untuk lebih lengkapnya silahkan login dengan akun masing-masing.";
            
            $beritas = Berita::where('id','=',$id)->first();
            if($beritas->judul != $judul2){
                $beritas->user_id = Auth()->user()->id;
                $beritas->judul = $judul2;
                $beritas->isi = $isi2;
                $beritas->foto = "daftar.png";
                $beritas->created_at = Carbon::now();
                if($beritas->update()){
                    $periodes = Periode::where('berita_id','=',$id)->firstOrFail();
            
    
                    $periodes->tgl_mulai = $request->input('tgl_mulai');
                    $periodes->tgl_selesai = $request->input('tgl_selesai');
                    $periodes->thn_ajaran = $request->input('thn_ajaran');
                    $periodes->status = $request->input('status');
                    $periodes->semester = $request->input('semester');
                    if($periodes->update()){
                        $beritas->update();
                    }
                    
                } 
            }
        }
        

        Session::flash('statuscode','success');
        return redirect('admin/periode')->with('status','Data Periode Berhasil Diubah');
    }

    public function delete($id){

        $periodes = Periode::findOrFail($id);
        $periodes->delete();

        Session::flash('statuscode','success');
        return redirect('admin/periode')->with('status', 'Berhasil Hapus Periode');
        
    }

}
