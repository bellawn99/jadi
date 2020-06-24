<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Mahasiswa;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use App\Imports\MhsImport;
use Maatwebsite\Excel\Facades\Excel;

class PenggunaMahasiswaController extends Controller
{
    public function index()
    {
        $users = Mahasiswa::leftJoin('user','mahasiswa.user_id','=','user.id')->leftJoin('role','user.role_id','=','role.id')
        ->select('mahasiswa.nim','user.email','user.nama','user.id', 'user.foto', 'user.no_hp', 'user.role_id', 'user.nama', 'user.username', 'role.role')
        ->distinct()->get();
        return view('admin.pengguna.mahasiswa.mahasiswa')->with('users',$users);        
        // return $users;
        
    }

    public function csv_import()
    {
        Excel::import(new MhsImport, request()->file('file'));
        Session::flash('statuscode','success');
            return redirect('admin/pengguna/user-mahasiswa')->with('status','Berhasil Menambahkan Data Mahasiswa!');
    }

    public function store(Request $request){
        $this->validate($request,[
            'nama' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:20','min:6'],
            'password' => ['required', 'string', 'max:255']
        ],
        [
            'nama.required' => 'Nama Wajib Diisi',
            'nama.max' => 'Nama Terlalu Panjang!',
            'nim.required' => 'NIM Wajib Diisi',
            'nim.max' => 'NIM Terlalu Panjang!',
            'nim.min' => 'NIM Terlalu Pendek!',
            'password.required' => 'Password Wajib Diisi',
            'password.max' => 'Password Terlalu Panjang!',
        ]);    
        

        
        
        $a = Role::select('id')->where('role','mahasiswa')->first();
        $b = Carbon::now()->format('ymd').rand(1000,9999);

        $mahasiswas = new Mahasiswa;
        $ad = 'M'.Carbon::now()->format('ymdHi').rand(100,999);
        $mahasiswas->id = $ad;
        

        $users = new User;
        $users->id = $b;
        $users->role_id = $a->id;
        $users->nama = $request->input('nama');
        $users->email = $request->input('email');
        $users->created_at = Carbon::now();
        $mahasiswas->created_at = Carbon::now();
       

        $mahasiswas->user_id = $b;
        $mahasiswas->nim = $request->input('nim'); 
        

        if($request->hasFile('foto')){
            $image = $request->file('foto');

            $new_name = $users->username . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);

            $users->foto = $new_name;
            
        }else{
            $users->foto = 'avatar.png';
        }

        $users->password = Hash::make($request->input('password'));
        
        if($request->hasFile('no_hp')){
            $users->no_hp = $request->input('no_hp');
        }else{
            $users->no_hp = null;
        }

        if(strcmp($request->get('nim'), $request->get('username')) == 0){
            $users->username = $request->input('nim');
        }else{
            $users->username = substr ($request->input('nim'), 3, 6);
        }        
            $users->save();
            $mahasiswas->save();
        
        Session::flash('statuscode','success');
        return redirect('admin/pengguna/user-mahasiswa')->with('status', 'Berhasil Menambahkan Data Mahasiswa');
    }

    public function delete($id)
    {
        $users = User::findOrFail($id);

        $mahasiswas = User::where('id', $users->id)->get();
        foreach ($mahasiswas as $mahasiswa) {
            Mahasiswa::where('user_id', $mahasiswa->id)->delete();
        }

        User::where('id', $users->id)->delete();

        Session::flash('statuscode','success');
        return redirect('admin/pengguna/user-mahasiswa')->with('status', 'Berhasil Hapus Mahasiswa');
    }

}