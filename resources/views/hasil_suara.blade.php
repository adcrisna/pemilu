@extends('layouts.template_admin')
@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
@endsection

@section('content')
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('home-admin') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Hasil Suara</li>
      </ol>
      <br/>
    </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-6">
              @if(\Session::has('msg_cari'))
                <div class="alert alert-warning">
                  {{ \Session::get('msg_cari')}}
                </div>
                @endif
                @if(\Session::has('msg_reset'))
                <div class="alert alert-danger">
                  {{ \Session::get('msg_reset')}}
                </div>
                @endif
          <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title">Hasil Suara</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-reset"><i class="fa fa-refresh"> Reset</i></button>
                </div>
             </div>
              <div class="box-body">
                <form action="{{ route('cari_hapus') }}" method="post" enctype="multipart/form-data">
                     {{ csrf_field() }}
                  <div class="form-group">
                  <input type="text" class="form-control" name="ceknis" placeholder="Masukan NIS">
                  </div>
                  <button class="btn btn-warning"><i class="fa fa-search"> Cari & Hapus </i></button>
                </form>
                <br/>
                 <table class="table table-bordered table-striped" id="hasil-suara">
            <thead>
              <tr>
                <th>ID Calon</th>
                <th>Nama Ketua</th>
                <th>Nama Wakil</th>
                <th>Jumlah Suara</th>
              </tr>
            </thead>
              <tbody>
                 @foreach($hasil_suara as $key => $value)
                    <tr>
                      <td>{{ $value->id_calon }}</td>
                      <td>{{ $value->nama_calon }}</td>
                      <td>{{ $value->nama_wakil }}</td>
                      <td>{{ $value->hasil_suara}}</td>
                    </tr>
                    @endforeach
              </tbody>
          </table>
           </div>
       </div>         
      </div>
      <div class="col-xs-6">
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Hasil Suara</h3>

              <div class="box-tools pull-right">
                <a href="{{ route('cetak-berita-acara') }}"><button class="btn btn-info"> Cetak Berita Acara</button></a>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div>
          </div>
      </div>
    </div>
  </section>
    <div class="modal fade" id="modal-reset" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Apakah anda yakin ingin mereset semua hasil suara?</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('reset_hasil_suara') }}" method="post" class="text-center form-reset">
            {{ csrf_field() }}
          <button type="submit" name="id_calon" class="btn btn-lg btn-primary">Iya</button>
          <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Tidak</button>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
<script type="text/javascript">
  var table = $('#hasil-suara').DataTable();

    var bar = new Morris.Bar({
        element: 'bar-chart',
        resize: true,
        data: [
     @foreach($hasil_suara as $key => $value)
          {n: '{{ $value->nama_calon }}', a: {{ $value->hasil_suara }}},
     @endforeach
        ],
        barColors: ['#00a65a', '#f56954'],
        xkey: 'n',
        ykeys: 'a',
        labels: 'Jumlah Suara',
        hideHover: 'auto'
      });
    
</script>
@endsection