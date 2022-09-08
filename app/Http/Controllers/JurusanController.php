<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;

	use App\Http\Requests;
	use Auth;
	use Input;
	use App\Jurusan;
	use Redirect;
	class JurusanController extends Controller
	{
		public function index()
		{
			$data['title'] = 'Jurusan';
			$data['jurusan'] = Jurusan::get();
			return view('data_jurusan',$data);
		}
		public function simpan_data_jurusan()
		{
			$data=array(
				'id_jurusan'=>null,
				'nama_jurusan'=>Input::get('nama_jurusan'),
			);
			Jurusan::insert($data);
			\Session::flash('msg_simpan_jurusan','Data Jurusan Berhasil Ditambah!');
			return Redirect::route('data-jurusan');
		}
		public function hapus_jurusan($id_jurusan)
		{
			$jurusan = Jurusan::where('id_jurusan','=',$id_jurusan)->first();
			Jurusan::where('id_jurusan','=',$id_jurusan)->delete();
			\Session::flash('msg_hapus_jurusan','Data jurusan Berhasil Dihapus!');
			return Redirect::route('data-jurusan');
		}
		public function edit_jurusan()
		{
			$data=array(
				'id_jurusan'=>Input::get('id_jurusan'),
				'nama_jurusan'=>Input::get('nama_jurusan'),
			);
			Jurusan::where('id_jurusan','=',$data['id_jurusan'])->update($data);
			\Session::flash('msg_edit_jurusan','Data Jurusan Berhasil edit!');
			return Redirect::route('data-jurusan');
		}
	}
?>