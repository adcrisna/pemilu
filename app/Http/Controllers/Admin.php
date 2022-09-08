<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;

	use App\Http\Requests;
	use Auth;
	use Input;
	use App\Pemilih;
	use App\User;
	use Redirect;
	class Admin extends Controller
	{
		public function data_admin()
		{
			$data['title'] = 'Data Admin';
			$data['users'] = User::where('level',1)->get();
			return view('data_admin',$data);
		}
		public function simpan_data_admin()
		{
			$password = Input::get('password');

			$user = user::create([
				'id'=>Input::get('id'),
				'nama'=>Input::get('nama'),
				'username'=>Input::get('username'),
				'password'=>bcrypt($password),
				'level'=>1
			]);
				\Session::flash('msg_simpan_admin','Data Admin Berhasil Ditambah!');
			return Redirect::route('data_admin');
		}
		public function hapus_admin($id)
		{
			$admin = User::where('id','=',$id)->first();
			User::where('id','=',$id)->delete();
				\Session::flash('msg_hapus_admin','Data Admin Berhasil Dihapus!');
			return Redirect::route('data_admin');
		}
		public function edit_admin()
		{
			$password = Input::get('password');
			$data=array(
				'id'=>Input::get('id'),
				'nama'=>Input::get('nama'),
				'username'=>Input::get('username'),
				'password'=>bcrypt($password),
			);
			User::where('id','=',$data['id'])->update($data);
				\Session::flash('msg_edit_admin','Data Admin Berhasil Diedit!');
			return Redirect::route('data_admin');
		}
	}
?>