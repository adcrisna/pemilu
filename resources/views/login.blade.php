<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="smkn1.png" type="image/x-icon" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Selamat Datang</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
</head>
<body class="hold-transition login-page">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <br/>
          <div class="login-logo">
          <b>Aplikasi Pemilihan Ketua Organisasi</b> <br> Universitas CIC <!-- {{ bcrypt('admin') }} -->
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-edit"></i></span>

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
    </div>
    <div class="row">
    <div class="col-sm-8">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Hasil Suara</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div>
          </div>
    </div>
    <div class="col-sm-4">
      <div class="login-box" style="width: 100% !important;margin-top: 0px !important">
         @if(\Session::has('msg_telah_milih'))
           <h5> <div class="alert alert-info">
              {{ \Session::get('msg_telah_milih')}}
            </div></h5>
            @endif
        <div class="login-box-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form action="{{ route('proses_login') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
              <input type="text" name="username" class="form-control" placeholder="Username">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" name="password" class="form-control" placeholder="Password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            @if(\Session::has('msg_login'))
            <div class="alert alert-danger">
              {{ \Session::get('msg_login')}}
            </div>
            @endif
            @if(\Session::has('msg_cek'))
            <div class="alert alert-warning">
              {{ \Session::get('msg_cek')}}
            </div>
            @endif
            <div class="row">
              <div class="col-xs-4 col-xs-offset-8">
                <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"> Login</i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    </div>
  </div>
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('plugins/raphael/raphael-min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });
  });

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
</body>
</html>