<?php

namespace App\Http\Controllers\Mahasiswa;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Auth;

class UbahPasswordController extends Controller
{
    public function index()
    {
        return view('mahasiswa.password.ubah');
    }

    public function changePassword(Request $request){
 
        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
        // The passwords matches
        return redirect()->back()->with("errors","Kata sandi Anda saat ini tidak cocok dengan kata sandi yang Anda berikan. Silakan coba lagi.");
        }
         
        if(strcmp($request->get('password'), $request->get('new-password')) == 0){
        //Current password and new password are same
        return redirect()->back()->with("errors","Kata sandi baru tidak boleh sama dengan kata sandi Anda saat ini. Silakan pilih kata sandi yang berbeda.");
        }
        if(!(strcmp($request->get('new-password'), $request->get('new-password-confirm'))) == 0){
                    //New password and confirm password are not same
                    return redirect()->back()->with("errors","Kata sandi yang dimasukkan harus sama dengan kata sandi baru");
        }
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
         
        return redirect()->back()->with("success","Password changed successfully !");
         
        }
}
