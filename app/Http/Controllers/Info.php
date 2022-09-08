<?php
	
	namespace App\Http\Controllers;

	use Illuminate\Http\Request;

	use App\Http\Requests;
	use Auth;
	use Input;
	use App\Info_calon;
	use Redirect;
	class Info extends Controller
	{
		public function info()
		{
			$data['title'] = 'Informasi Calon';
			$data['info_calon'] = Info_calon::get();
			return view('info_calon',$data);
		}
		public function simpan_data_calon(Request $request)
		{
			$photo = $request->file('foto_calon')->getClientOriginalName();
			$destination = base_path() .'/public/uploads';
			$request->file('foto_calon')->move($destination,$photo);
			$data=array(
				'id_calon'=>Input::get('id_calon'),
				'nama_calon'=>Input::get('nama_calon'),
				'nama_wakil'=>Input::get('nama_wakil'),
				'visi'=>Input::get('visi'),
				'misi'=>Input::get('misi'),
				'deskripsi_calon'=>Input::get('deskripsi_calon'),
				'foto_calon'=>$photo
			);
			Info_calon::insert($data);
			\Session::flash('msg_simpan_calon','Data Calon Berhasil Ditambah!');
			return Redirect::route('info_calon');
		}
		public function hapus_calon($id_calon)
		{
			Info_calon::where('id_calon','=',$id_calon)->delete();
			\Session::flash('msg_hapus_calon','Data Calon Berhasil Dihapus!');
			return Redirect::route('info_calon');
		}
		public function edit_calon(Request $request)
		{
			$id = Input::get('id_calon');
			$data=array(
				'nama_calon'=>Input::get('nama_calon'),
				'nama_wakil'=>Input::get('nama_wakil'),
				'visi'=>Input::get('visi'),
				'misi'=>Input::get('misi'),
				'deskripsi_calon'=>Input::get('deskripsi_calon'),
			);

			if ($request->file('foto_calon')) 
			{
				$photo = $request->file('foto_calon')->getClientOriginalName();
				$destination = base_path() .'/public/uploads';
				$request->file('foto_calon')->move($destination,$photo);
				$data['foto_calon'] = $photo;
			}
			Info_calon::where('id_calon','=',$id)->update($data);
			\Session::flash('msg_edit_calon','Data Calon Berhasil Diedit!');
			return Redirect::route('info_calon');
		}
	}
?>