@extends('layouts.master')


@section('title')
    Dashboard
@endsection

@section('content')
    Selamat Datang {{ Auth::user()->nama }}
@endsection
