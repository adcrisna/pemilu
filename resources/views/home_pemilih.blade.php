<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="cic.png" type="image/x-icon" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pemilihan</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">

</head>
  <body class="hold-transition login-page">
  <div class="container">
  <br/>
  <div class="login-logo">
    <a href="#"><b>Pemilihan Ketua Organisasi</b> <br> Universitas CIC CIREBON</a>
  </div>
  <br/>
  <div class="row">
  @foreach($data_calon as $key => $value)

  <div class="col-md-4">
    <div class="box box-primary">
      <div class="box-body box-profile" >
        <div class="row">
          <div class="col-md-6">
            <img class="profile-user-img img-responsive img-circle pull-left" src="{{ asset('uploads/'.$value->foto_calon) }}" style="width: 180px !important; height: 150px !important;" alt="Foto Calon">
          </div>
          <div class="col-md-6">
            <h3 class="profile-username text-left">Calon {{ ($key+1) }}
              <br/><small>{{ $value->nama_calon }} & {{ $value->nama_wakil }}</small>
            </h3>
            <p>
              <b>Visi</b> - {{ $value->visi }}
            </p>
          </div>
      </div>
      </div>
      <div class="box-footer">
         <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-deskripsi-{{ $key }}"><i class="fa fa-eye"> Lihat Deskripsi Calon</i></button>
        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-pilih-{{ $key }}"><i class="fa fa-paper-plane-o"> PILIH</i></button>
        
      </div>
    </div>
    <div class="modal fade" id="modal-deskripsi-{{ $key }}" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
                <h4 class="modal-title">Deskripsi Calon {{ $key+1 }}</h4>
          </div>
           <img class="profile-user-img img-responsive img-circle pull-left" src="{{ asset('uploads/'.$value->foto_calon) }}" style="width: 180px !important; height: 150px !important;" alt="Foto Calon">
              <div class="modal-body">
                <h3 class="profile-username text-center">Calon {{ ($key+1) }}
                  <br/><small>{{ $value->nama_calon }} & {{ $value->nama_wakil }}</small>
                </h3>
                <br/>
                <br/>
                  <p>
                    <b>Visi</b> - {{ $value->visi }}
                  </p>
                  <hr>
                  <p>
                    <label>Misi : </label><br/>
                       {{ $value->misi }}
                  </p>
                  <hr>
                  <p>
                    <label>Deskripsi : </label><br/>
                    {{ $value->deskripsi_calon }}
                  </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              </div>
        </div>
      </div>
    </div>
  </div>
   <div class="modal fade" id="modal-pilih-{{ $key }}" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Apakah Anda Yakin Memilih Calon {{ $key+1 }}</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('pilih_calon') }}" method="post" class="text-center form-pilih">
            {{ csrf_field() }}
          <button type="submit" name="id_calon" value="{{ $value->id_calon }}" class="btn btn-lg btn-primary">Iya</button>
          <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Tidak</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  {!! ( $key+1) % 3 == 0 ? '</div><div class="row">' :'' !!}
  @endforeach
    
  </div>
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
</body>
</html>