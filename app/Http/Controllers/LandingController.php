<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingController extends Controller
{

    public function index()
    {
        return view('welcome');
    }
}
