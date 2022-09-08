<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;

	use App\Http\Requests;
	use App\Pemilih;
	use App\Hasil_suara;
	use App\Info_calon;
	use Input;
	use Auth;
	class home_pemilih extends Controller
	{		
		public function cek_suara()
		{
			$id = \Auth::user()->id;
			$pemilih = Pemilih::where('user_id',$id)->first();
			if(Hasil_suara::cek_pemilih($pemilih->nis))
			{
				\Session::flash('msg_cek','Anda Sudah Memilih!');
				return \Redirect::to('/');
			}
			else
			{
				return \Redirect::route('pemilihan');
			}
		}
		public function data_calon()
		{
			$data['data_calon'] = Info_calon::get();
			return view('home_pemilih',$data);
		}
		public function pilih_calon()
		{
			$id = \Auth::user()->id;
			$pemilih = Pemilih::where('user_id',$id)->first();
			$data=array(
				'nis'=>$pemilih->nis,
				'id_calon'=>Input::get('id_calon'),
			);
			Hasil_suara::insert($data);
			\Session::flash('msg_telah_milih','Terima Kasih Telah Berpartisipasi Dalam Pemilihan!');
			 Auth::logout();
	        return \Redirect::to('/');
		}
	}
?>