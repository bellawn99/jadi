@extends('layouts.master')

@section('icon')
<i class="mdi mdi-home menu-icon"></i>
@endsection

@section('title')
	<a href="{{url('/dashboard')}}" style="color:black; text-decoration:none">Dashboard</a>
@endsection

@section('content')
    Selamat Datang {{ Auth::user()->nama }}
@endsection
