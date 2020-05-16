@extends('layouts.master')

@push('css')
@endpush

@section('icon')
<i class="mdi mdi-book menu-icon"></i>
@endsection

@section('title')
	<a href="{{url('mahasiswa/daftar')}}" style="color:black; text-decoration:none">Daftar Asisten Praktikum</a>
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Daftar Asisten Praktikum</h4>
                    
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
                    
                    <table class="table table-hover" id="tabel-user">
                      <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="5%">Kelas</th>    
                            <th width="10%">Semester</th>
                            <th width="10%">Matakuliah</th>
                            <th width="5%">Hari</th>
                            <th width="5%">Jam Mulai</th>
                            <th width="5%">Jam Akhir</th>
                            <th width="10%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach ($praktikums as $item)
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama }}</td>  
                            <td>{{ $item->semester }}</td>
                            <td>{{ str_limit($item->nama_matkul, 15) }}</td>
                            <td>{{ $item->hari }}</td>
                            <td>{{ $item->jam_mulai }}</td>
                            <td>{{ $item->jam_akhir }}</td>
                            <td>
                            <button type="button" class="btn btn-warning btn-sm" onclick="location.href='{{url('admin/praktikum/edit/'.$item['id'])}}'"><i class=" mdi mdi-border-color "></i></button>
                            <a data-id="{{ $item->id }}" data-nama="{{ $item->nama }}" data-matkul="{{ $item->nama_matkul }}" class="btn btn-danger btn-sm deletebtn" href="javascript:void(0)"><i class="mdi mdi-delete "></i></a>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
@endsection

@push('js')
<script>
$(document).ready(function(){
    // var table =  
    $('#tabel-user').DataTable({
      'responsive' : true,
      'autoWidth' : false,
      'language' : {
                        'search' : "_INPUT_",
                        'searchPlaceholder' : "Search",
                        'autoWidth' : false

                      },
    });
});
</script>
@endpush