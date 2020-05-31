<?php

namespace App\Http\Controllers\Mahasiswa;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        $tes = User::leftJoin('mahasiswa','user.id','=','mahasiswa.user_id')
        ->where('mahasiswa.user_id',Auth::user()->id)->get();

        return view('mahasiswa.beranda',compact('tes'));
    }
}
