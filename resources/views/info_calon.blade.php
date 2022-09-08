@extends('layouts.template_admin')
@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('home-admin') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Informasi Calon</li>
      </ol>
      <br/>
    </section>
     <section class="content">
          @if(\Session::has('msg_simpan_calon'))
           <h5> <div class="alert alert-info">
              {{ \Session::get('msg_simpan_calon')}}
            </div></h5>
            @endif
            @if(\Session::has('msg_hapus_calon'))
           <h5> <div class="alert alert-danger">
              {{ \Session::get('msg_hapus_calon')}}
            </div></h5>
            @endif
            @if(\Session::has('msg_edit_calon'))
           <h5> <div class="alert alert-warning">
              {{ \Session::get('msg_edit_calon')}}
            </div></h5>
            @endif
    <div class="row">
      <div class="col-xs-12">
          <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Calon</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#modal-form-tambah"><i class="fa fa-user-plus"> Tambah Calon</i></button>
                </div>
              </div>
              <div class="box-body">
                 <table class="table table-bordered table-striped" id="data-info-calon">
            <thead>
              <tr>
                <th>ID Calon</th>
                <th>Nama Calon</th>
                <th>Nama Wakil</th>
                <th>Visi</th>
                <th>Misi</th>
                <th>Video</th>
                <th>Foto Calon</th> 
                <th>Aksi</th>    
              </tr>
            </thead>
              <tbody>
                 @foreach($info_calon as $key => $value)
                    <tr>
                      <td>{{ $value->id_calon }}</td>
                      <td>{{ $value->nama_calon }}</td>
                      <td>{{ $value->nama_wakil }}</td>
                      <td>{{ $value->visi }}</td>
                      <td>{{ $value->misi }}</td>
                      <td>{{ $value->deskripsi_calon }}</td>
                      <td><img width="100px" src="{{ asset('uploads/'.$value->foto_calon) }}"></td>
                      <td width="180px">
                        <button class="btn btn-success btn-edit-calon"><i class="fa fa-edit"> Edit</i></button> &nbsp;<a href="{{ route('hapus-calon',$value->id_calon) }}"><button class=" btn btn-danger"><i class="fa fa-trash"> Hapus</i></button></a>
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
  <div class="modal fade" id="modal-form-tambah" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Tambah Calon</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('simpan_data_calon') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input type="text" name="nama_calon" class="form-control" placeholder="Nama Calon">
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="nama_wakil" class="form-control" placeholder="Nama Wakil">
          </div>
           <div class="form-group has-feedback">
            <textarea type="text" name="visi" class="form-control" placeholder="Visi"></textarea>
          </div>
           <div class="form-group has-feedback">
            <textarea input type="text" name="misi" class="form-control" placeholder="Misi"></textarea>
          </div>
           <div class="form-group has-feedback">
            <textarea type="text" name="deskripsi_calon" class="form-control" placeholder="Deskripsi Calon"></textarea>
          </div>
           <div class="form-group has-feedback">
             <input type="file" name="foto_calon" class="form-control">
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
  <div class="modal fade" id="modal-form-edit" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Ubah Data Calon</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('edit_calon') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input type="text" readonly name="id_calon" class="form-control" placeholder=" ID Calon ">
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="nama_calon" class="form-control" placeholder="Nama Calon">
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="nama_wakil" class="form-control" placeholder="Nama Wakil">
          </div>
           <div class="form-group has-feedback">
            <textarea type="text" name="visi" class="form-control" placeholder="Visi"></textarea>
          </div>
           <div class="form-group has-feedback">
            <textarea input type="text" name="misi" class="form-control" placeholder="Misi"></textarea>
          </div>
           <div class="form-group has-feedback">
            <textarea type="text" name="deskripsi_calon" class="form-control" placeholder="Deskripsi Calon"></textarea>
          </div>
          <div id="old-photo"></div>
           <div class="form-group has-feedback">
            <input type="file" name="foto_calon" class="form-control">
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
  var table = $('#data-info-calon').DataTable();

  $('#data-info-calon').on('click','.btn-edit-calon',function(){
    row = table.row( $(this).closest('tr') ).data();
    console.log(row);
    $('input[name=id_calon]').val(row[0]);
    $('input[name=nama_calon]').val(row[1]);
    $('input[name=nama_wakil]').val(row[2]);
    $('textarea[name=visi]').val(row[3]);
    $('textarea[name=misi]').val(row[4]);
    $('textarea[name=deskripsi_calon]').val(row[5]);
    $('#old-photo').html(row[6]);
    $('#modal-form-edit').modal('show');
  });

  $('#modal-form-tambah').on('show.bs.modal',function(){
    $('input[name=id_calon]').val('');
    $('input[name=nama_calon]').val('');
    $('input[name=nama_wakil]').val('');
    $('textarea[name=visi]').val('');
    $('textarea[name=misi]').val('');
    $('textarea[name=deskripsi_calon]').val('');
  });
</script>
@endsection