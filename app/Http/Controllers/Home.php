<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;

	use App\Http\Requests;
	use Auth;
	use App\Hasil_Suara;
	use App\Pemilih;
	use App\Info_calon;
	class Home extends Controller
	{		

		public function home()
	    {
	    	$data['sudah_memilih'] =Hasil_Suara::count('nis');
	        $data['total_pemilih'] =Pemilih::count('nis');
	        $data['belum_memilih'] = $data['total_pemilih'] - $data['sudah_memilih'];
	        $data['jumlah_calon'] =Info_calon::count('id_calon');
	        $data['hasil_suara'] = Hasil_Suara::list_hasil_suara();
	    	$data['title'] = 'Home';
	        return view('home',$data);
	    }
	    function logout()
	    {
	        Auth::logout();
	        return \Redirect::to('/');
	    }
	}
?>