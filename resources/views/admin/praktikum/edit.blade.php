@extends('layouts.master')

@section('icon')
<i class="mdi mdi-medical-bag menu-icon"></i>
@endsection

@section('title')
<a href="{{url('/praktikum')}}" style="color:black; text-decoration:none">Praktikum</a> / <a style="color:grey; text-decoration:none">Edit Praktikum</a>
@endsection

@push('css')
@endpush

@section('content')

<div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Data Praktikum</h4>
                    
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

                    <form class="forms-sample" method="post" data-toggle="validator" action="{{url('/praktikum/update/'.$praktikums->id)}}">
                    {{ csrf_field() }} 
                    {{ method_field('PUT') }}
                      <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{$praktikums->id}}" readonly>
                      </div>
                      <div class="form-group">
                        <label for="matkul_id">Matakuliah</label>
                        <select name='matkul_id' class='form-control'>
                        @foreach ($matkuls as $value)
                                <option value="{{ $value->id }}" {{ $idMatkul->contains($value->id) ? 'selected' : '' }}>{{ $value->nama_matkul }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="dosen_id">Dosen</label>
                        <select name='dosen_id' class='form-control'>
                        @foreach ($dosens as $value)
                                <option value="{{ $value->id }}" {{ $idDosen->contains($value->id) ? 'selected' : '' }}>{{ $value->nama }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="jadwal_id">Jadwal</label>
                        <select name='jadwal_id' class='form-control'>
                        @foreach ($jadwals as $value)
                                <option value="{{ $value->id }}" {{ $idJadwal->contains($value->id) ? 'selected' : '' }}>{{ $value->hari }} , {{ $value->jam_mulai }}-{{ $value->jam_akhir }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="ruangan_id">Ruangan</label>
                        <select name='ruangan_id' class='form-control'>
                        @foreach ($ruangans as $value)
                                <option value="{{ $value->id }}" {{ $idRuangan->contains($value->id) ? 'selected' : '' }}>{{ $value->nama_ruangan }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="kelas_id">Kelas</label>
                        <select name='kelas_id' class='form-control'>
                        @foreach ($kelass as $value)
                                <option value="{{ $value->id }}" {{ $idKelas->contains($value->id) ? 'selected' : '' }}>{{ $value->nama }}</option>
                        @endforeach
                        </select>
                      </div>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">
                      <input type="submit" class="btn btn-gradient-primary mr-2" value="Edit">
                      <button type="button" class="btn btn-light"  onclick="location.href='{{url('/praktikum')}}'">Batal</button>
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