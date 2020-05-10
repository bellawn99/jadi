<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
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
        $profils = User::leftJoin('admin','admin.user_id','=','user.id')
        ->select('user.username','admin.id as admin_id','admin.nip','user.id','user.nama','user.username','user.password','user.no_hp','user.foto')
        ->where('admin.user_id',Auth::user()->id)
        ->get();
        
        return view('admin.profil.profil',compact('profils'));
    }

    public function editFoto(Request $request, $id)
    {

        $users = User::findOrFail($id);
        
        return view('admin.profil.edit-foto', compact('users'));
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
        return redirect('admin/profil')->with('status','Avatar berhasil di ubah');
    }

    public function editData(Request $request, $id)
    {

        $users = User::findOrFail($id);
        $admins = Admin::all()->where('user_id',$id)->first();
        
        return view('admin.profil.edit-data',compact('users','admins'));
    }

    public function updateData(Request $request, $id)
    {

        $this->validate($request,[
            'nama' => 'required',
            'nip' => 'required',
            'no_hp' => 'required',
        ]);

        $users = User::find($id);
        $user = User::where('id',$id)->first();
        $users->nama = $request->input('nama');
        $users->no_hp = $request->input('no_hp');

        if($users->update()){
            $mahasiswas = Admin::find($id);
            $mahasiswas = Admin::where('user_id',$id)->first();
            $mahasiswas->nip = $request->input('nip');
            $mahasiswas->update();

            Session::flash('statuscode','success');
        return redirect('admin/profil')->with('status','Data diri berhasil di ubah');
        }

        Session::flash('statuscode','error');
        return redirect('admin/profil')->with('status','Data diri gagal di ubah');
    }

}
