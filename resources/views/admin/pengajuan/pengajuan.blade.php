@extends('layouts.master')

@push('css')
@endpush

@section('icon')
<i class="mdi mdi-file-multiple menu-icon"></i>
@endsection

@section('title')
	<a href="{{url('admin/pengajuan')}}" style="color:black; text-decoration:none">Pengajuan Asistensi</a>
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Pengajuan Asistensi</h4>
                    
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
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Kelas</th>    
                            <th>Semester</th>
                            <th>Matakuliah</th>
                            <th>KRS</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach ($pengajuans as $item)
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->user }}</td>
                            <td>{{ $item->nama }}</td>  
                            <td>{{ $item->semester }}</td>
                            <td>{{ str_limit($item->nama_matkul, 15) }}</td>
                            <td><a type="button" data-toggle="modal" data-target="#yourModal{{$item->id}}">{{ $item->krs }}</a></td>
                            <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail{{$item->id}}" ><i class=" mdi mdi-eye "></i></button>
                            @if($item->status === 'daftar' || $item->status === 'ditolak') 
                            <button type="button" class="btn btn-primary btn-sm openModal" data-id="{{ $item->noDaftar }}" data-status="{{ $item->status }}" data-toggle="modal" data-target="#terima" >Terima</button>
                            @elseif($item->status === 'diterima')
                            <button type="button" class="btn btn-dark btn-sm tolakModal" data-id="{{ $item->noDaftar }}" data-status="{{ $item->status }}" data-toggle="modal" data-target="#tolak" >Tolak</button>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

@foreach($pengajuans as $item)
<!-- Terima Praktikum Modal -->
<div class="modal fade" id="terima" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Daftar</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" action="{{url('admin/pengajuan/update')}}" method="POST" enctype="multipart/form-data" id="pengajuanForm">
              {{ csrf_field() }}
      <input type="hidden" value="{{ $item->noDaftar }}" class='modal_hiddenid' id="noDaftar" name="noDaftar">
      <input type="hidden" value="{{ $item->id }}" id="id" name="id">
      <input type="hidden" value="{{ $item->user }}" id="user" name="user">
      Yakin ingin menerima asistensi matakuliah {{ $item->nama_matkul }} dengan nama {{ $item->user }}
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-gradient-primary mr-2 btn-sm" from="pengajuanForm">Daftar</button>
      <button class="btn btn-light btn-sm" data-dismiss="modal">Batal</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- End Terima Praktikum Modal -->

<!-- Tolak Praktikum Modal -->
<div class="modal fade" id="tolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Daftar</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" action="{{url('admin/pengajuan/update')}}" method="POST" enctype="multipart/form-data" id="tolakForm">
              {{ csrf_field() }}
      <input type="hidden" value="{{ $item->noDaftar }}" class='modal_hiddenid' id="noDaftar" name="noDaftar">
      <input type="hidden" value="{{ $item->noDaftar }}" id="noDaftar" name="noDaftar">
      <input type="hidden" value="{{ $item->id }}" id="id" name="id">
      <input type="hidden" value="{{ $item->user }}" id="user" name="user">
      Yakin ingin menolak asistensi matakuliah {{ $item->nama_matkul }} dengan nama {{ $item->user }}
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-gradient-primary mr-2 btn-sm" from="tolakForm">Daftar</button>
      <button class="btn btn-light btn-sm" data-dismiss="modal">Batal</button>
      </form>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- End Tolak Praktikum Modal -->



<!-- Detail PDF Modal -->
@foreach ($pengajuans as $item)
<div class="modal fade" id="yourModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Detail KRS</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      <iframe id="myFrame" src="{{ URL::to('/') }}/krs/{{ $item->krs }}" width="100%"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-gradient-primary mr-2 btn-sm" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- End Detail PDF Modal -->


<!-- Detail Praktikum Modal -->
@foreach ($pengajuans as $item)
<div class="modal fade" id="detail{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <table style="border:0">
        <tr>
          <td>ID</td>
          <td>:</td>
          <td>{{ $item->id }}</td>
        </tr>
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td>{{ $item->user }}</td>
        </tr>
        <tr>
          <td>Nama Kelas</td>
          <td>:</td>
          <td>{{ $item->nama }}</td>
        </tr>
        <tr>
          <td>Semester</td>
          <td>:</td>
          <td>{{ $item->semester }}</td>
        </tr>
        <tr>
          <td>Nama Matakuliah</td>
          <td>:</td>
          <td>{{ $item->nama_matkul }}</td>
        </tr>
        <tr>
          <td>Nama Dosen</td>
          <td>:</td>
          <td>{{ $item->nama_dosen }}</td>
        </tr>
        <tr>
          <td>Hari</td>
          <td>:</td>
          <td>{{ $item->hari }}</td>
        </tr>
        <tr>
          <td>Jam Mulai</td>
          <td>:</td>
          <td>{{ $item->jam_mulai }}</td>
        </tr>
        <tr>
          <td>Jam Akhir</td>
          <td>:</td>
          <td>{{ $item->jam_akhir }}</td>
        </tr>
        <tr>
          <td>Nama Ruangan</td>
          <td>:</td>
          <td>{{ $item->nama_ruangan }}</td>
        </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-gradient-primary mr-2 btn-sm" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- End Detail Praktikum Modal -->


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
      "scrollX": true,
      'language' : {
                        'search' : "_INPUT_",
                        'searchPlaceholder' : "Search",
                        'autoWidth' : false

                      },
    });

    $(document).on('click','.openModal',function(){
        var id = $(this).data('id');
        $('.modal_hiddenid').val(id);
        
        $('#terima').modal('show');
    });

    $(document).on('click','.tolakModal',function(){
        var id = $(this).data('id');
        $('.modal_hiddenid').val(id);
        
        $('#tolak').modal('show');
    });
});
</script>
@endpush