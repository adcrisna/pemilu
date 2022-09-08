@extends('layouts.template_admin')
@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('home-admin') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"> Akses</li>
      </ol>
      <br/>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Configurasi :</h3>
                  <div class="box-tools pull-right">
                  </div>
                </div>
               <div class="box-body">
                @if(\Session::has('msg_info'))
                <div class="alert alert-info">
                  {{ \Session::get('msg_info')}}
                </div>
                @endif
                <form id="formakses" action="{{ route('update_akses') }}" method="post" class="form-horizontal">
                  {{ csrf_field() }}
                <div class="form-group">
                  <label for="inputTangal" class="col-sm-4 control-label">Tanggal</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" value="{{ $tanggal }}" name="tanggal" placeholder="Tanggal">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputWaktu" class="col-sm-4 control-label">Waktu</label>
                  <div class="col-sm-8">
                    <input type="time" class="form-control" value="{{ $waktu }}" name="waktu" placeholder="Waktu">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputWaka" class="col-sm-4 control-label">Kemahasiswaan</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="{{ $wakasek }}" name="wakepsek" placeholder="Waka Kesiswaan">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputNipWaka" class="col-sm-4 control-label">NIP Kemahasiswaan</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="{{ $nipwakasek }}" name="nipwakepsek" placeholder="Nip Waka Kesiswaan">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputKepalaSekolah" class="col-sm-4 control-label">Rektor</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="{{ $kepsek }}" name="kepsek" placeholder="Kepala Sekolah">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputNipKepalaSekolah" class="col-sm-4 control-label">NIP REKTOR</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="{{ $nipkepsek }}" name="nipkepsek" placeholder="Nip Kepala Sekolah">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputKetuaPemilu" class="col-sm-4 control-label">Ketua Pemilu</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="{{ $ketuapemilu }}" name="ketuapemilu" placeholder="Ketua Pemilu">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputNisKetuaPemilu" class="col-sm-4 control-label">NIM Ketua Pemilu</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="{{ $nisketua }}" name="nisketua" placeholder="Nis Ketua Pemilu">
                  </div>
                </div>
               </form>
              </div>
              <div class="box-footer">
                <button form="formakses" type="submit" class="btn btn-info pull-right">Simpan</button>
              </div>
            </div> 
          </div>
        </div>
      </section>           
@endsection

@section('javascript')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
</script>
@endsection