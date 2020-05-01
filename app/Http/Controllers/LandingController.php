<?php

namespace App\Http\Controllers;

use App\User;
use App\Kontak;
use App\Ketentuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;

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
            return redirect()->route('mahasiswa.beranda'); 
            
        }

    }

    public function saveContact(Request $request) { 

        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email',
            'pesan' => 'required'
        ]);

        $kontaks = new Kontak;

        $kontaks->nama = $request->nama;
        $kontaks->email = $request->email;
        $kontaks->no_hp = $request->no_hp;
        $kontaks->pesan = $request->pesan;

        $kontaks->save();

        \Mail::send('contact-view',
             array(
                 'nama' => $request->get('nama'),
                 'email' => $request->get('email'),
                 'no_hp' => $request->get('no_hp'),
                 'pesan' => $request->get('pesan'),
             ), function($message) use ($request)
               {
                  $message->from($request->email);
                  $message->to('bwulan99@gmail.com');
               });

        
        Session::flash('statuscode','success');
        return back()->with('status', 'Terimakasih sudah menghubungi kami!');

    }
}
