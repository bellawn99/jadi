<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Mahasiswa;
use App\User;
use Session;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilController extends Controller
{
    
    public function __construct()
  {
      $this->middleware('auth');
  }

    public function index()
    {
        $profils = User::leftJoin('mahasiswa','mahasiswa.user_id','=','user.id')
        ->select('mahasiswa.id as mhs_id','mahasiswa.nik','mahasiswa.npwp','mahasiswa.jk','mahasiswa.alamat','mahasiswa.tempat','mahasiswa.nim','mahasiswa.tgl_lahir','mahasiswa.prodi','mahasiswa.status','mahasiswa.krs','mahasiswa.semester','mahasiswa.thn_lulus','mahasiswa.nama_bank','mahasiswa.no_rekening','mahasiswa.nama_rekening','user.id','user.nama','user.username','user.password','user.no_hp','user.foto')
        ->where('mahasiswa.user_id',Auth::user()->id)
        ->get();

        $cek = Mahasiswa::select('status')->where('user_id',Auth::user()->id)->first();
        
        return view('mahasiswa.profil.profil',compact('profils','cek'));
    }

    public function editFoto(Request $request, $id)
    {

        $users = User::findOrFail($id);
        
        return view('mahasiswa.profil.edit-foto', compact('users'));
    }

    public function updateFoto(Request $request, $id)
    {

        $this->validate($request,[
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $users = User::find($id);
        $image = $request->file('foto');

        $new_name = $users->username . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        $users->foto = $new_name;

        $users->update();

        Session::flash('statuscode','success');
        return redirect('mahasiswa/profil')->with('status','Avatar berhasil di ubah');
    }

    public function editData(Request $request, $id)
    {

        $users = User::findOrFail($id);
        $mahasiswas = Mahasiswa::all()->where('user_id',$id)->first();
        
        return view('mahasiswa.profil.edit-data',compact('users','mahasiswas'));
    }

    public function updateData(Request $request, $id)
    {

        $this->validate($request,[
            'nama' => 'required',
            'nim' => 'required',
            'no_hp' => 'required',
            'jk' => 'required',
            'nik' => 'required',
            'tempat' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);

        $users = User::find($id);
        $user = User::where('id',$id)->first();
        $users->nama = $request->input('nama');
        $users->no_hp = $request->input('no_hp');

        if($users->update()){
            $mahasiswas = Mahasiswa::find($id);
            $mahasiswas = Mahasiswa::where('user_id',$id)->first();
            $mahasiswas->nim = $request->input('nim');
            $mahasiswas->jk = $request->input('jk');
            $mahasiswas->nik = $request->input('nik');
            $mahasiswas->npwp = $request->input('npwp');
            $mahasiswas->tempat = $request->input('tempat');
            $mahasiswas->tgl_lahir = $request->input('tgl_lahir');
            $mahasiswas->alamat = $request->input('alamat');
            $mahasiswas->update();

            Session::flash('statuscode','success');
        return redirect('mahasiswa/profil')->with('status','Data diri berhasil di ubah');
        }

        Session::flash('statuscode','error');
        return redirect('mahasiswa/profil')->with('status','Data diri gagal di ubah');
    }

    public function editBank(Request $request, $id)
    {

        $mahasiswas = Mahasiswa::all()->where('user_id',$id)->first();
        
        return view('mahasiswa.profil.edit-bank',compact('mahasiswas'));
    }

    public function updateBank(Request $request, $id)
    {

        $this->validate($request,[
            'nama_bank' => 'required',
            'no_rekening' => 'required',
            'nama_rekening' => 'required',
        ]);
        
        $mahasiswas = Mahasiswa::find($id);

        $mahasiswas->nama_bank = $request->nama_bank;
        $mahasiswas->no_rekening = $request->no_rekening;
        $mahasiswas->nama_rekening = $request->nama_rekening;

        $mahasiswas->update();

        Session::flash('statuscode','success');
        return redirect('mahasiswa/profil')->with('status','Data bank berhasil di ubah');
    }

    public function editMahasiswa(Request $request, $id)
    {

        $mahasiswas = Mahasiswa::all()->where('user_id',$id)->first();
        
        return view('mahasiswa.profil.edit-mahasiswa',compact('mahasiswas'));
    }

    public function updateMahasiswa(Request $request, $id)
    {

        $cek = Mahasiswa::select('status')->where('user_id',Auth::user()->id)->first();

        if($cek->status === 'Mahasiswa'){
            $this->validate($request,[
                'prodi' => 'required',
                'krs' => 'required:pdf',
                'status' => 'required',
                'semester' => 'required',
            ]);

            $mahasiswas = Mahasiswa::find($id);

            $kartu = $request->file('krs');

            $new_name = $mahasiswas->user_id . '.' . $kartu->getClientOriginalExtension();
            $kartu->move(public_path('krs'), $new_name);

            $mahasiswas->prodi = $request->prodi;
            $mahasiswas->krs = $new_name;
            $mahasiswas->status = $request->status;
            $mahasiswas->semester = $request->semester;

            $mahasiswas->update();

            Session::flash('statuscode','success');
            return redirect('mahasiswa/profil')->with('status','Data mahasiswa berhasil di ubah');
        }else{
            $this->validate($request,[
                'status' => 'required',
                'thn_lulus' => 'required',
            ]);
            $mahasiswas = Mahasiswa::find($id);

            $mahasiswas->status = $request->status;
            $mahasiswas->thn_lulus = $request->thn_lulus;

            $mahasiswas->update();

            Session::flash('statuscode','success');
            return redirect('mahasiswa/profil')->with('status','Data mahasiswa berhasil di ubah');
        }
    }

}
