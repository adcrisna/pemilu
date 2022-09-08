@extends('layouts.template_admin')
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
@endsection

@section('content')
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('home-admin') }}"><i class="fa fa-home"></i> Home</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
         <center> <h1> <b> Aplikasi Pemilihan Ketua Organisasi</b> <BR/> Universitas CIC CIREBON </h1> </center>      
      </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-sort-amount-asc"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Jumlah Pemilih</span>
              <span class="info-box-number">{{ $total_pemilih }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Sudah Memilih</span>
              <span class="info-box-number">{{ $sudah_memilih }}</span>
            </div>
          </div>
        </div>

        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-close"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> Belum Memilih</span>
              <span class="info-box-number">{{ $belum_memilih }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah Calon</span>
              <span class="info-box-number">{{ $jumlah_calon }}</span>
            </div>
          </div>
        </div>
    </div>
      <div class="row">
      <div class="col-sm-12">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Hasil Suara</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
               <!--  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div>
          </div>
        </div>
      </div>
  </section>
@endsection

@section('javascript')
<script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('plugins/raphael/raphael-min.js') }}"></script>
<script>

  var bar = new Morris.Bar({
        element: 'bar-chart',
        resize: true,
        data: [
     @foreach($hasil_suara as $key => $value)
          {n: '{{ $value->nama_calon }}', a: {{ $value->hasil_suara }}},
     @endforeach
        ],
        barColors: ['#f56954','#00a65a', '#f56954'],
        xkey: 'n',
        ykeys: 'a',
        labels: 'Jumlah Suara',
        hideHover: 'auto'
      });
</script>
@endsection