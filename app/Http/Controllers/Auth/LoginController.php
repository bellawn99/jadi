<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use App\Mahasiswa;
use App\Admin;
use App\User;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    

    protected $username = 'username';

    protected function authenticated(Request $request, $user)
    {   

        if ($user->isAdmin()){

            $id = Auth::id();
            $nip = Auth::user()->username;

            $tes=Admin::where(['user_id'=>$id])->get()->count();
            if($tes<1){
                $admins = new Admin;
                $a = 'A'.Carbon::now()->format('ymdHi').rand(100,999);
                $admins->id = $a;
                $admins->user_id = $id;
                $admins->nip = $nip;
                $admins->save();
            return redirect()->route('admin.dashboard');
            }else{
            return redirect()->route('admin.dashboard');
            }

        }else{
           
            $id = Auth::id();
            $nim = Auth::user()->username;

           
            $cek=Mahasiswa::where(['user_id'=>$id])->get()->count();
            if($cek<1){
                $mahasiswas = new Mahasiswa;
                $b = 'M'.Carbon::now()->format('ymdHi').rand(100,999);
                $mahasiswas->id = $b;
                $mahasiswas->user_id = $id;
                $mahasiswas->nim = $nim;
                $mahasiswas->save();
            return redirect()->route('mahasiswa.beranda');
            }else{
            return redirect()->route('mahasiswa.beranda');
            }
           
        }      
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
