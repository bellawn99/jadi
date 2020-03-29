<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LandingController extends Controller
{

    public function index()
    {

        //ini contoh
        $user = Auth::user(); 
        if(! $user){
            return view('welcome');
        }elseif($user->role_id == 1){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('userhome'); // ini di ganti lempar ke landing mu, if dia ga punya role lempar ke landinga
            
        }

        //itu kamu lempar ke middleware mu

        return "ini landing page";
    }
}
