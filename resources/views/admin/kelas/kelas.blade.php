@extends('layouts.master')

@push('css')
@endpush

@section('icon')
<i class="mdi mdi-medical-bag menu-icon"></i>
@endsection

@section('title')
	<a href="{{url('master/kelas')}}" style="color:black; text-decoration:none">Master Kelas</a>
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tabel Kelas</h4>
                    
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

                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahKelas">
                    Tambah Data Kelas
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#importKelas">
                    Import Data Kelas
                    </button><br><br>

                    
                    
                    <table class="table table-hover" id="tabel-user">
                      <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>    
                            <th>Semester</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Akhir</th>
                            <th>Nama Matkul</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach ($kelass as $item)
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama }}</td>  
                            <td>{{ $item->semester }}</td>
                            <td>{{ $item->hari }}</td>
                            <td>{{ $item->jam_mulai }}</td>
                            <td>{{ $item->jam_akhir }}</td>
                            <td>{{ $item->nama_matkul }}</td>
                            <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#yourModal{{$item->id}}" ><i class=" mdi mdi-eye "></i></button>
                            <button type="button" class="btn btn-warning btn-sm" onclick="location.href='{{url('master/kelas/edit/'.$item['id'])}}'"><i class=" mdi mdi-border-color "></i></button>
                            <a class="btn btn-danger btn-sm deletebtn" href="javascript:void(0)"><i class="mdi mdi-delete "></i></a>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>


<!-- Detail Foto Modal -->
@foreach ($kelass as $item)
<div class="modal fade" id="yourModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        ID : <br>
        {{ $item->id }} <br><br>
        Nama : <br>
        {{ $item->nama }} <br><br>
        Semester : <br>
        {{ $item->semester }} <br><br>
        Nama Matakuliah : <br>
        {{ $item->nama_matkul }}<br><br>
        Jadwal Hari : <br>
        {{ $item->hari }}<br><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-gradient-primary mr-2" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- End Detail Foto Modal -->

<!-- Add Modal -->
<div class="modal fade" id="tambahKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="forms-sample" style="{margin:0 auto;}" data-toggle="validator" action="{{ route('store.kelas') }}" method="post">
                    {{csrf_field()}}
                    {{ method_field('POST') }}
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama" >
                      </div>
                      <div class="form-group">
                        <label for="semester">Semester</label>
                        <input type="text" class="form-control" name="semester" placeholder="Semester" >
                      </div>
                      <div class="form-group">
                        <label for="jadwal_id">Matakuliah</label>
                        <select name='jadwal_id' class='form-control'>
                        @foreach ($kelass as $value)
                                <option value="{{ $value->nomor }}">{{ $value->nama_matkul }}</option>
                        @endforeach
                        </select>
                      </div>
                    
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-gradient-primary mr-2">Tambah</button>
        <button class="btn btn-light" data-dismiss="modal">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Add Modal -->

<!-- Import Modal -->
<div class="modal fade" id="importKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Matakuliah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('import.kelas') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                    <input type="file" class="custom-file-input" name="file" accept=".csv" id="kolomImportKelas" lang="in">
                    <label class="custom-file-label" for="kolomImportKelas" data-browse="Cari">Import</label>                         
                    </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-gradient-primary mr-2">Import</button>
        <button class="btn btn-light" data-dismiss="modal">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Import Modal -->

<!-- Delete Modal -->
<div class="modal fade" id="deletemodalpop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Data Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="delete_modal" method="POST">                
      {{ csrf_field() }}
      {{ method_field('DELETE') }} 
      <div class="modal-body"> 
      <p>Apakah anda yakin menghapus data kelas <input style="border:0" id="deleteKelasForm" readonly></input> </p>
      
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
      
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End Delete Modal -->

<!-- Edit Modal -->
<!-- <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="forms-sample" method="post" data-toggle="validator" action="/master/user" id="editForm">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
                      <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" name="id" placeholder="ID" readonly>
                      </div>
                      <div class="form-group">
                        <label for="role_id">Role ID</label>
                        <input type="text" class="form-control" id="role_id" name="role_id" placeholder="Role ID" readonly>
                      </div>
                        <input type="hidden" class="form-control" id="role" name="role" placeholder="Nama Role" readonly>
                      <div class="form-group">
                        <label for="role_id">Nama Role</label>
                        <select name='role_id' class='form-control'>
                                <option value="1" >Admin</option>
                                <option value="2" >Mahasiswa</option>
                            </select>
                      </div>
                      <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"  placeholder="Nama">
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"  placeholder="Email">
                      </div>
      </div>
      <div class="modal-footer">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <button type="submit" class="btn btn-gradient-primary mr-2">Edit</button>
                      <button class="btn btn-light"  data-dismiss="modal">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div> -->
<!-- End Edit Modal -->
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
    $('#tabel-user').on('click', '.deletebtn', function(){
      $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
          return $(this).text();
        }).get();
        
        console.log(data);
        
        $('#deleteKelasForm').val(data[1]+' ?');
        
        $('#delete_modal').attr('action', '/master/kelas/delete/'+data[0]);
        $('#deletemodalpop').modal('show');
    });

    $('#kolomImportKelas').on('change',function(){
                //get the file name
                var fileName = $(this).val().split("\\").pop();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
    //start edit
    // table.on('click', '.edit', function(){
    //     $tr = $(this).closest('tr');
    //     if($($tr).hasClass('child')){
    //         $tr = $tr.prev('.parent');
    //     }

    //     var data = table.row($tr).data();
        
    //     console.log(data);
    //     $('#id').val(data[0]);
    //     $('#role_id').val(data[1]);
    //     $('#role').val(data[2]);
    //     $('#name').val(data[3]);
    //     $('#email').val(data[4]);
        
    //     $('#editForm').attr('action', '/master/user/'+data[0]);
    //     $('#editUser').modal('show');
    // });
    //end
});

$(".alert").delay(10000).slideUp(200, function() {
    $(this).alert('close');
});
</script>
@endpush