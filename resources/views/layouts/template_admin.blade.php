<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="{{ asset('smkn1.png') }}" type="image/x-icon" />
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title >{{ $title }}</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/ionslider/ion.rangeSlider.min.js') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
  @yield('css')
</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">

  <header class="main-header">
    <a href="{{ route('home-admin') }}" class="logo">
      <span class="logo-mini"><b>IT</b></span>
      <span class="logo-lg"><b>ADMIN</b></span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Navigation</span>
      </a>
    </nav>
  </header>
  <aside class="main-sidebar control-sidebar-dark">
    <section class="sidebar">      
      <ul class="sidebar-menu">
        <li>
          <a href="{{ route('home-admin') }}">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <li>
          <a href="{{ route('info_calon') }}">
            <i class="fa fa-info-circle"></i> <span>Info Calon</span>
          </a>
        </li>
        <li>
          <a href="{{ route('data-jurusan') }}">
            <i class="fa fa-users"></i> <span>Jurusan & Kelas</span>
          </a>
        </li>
        </li>
        <li>
          <a href="{{ route('data_admin') }}">
            <i class="fa fa-user-circle"></i> <span>Admin</span>
          </a>
        </li>
        <li>
          <a href="{{ route('akses') }}">
            <i class="fa fa-wrench"></i> <span>Configurasi</span>
          </a>
        </li>
        <li>
          <a href="{{ route('hasil_suara') }}">
            <i class="fa fa-bar-chart-o"></i> <span>Hasil Suara</span>
          </a>
        </li>
        <li>
          <a href="{{ route('logout') }}">
            <i class="fa fa-sign-out"></i> <span>Logout</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>
  <div class="content-wrapper">
    @yield('content')
  </div>
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Build With <span class="fa fa-coffee"></span> And <span class="fa fa-heart"></b>
      </div>
      <strong>Copyright &copy; 2021 .</strong>
    </footer>
  <div class="control-sidebar-bg"></div>
</div>
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ asset('dist/js/app.min.js') }}"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>
@yield('javascript')
</body>
</html>