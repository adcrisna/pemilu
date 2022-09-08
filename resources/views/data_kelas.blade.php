@extends('layouts.template_admin')
@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('home-admin') }}"><i class="fa fa-home"></i> Home</a></li>
      <li> Data Jurusan</li>
      <li class="active">Data Kelas</li>
    </ol>
    <br/>
  </section>
  <section class="content">
           @if(\Session::has('msg_simpan_kelas'))
           <h5> <div class="alert alert-info">
              {{ \Session::get('msg_simpan_kelas')}}
            </div></h5>
            @endif
            @if(\Session::has('msg_hapus_kelas'))
           <h5> <div class="alert alert-danger">
              {{ \Session::get('msg_hapus_kelas')}}
            </div></h5>
            @endif
            @if(\Session::has('msg_edit_kelas'))
           <h5> <div class="alert alert-warning">
              {{ \Session::get('msg_edit_kelas')}}
            </div></h5>
            @endif
    <div class="row">
      <div class="col-xs-12">
          <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Kelas Jurusan: {{ $jurusan->nama_jurusan }}</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#modal-form-tambah-kelas"><i class="fa fa-user-plus"> Tambah Kelas</i></button>
                </div>
              </div>
              <div class="box-body">
                <table class="table table-bordered table-striped" id="data-kelas">
                      <thead>
                        <tr>
                          <th>Id Kelas</th>
                          <th>Nama Kelas</th>
                          <th>Jurusan</th>
                          <th>Aksi</th>       
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($kelas as $key => $value)
                        <tr>
                          <td>{{ $value->id_kelas }}</td>
                          <td>{{ $value->nama_kelas }}</td>
                          <td>{{ $value->nama_jurusan }}</td>
                          <td width="330px">
                            <button class="btn btn-success btn-edit"><i class="fa fa-edit"> Edit</i></button> &nbsp;<a href="{{ route('hapus-kelas',$value->id_kelas) }}"><button class=" btn btn-danger"><i class="fa fa-trash"> Hapus</i></button></a>
                            <a href="{{ route('data_pemilih',$value->id_kelas) }}" class="btn btn-primary "><i class="fa fa-eye"> Lihat Data Pemilih</i></a> 
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
  <div class="modal fade" id="modal-form-tambah-kelas" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Tambah Kelas</h4>
        </div>
        <div class="modal-body">
           <form action="{{ route('simpan_data_kelas') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id_jurusan" value="{{ $jurusan->id_jurusan }}">
          <div class="form-group has-feedback">
            <input type="text" name="nama_kelas" class="form-control" placeholder="Nama Kelas">
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
    <div class="modal fade" id="modal-form-edit-kelas" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Edit Kelas</h4>
        </div>
        <div class="modal-body">
           <form action="{{ route('edit-kelas') }}" method="post">
            {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input type="text" name="id_kelas"  readonly class="form-control" placeholder=" ID Kelas">
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="nama_kelas" class="form-control" placeholder="Nama Kelas">
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
  var table = $('#data-kelas').DataTable();

  $('#data-kelas').on('click','.btn-edit',function(){
    row = table.row( $(this).closest('tr') ).data();
    console.log(row);
    $('input[name=id_kelas]').val(row[0]);
    $('input[name=nama_kelas]').val(row[1]);
    $('#modal-form-edit-kelas').modal('show');
  });

  $('#modal-form-tambah-kelas').on('show.bs.modal',function(){
    $('input[name=id_kelas]').val('');
    $('input[name=nama_kelas]').val('');
  });
</script>
@endsection