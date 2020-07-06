@extends('layouts.master')

@push('css')
<style>



h3 > span {
    border-bottom: 2px solid #C2C2C2;
    display: inline-block;
    padding: 0 5px 5px;
}

/* USER PROFILE */

#user-profile .profile-user-info {
	padding-bottom: auto;
}
#user-profile .profile-user-info .profile-user-details {
	position: relative;
	padding: 4px 0;
}
#user-profile .profile-user-info .profile-user-details .profile-user-details-label {
	width: auto;
	float: left;
	bottom: 0;
	font-weight: bold;
	left: 0;
	text-align: right;
	top: 0;
	padding-top: 4px 0;
}
#user-profile .profile-user-info .profile-user-details .profile-user-details-value {
	margin-left: 50%;
}
@media only screen and (max-width: 767px) {
	#user-profile .profile-user-info .profile-user-details .profile-user-details-label {
		float: none;
		position: relative;
		text-align: left;
	}
	#user-profile .profile-user-info .profile-user-details .profile-user-details-value {
		margin-left: 0;
	}
}


</style>
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
                        

                  
            <div class="bootstrap snippets">
                <div class="row" id="user-profile">
                    <div class="col-lg-3 col-md-4 col-sm-4">
                    <div class="text-center">
                          @foreach($profils as $item)
                                <img style="margin-left:auto;margin-right:auto;" class="img-responsive img-circle avatar-view" src="{{asset('images/'.$item->foto.'')}}" alt="Avatar" title="Change the avatar">
                                <br><br>
                            <div class="profile-message-btn center-block text-center">
                            <a href="{{url('mahasiswa/profil/edit-foto/'.Auth::user()->id)}}" type="button" class="btn btn-gradient-primary mr-2 btn-sm" style="color:white">Ubah Foto</a>
                          @endforeach
                            </div>
                    </div>
                    </div>

                    <div class="col-lg-9 col-md-8 col-sm-8">
                        <div class="main-box clearfix">
                            <div class="row profile-user-info">
                                <div class="col-sm-9">
                                @foreach ($profils as $item)
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Username 
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $item->username }}
                                        </div>
                                    </div>
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Email 
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $item->email }}
                                        </div>
                                    </div>
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Nama 
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $item->nama }}
                                        </div>
                                    </div>
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Nomor Induk Mahasiswa
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $item->nim }}
                                        </div>
                                    </div>
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            No Telepon
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $item->no_hp }}
                                        </div>
                                    </div>
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Jenis Kelamin
                                        </div>
                                        <div class="profile-user-details-value">
                                            @if($item->jk == 'P')    
                                            Perempuan
                                            @else
                                            Laki-laki
                                            @endif
                                        </div>
                                    </div>
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Nomor Induk Kependudukan
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $item->nik }}
                                        </div>
                                    </div>
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            NPWP
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $item->npwp }}
                                        </div>
                                    </div>
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Tampat Lahir
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $item->tempat }}
                                        </div>
                                    </div>
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Tanggal Lahir
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $item->tgl_lahir }}
                                        </div>
                                    </div>
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Alamat
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $item->alamat }}
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="text-center">
                                    <a href="{{url('mahasiswa/profil/edit-data/'.Auth::user()->id)}}" type="button" class="btn btn-gradient-primary mr-2 btn-sm" style="color:white">Ubah Data Diri</a>
                                    </div>
                                    <br>
                                </div>
                            </div>

                            

                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="bootstrap snippets">
                <div class="row" id="user-profile">
                    <div class="col-lg-6 col-md-5 col-sm-5">
                    <h4 class="card-title">Data Mahasiswa</h4>
                        <div class="main-box clearfix">
                            <div class="row profile-user-info">
                                <div class="col-sm-9">
                                @foreach ($profils as $item)
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Program Studi
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $item->prodi }}
                                        </div>
                                    </div>
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Semester
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $item->semester }}
                                        </div>
                                    </div>
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            IPK
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $item->ipk }}
                                        </div>
                                    </div>
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Kartu Rencana Studi
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $item->khs }}
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="text-center">
                                    <a href="{{url('mahasiswa/profil/edit-mahasiswa/'.Auth::user()->id)}}" type="button" class="btn btn-gradient-primary mr-2 btn-sm" style="color:white">Ubah Data Mahasiswa</a>
                                    </div>
                                </div>
                            </div>

                            

                            

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5 col-sm-5">
                    <h4 class="card-title">Data Bank</h4>
                        <div class="main-box clearfix">
                            <div class="row profile-user-info">
                                <div class="col-sm-9">
                                @foreach ($profils as $item)
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Nama Bank
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $item->nama_bank }}
                                        </div>
                                    </div>
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Nomor Rekening
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $item->no_rekening }}
                                        </div>
                                    </div>
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Nama Rekening
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $item->nama_rekening }}
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="text-center">
                                    <a href="{{url('mahasiswa/profil/edit-bank/'.Auth::user()->id)}}" type="button" class="btn btn-gradient-primary mr-2 btn-sm" style="color:white">Ubah Data Bank</a>
                                    </div>
                                </div>
                            </div>

                            

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