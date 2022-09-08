<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;

	use App\Http\Requests;
	use Auth;
	use Input;
	use App\Kelas;
	USE App\Jurusan;
	use Redirect;
	class KelasController extends Controller
	{
		public function index($jurusan)
		{
			$data['jurusan'] = Jurusan::where('id_jurusan',$jurusan)->first();
			$data['title'] = 'Kelas';
			$data['kelas'] = Kelas::where('kelas.id_jurusan',$jurusan)
			->join('jurusan','jurusan.id_jurusan','=','kelas.id_jurusan')->get();
			return view('data_kelas',$data);
		}
		public function simpan_data_kelas()
		{
			$data=array(
				'id_kelas'=>null,
				'nama_kelas'=>Input::get('nama_kelas'),
				'id_jurusan'=>Input::get('id_jurusan'),
			);
			Kelas::insert($data);
			\Session::flash('msg_simpan_kelas','Data Kelas Berhasil Ditambah!');
			return Redirect::route('data-kelas',$data['id_jurusan']);
		}
		public function hapus_kelas($id_kelas)
		{
			$kelas = Kelas::where('id_kelas','=',$id_kelas)->first();
			Kelas::where('id_kelas','=',$id_kelas)->delete();
			\Session::flash('msg_hapus_kelas','Data Kelas Berhasil Dihapus!');
			return Redirect::back();
		}
		public function edit_kelas()
		{
			$data=array(
				'id_kelas'=>Input::get('id_kelas'),
				'nama_kelas'=>Input::get('nama_kelas'),
			);
			Kelas::where('id_kelas','=',$data['id_kelas'])->update($data);
			\Session::flash('msg_edit_kelas','Data kelas Berhasil Dihapus!');
			return Redirect::back();
		}
	}
?>