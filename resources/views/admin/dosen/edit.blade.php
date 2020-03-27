@extends('layouts.master')

@section('icon')
<i class="mdi mdi-medical-bag menu-icon"></i>
@endsection

@section('title')
<a href="{{url('master/dosen')}}" style="color:black; text-decoration:none">Master Dosen</a> / <a style="color:grey; text-decoration:none">Edit Dosen</a>
@endsection

@push('css')
@endpush

@section('content')

<div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Data Dosen</h4>
                    
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

                    <form class="forms-sample" method="post" data-toggle="validator" action="{{url('master/dosen/update/'.$dosens->id)}}">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                      <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{$dosens->id}}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="nidn">NIDN</label>
                        <input type="text" class="form-control" id="nidn" name="nidn" value="{{$dosens->nidn}}">
                      </div>
                      <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{$dosens->nama}}">
                      </div>
                      <div class="form-group">
                        <label for="no_hp">No Telepon</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{$dosens->no_hp}}">
                      </div>
                      <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{$dosens->alamat}}">
                      </div>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                      <input type="submit" class="btn btn-gradient-primary mr-2" value="Edit">
                      <button type="button" class="btn btn-light"  onclick="location.href='{{url('master/dosen')}}'">Batal</button>
                    </form>
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