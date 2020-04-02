<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use App\Mahasiswa;
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

            return redirect()->route('admin.dashboard');

        }else{
            
            $mahasiswas = new Mahasiswa;

            $b = 'M'.Carbon::now()->format('ymdHi').rand(100,999);
            $id = Auth::id();

            $mahasiswas->id = $b;
            $mahasiswas->user_id = $id;
            if(empty($mahasiswas->user_id)){
            $mahasiswas->save();
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
