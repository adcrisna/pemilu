@extends('layouts.template_admin')
@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('home-admin') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Data Admin</li>
      </ol>
      <br/>
    </section>
    <section class="content">
            @if(\Session::has('msg_simpan_admin'))
           <h5> <div class="alert alert-info">
              {{ \Session::get('msg_simpan_admin')}}
            </div></h5>
            @endif
            @if(\Session::has('msg_hapus_admin'))
           <h5> <div class="alert alert-danger">
              {{ \Session::get('msg_hapus_admin')}}
            </div></h5>
            @endif
            @if(\Session::has('msg_edit_admin'))
           <h5> <div class="alert alert-warning">
              {{ \Session::get('msg_edit_admin')}}
            </div></h5>
            @endif
    <div class="row">
      <div class="col-xs-12">
          <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Admin</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#modal-tambah-admin"><i class="fa fa-user-plus"> Tambah Admin</i></button>
                </div>
              </div>
              <div class="box-body">
                 <table class="table table-bordered table-striped" id="data-admin">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nama Admin</th>
                <th>Username</th>
                <th>Aksi</th>
              </tr>
            </thead>
              <tbody>
                 @foreach($users as $key => $value)
                    <tr>
                      <td>{{ $value->id}}</td>
                      <td>{{ $value->nama}}</td>
                      <td>{{ $value->username}}</td>
                      <td>
                        <button class="btn btn-success btn-edit-admin"><i class="fa fa-edit"> Edit</i></button> &nbsp;<a href="{{ route('hapus_admin',$value->id) }}"><button class=" btn btn-danger"><i class="fa fa-trash"> Hapus</i></button></a>
                      </td>
                    </tr>
                    @endforeach
              </tbody>
          </table>
           </div>
       </div>          
      </div>
    </div>
  </section>
   <div class="modal fade" id="modal-tambah-admin" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Tambah Admin</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('simpan_data_admin') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input type="text" name="nama" class="form-control" placeholder="Nama">
          </div>
           <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="Username">
          </div>
           <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
          </div>
          <div class="row">
            <div class="col-xs-4 col-xs-offset-8">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
            </div>
          </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal-edit-admin" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Edit Admin</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('edit_admin') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input type="text" name="id" readonly class="form-control" placeholder=" ID">
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="nama" class="form-control" placeholder="Nama">
          </div>
           <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="Username">
          </div>
           <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
          </div>
          <div class="row">
            <div class="col-xs-4 col-xs-offset-8">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
            </div>
          </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
  var table = $('#data-admin').DataTable();

  $('#data-admin').on('click','.btn-edit-admin',function(){
    row = table.row( $(this).closest('tr') ).data();
    console.log(row);
    $('input[name=id]').val(row[0]);
    $('input[name=nama]').val(row[1]);
    $('input[name=username]').val(row[2]);
    $('#modal-edit-admin').modal('show');
  });
  
  $('#modal-tambah-admin').on('show.bs.modal',function(){
    $('input[name=id]').val('');
    $('input[name=nama]').val('');
    $('input[name=username]').val('');
  });
</script>
@endsection