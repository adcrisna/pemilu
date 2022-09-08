<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Akses;
use Auth;
Use App\Hasil_Suara;
use App\Pemilih;
use App\Info_calon;
class Login extends Controller
{
    public function form()
    {

        $data['sudah_memilih'] =Hasil_Suara::count('nis');
        $data['total_pemilih'] =Pemilih::count('nis');
        $data['belum_memilih'] = $data['total_pemilih'] - $data['sudah_memilih'];
        $data['jumlah_calon'] =Info_calon::count('id_calon');
        $data['hasil_suara'] = Hasil_Suara::list_hasil_suara();
    	return view('login',$data);
    }
    public function proseslogin(Request $request)
    {
        if (Auth::attempt(['username'=>$request->username,'password'=>$request->password]))
        {
            if (Auth::user()->level == "1") 
            {
                return \Redirect::to('/admin/home');
            }
            else
            {
                $akses = Akses::where('portal_login','<',date('Y-m-d H:i:s'))->first();
                if ( ! $akses) 
                {
                    Auth::Logout();

                   \Session::flash('msg_login','Maaf Akses Untuk Pemilih Masih Ditutup!');
                    return \Redirect::to('/');
                }

                 return \Redirect::route('cek-suara');
            }

        }
        else
        {
            \Session::flash('msg_login','Username Atau Password Salah!');
            return \Redirect::to('/');
        }
        

    }
}
?>