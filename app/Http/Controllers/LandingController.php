<?php

namespace App\Http\Controllers;

use App\User;
use App\Ketentuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LandingController extends Controller
{

    public function index()
    {

        $user = Auth::user(); 
        if(! $user){
            $ketentuans = Ketentuan::all();
            return view('landing')->with('ketentuans',$ketentuans);  
        }elseif($user->role_id == 1){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('userhome'); 
            
        }

    }
}
