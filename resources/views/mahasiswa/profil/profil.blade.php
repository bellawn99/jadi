@extends('layouts.master')

@push('css')
@endpush

@section('icon')
<i class="mdi mdi-account menu-icon"></i>
@endsection

@section('title')
	<a href="{{url('mahasiswa/profil')}}" style="color:black; text-decoration:none">Profil Mahasiswa</a>
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Data Diri</h4>
                    
                    @if (count($errors)>0)
                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show alert">
                    @foreach($errors->all() as $error)
                      <li>{{$error}}</li>
                    @endforeach
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif
                    <div class="row">
                    <div class="col-md-3 grid-margin">
                        <div class="text-center">
                    @foreach($profils as $item)
                    <img style="margin-left:auto;margin-right:auto;" class="img-responsive img-circle avatar-view" src="{{asset('images/'.$item->foto.'')}}" alt="Avatar" title="Change the avatar">
                    <br><br><a href="{{url('mahasiswa/profil/edit-foto/'.Auth::user()->id)}}" type="button" class="btn btn-gradient-primary mr-2 btn-sm" style="color:white">Edit Foto</a>
                    @endforeach
                    </div>
                        </div>
                    <div class="col-md-9 grid-margin stretch-card">                
                    <div class="table-responsive">
                    <table class="table table-hover" width="100%">
                      <thead>
                        <tr>
                        @foreach ($profils as $item)
                            <td>Nama</td>
                            <td>{{ $item->nama }}</td>  
                        </tr>
                        <tr>
                            <td>NIM</td>
                            <td>{{ $item->nim }}</td>
                        </tr>  
                        <tr>
                            <td>No Telepon</td>
                            <td>{{ $item->no_hp }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>
                            @if($item->jk == 'P')    
                            Perempuan
                            @else
                            Laki-laki
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>{{ $item->nik }}</td>
                        </tr>
                        <tr>
                            <td>NPWP</td>
                            <td>{{ $item->npwp }}</td>
                        </tr>  
                        <tr>
                            <td>Tempat Lahir</td>
                            <td>{{ $item->tempat }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>{{ $item->tgl_lahir }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{ $item->alamat }}</td>
                        </tr>
                        @endforeach
                      </thead>
                    </table>
                    <div class="text-center">
                    <a href="{{url('mahasiswa/profil/edit-data/'.Auth::user()->id)}}" type="button" class="btn btn-gradient-primary mr-2 btn-sm" style="color:white">Edit Data Diri</a>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="row"><div class="col-md-6 grid-margin stretch-card">                
                    <div class="table-responsive">
                        <h4 class="card-title">Data Mahasiswa</h4>
                    <table class="table table-hover" width="100%">
                      <thead>
                        @if($cek->status === 'Mahasiswa')
                        <tr>
                        @foreach ($profils as $item)
                            <td width="10%">Program Studi</td>
                            <td>{{ $item->prodi }}</td>  
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{ $item->status }}</td>
                        </tr> 
                        <tr>
                            <td>Semester</td>
                            <td>{{ $item->semester }}</td>
                        </tr>  
                        <tr>
                            <td>Kartu Rencana Studi</td>
                            <td>{{ $item->krs }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                        @foreach ($profils as $item)
                            <td>Status</td>
                            <td>{{ $item->status }}</td>
                        </tr>    
                        <tr>
                            <td>Tahun Lulus</td>
                            <td>{{ $item->thn_lulus }}</td>
                        </tr>
                        @endforeach
                        @endif
                      </thead>
                    </table>
                    <div class="text-center">
                    <a href="{{url('mahasiswa/profil/edit-mahasiswa/'.Auth::user()->id)}}" type="button" class="btn btn-gradient-primary mr-2 btn-sm" style="color:white">Edit Data Mahasiswa</a>
                    </div>
                    </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">                
                    <div class="table-responsive">
                        <h4 class="card-title">Data Bank</h4>
                    <table class="table table-hover" width="100%">
                      <thead>
                        <tr>
                        @foreach ($profils as $item)
                            <td width="10%">Nama Bank</td>
                            <td>{{ $item->nama_bank }}</td>  
                        </tr>
                        <tr>
                            <td>Nomor Rekening</td>
                            <td>{{ $item->no_rekening }}</td>
                        </tr> 
                        <tr>
                            <td>Nama Rekening</td>
                            <td>{{ $item->nama_rekening }}</td>
                        </tr>   
                        
                      </thead>
                    </table>
                    <div class="text-center">
                    <a href="{{url('mahasiswa/profil/edit-bank/'.Auth::user()->id)}}" type="button" class="btn btn-gradient-primary mr-2 btn-sm" style="color:white">Edit Data Bank</a>
                    @endforeach    
                </div>
                    </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>

@endsection

@push('js')
<script>
$(".alert").delay(10000).slideUp(200, function() {
    $(this).alert('close');
});
</script>
@endpush