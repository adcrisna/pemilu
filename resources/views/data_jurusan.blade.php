@extends('layouts.template_admin')
@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('home-admin') }}"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Jurusan</li>
    </ol>
    <br/>
  </section>
  <section class="content">
          @if(\Session::has('msg_simpan_jurusan'))
           <h5> <div class="alert alert-info">
              {{ \Session::get('msg_simpan_jurusan')}}
            </div></h5>
            @endif
            @if(\Session::has('msg_hapus_jurusan'))
           <h5> <div class="alert alert-danger">
              {{ \Session::get('msg_hapus_jurusan')}}
            </div></h5>
            @endif
            @if(\Session::has('msg_edit_jurusan'))
           <h5> <div class="alert alert-warning">
              {{ \Session::get('msg_edit_jurusan')}}
            </div></h5>
            @endif
    <div class="row">
      <div class="col-xs-12">
          <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Jurusan</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#modal-form-tambah-jurusan"><i class="fa fa-user-plus"> Tambah Jurusan</i></button>
                  </div>
                </div>
                  <div class="box-body">
                      <table class="table table-bordered table-striped" id="data-jurusan">
                      <thead>
                        <tr>
                          <th>Id Jurusan</th>
                          <th>Nama Jurusan</th>
                          <th>Aksi</th>       
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($jurusan as $key => $value)
                        <tr>
                          <td>{{ $value->id_jurusan }}</td>
                          <td>{{ $value->nama_jurusan }}</td>
                          <td width="280px">
                            <button class="btn btn-success btn-edit"><i class="fa fa-edit"> Edit</i></button> &nbsp;<a href="{{ route('hapus-jurusan',$value->id_jurusan) }}"><button class=" btn btn-danger"><i class="fa fa-trash"> Hapus</i></button></a> &nbsp;<a href="{{ route('data-kelas',$value->id_jurusan) }}">
                            <button class="btn btn-primary"><i class="fa fa-eye"> Lihat Kelas</i></button></a>
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
  <div class="modal fade" id="modal-form-tambah-jurusan" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Tambah Jurusan</h4>
        </div>
        <div class="modal-body">
           <form action="{{ route('simpan_data_jurusan') }}" method="post">
            {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input type="text" name="nama_jurusan" class="form-control" placeholder="Nama Jurusan">
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
    <div class="modal fade" id="modal-form-edit-jurusan" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Edit Jurusan</h4>
        </div>
        <div class="modal-body">
           <form action="{{ route('edit_jurusan') }}" method="post">
            {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input type="text" name="id_jurusan"  readonly class="form-control" placeholder=" ID Jurusan ">
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="nama_jurusan" class="form-control" placeholder="Nama Jurusan">
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
  var table = $('#data-jurusan').DataTable();

  $('#data-jurusan').on('click','.btn-edit',function(){
    row = table.row( $(this).closest('tr') ).data();
    console.log(row);
    $('input[name=id_jurusan]').val(row[0]);
    $('input[name=nama_jurusan]').val(row[1]);
    $('#modal-form-edit-jurusan').modal('show');
  });
  $('#modal-form-tambah-jurusan').on('show.bs.modal',function(){
    $('input[name=id_jurusan]').val('');
    $('input[name=nama_jurusan]').val('');
  });
</script>
@endsection