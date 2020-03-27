@extends('layouts.master')

@section('icon')
<i class="mdi mdi-medical-bag menu-icon"></i>
@endsection

@section('title')
<a href="{{url('master/user')}}" style="color:black; text-decoration:none">Master User</a> / <a style="color:grey; text-decoration:none">Detail User</a>
@endsection

@push('css')
<style type="text/css">
    $custom-file-text: (
in: "Cari",
);
</style>
@endpush
@section('content')

<div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Data User</h4>
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                      <div class="form-group">
                        <img src="{{ URL::to('/') }}/images/{{ $users->foto }}" style="border-radius:50%; max-width:20%; max-height:20%; min-width:20%; min-height:20%" width="30%" />
                      </div>
                        <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{$users->id}}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="role">Nama Role</label>
                        <input type="text" class="form-control" id="level" name="role" value="{{$users->role_id}}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{$users->nama}}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{$users->username}}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="no_hp">No Telepon</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{$users->no_hp}}" readonly>
                      </div>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                      <button type="submit" class="btn btn-gradient-primary mr-2" onclick="location.href='{{url('master/user')}}'">Ok</button>
                  </div>
                </div>
              </div>
              </div>
@endsection

@push('js')
<script>
    $('#kolomEditUser').on('change',function(){
                //get the file name
                var fileName = $(this).val().split("\\").pop();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
@endpush