@extends('layouts.template_admin')
@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('home-admin') }}"><i class="fa fa-home"></i> Home</a></li>
      <li> Data Jurusan</li>
      <li> Data Kelas</li>
      <li class="active">Data Pemilih</li>
    </ol>
    <br/>
  </section>
  <section class="content">
         @if(\Session::has('msg_edit_pemilih'))
           <h5> <div class="alert alert-warning">
              {{ \Session::get('msg_edit_pemilih')}}
            </div></h5>
            @endif
            @if(\Session::has('msg_hapus_pemilih'))
           <h5> <div class="alert alert-danger">
              {{ \Session::get('msg_hapus_pemilih')}}
            </div></h5>
            @endif
    <div class="row">
      <div class="col-xs-12">
        @if(\Session::has('msg_duplicate'))
           <h5> <div class="alert alert-danger">
              Ada Nis Yang Duplicate, yaitu:
              <ol>
                @foreach(\Session::get('msg_duplicate') as $duplicate)
                <li>
                  {{ $duplicate }}
                </li>
                @endforeach
              </ol>
            </div></h5>
            @endif
            @if(\Session::has('msg_berhasil'))
           <h5> <div class="alert alert-success">
              {{ \Session::get('msg_berhasil')}}
            </div></h5>
            @endif
             @if(\Session::has('msg_simpan_data_pemilih'))
           <h5> <div class="alert alert-info">
              {{ \Session::get('msg_simpan_data_pemilih')}}
            </div></h5>
            @endif
          <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Pemilih Dari Kelas : {{ $kelas->nama_kelas }}</h3>
                <div class="box-tools pull-right">
                  <a href="{{ route('cetak-kartu-pemilih',$kelas->id_kelas) }}"><button class="btn btn-warning"><i class="fa fa-print"> Cetak Data Pemilih </i></button></a>
                  <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#modal-form-tambah-pemilih"><i class="fa fa-user-plus"> Tambah Pemilih</i></button>
                  <!-- <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#modal-form-upload-pemilih"><i class="fa fa-cloud-upload"> Upload Pemilih</i></button> -->
                </div>
              </div>
              <div class="box-body">
                <table class="table table-bordered table-striped" id="data-pemilih">
                  <thead>
                    <tr>
                      <th>Nis</th>
                      <th>Nama</th>
                      <th>Jenis Kelamin</th>
                      <th>Tanggal Lahir</th>
                      <th>Tempat Lahir</th>
                      <th>Aksi</th>       
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($pemilih as $key => $value)
                    <tr>
                      <td>{{ $value->nis }}</td>
                      <td width="120px">{{ $value->nama }}</td>
                      <td>{{ $value->jenis_kelamin }}</td>
                      <td>{{ $value->tanggal_lahir }}</td>
                      <td>{{ $value->tempat_lahir }}</td>
                      <td>
                        <button class="btn btn-success btn-edit"><i class="fa fa-edit"> Edit</i></button> &nbsp;<a href="{{ route('hapus-pemilih',$value->nis) }}"><button class=" btn btn-danger"><i class="fa fa-trash"> Hapus</i></button></a>
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
  <div class="modal fade" id="modal-form-tambah-pemilih" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Tambah Pemilih</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('simpan_data_pemilih') }}" method="post">
            {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input type="text" name="nis" class="form-control" placeholder=" NIS ">
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="nama" class="form-control" placeholder="Nama">
          </div>
          <div class="form-group has-feedback">
            <label> Jenis Kelamin :</label><br>
            <label class="radio-inline"><input type="radio" name="jenis" value="L">L</label>
            <label class="radio-inline"><input type="radio" name="jenis" value="P">P</label>
          </div>
          <label> Tanggal Lahir:</label>
          <div class="form-group has-feedback">
              <input type="date" name="tanggal" class="form-control">
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="tempat" class="form-control" placeholder="Tempat Lahir">
          </div>
          <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
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
          <h4 class="modal-title">Form Edit Pemilih</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('edit_pemilih') }}" method="post">
            {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input type="text" name="nis" readonly class="form-control" placeholder=" NIS ">
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="nama" class="form-control" placeholder="Nama">
          </div>
          <div class="form-group has-feedback">
            <label> Jenis Kelamin :</label><br>
            <label class="radio-inline"><input type="radio" name="jenis" value="L">L</label>
            <label class="radio-inline"><input type="radio" name="jenis" value="P">P</label>
          </div>
          <label> Tanggal Lahir:</label>
          <div class="form-group has-feedback">
              <input type="date" name="tanggal" class="form-control">
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="tempat" class="form-control" placeholder="Tempat Lahir">
          </div>
          <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
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
  <div class="modal fade" id="modal-form-upload-pemilih" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Upload Pemilih</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('upload-pemilih') }}" method="post" id="form-upload" enctype="multipart/form-data">
            {{ csrf_field() }}
              <div class="form-group has-feedback">
                <input type="file" name="file">
                <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
              </div>
          </form>
      </div>
          <div class="modal-footer">
            <a href="{{ asset('Template_pemilih.xlsx') }}"><button class="btn btn-warning"><i class="fa fa-cloud-download"> Download Template</i></button></a>
              <button form="form-upload" type="submit" class="btn btn-primary btn-flat">Simpan</button>
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
  var table = $('#data-pemilih').DataTable();

  $('#data-pemilih').on('click','.btn-edit',function(){
    row = table.row( $(this).closest('tr') ).data();
    console.log(row);
    $('input[name=nis]').val(row[0]);
    $('input[name=nama]').val(row[1]);
    $('input[name=jenis][value='+row[2]+']').prop('checked',true);
    $('input[name=tanggal]').val(row[3]);
    $('input[name=tempat]').val(row[4]);
    $('select[name=id_kelas]').val(row[5]);
    $('#modal-form-edit').modal('show');
  });

  $('#modal-form-tambah-pemilih').on('show.bs.modal',function(){
    $('input[name=nis]').val('');
    $('input[name=nama]').val('');
    $('input[name=jenis][value=L]').prop('checked',true);
    $('input[name=tanggal]').val('');
    $('input[name=tempat]').val('');
    $('select[name=id_kelas]').val('');
  });
</script>
@endsection