<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Akses;
use Auth;
use Input;
class AksesController extends Controller
{
	public function index()
	{
		$data['title']='Akses';
		$akses= Akses::first();
		$data['tanggal'] =date('Y-m-d',strtotime($akses->portal_login));
		$data['waktu'] =date('H:i:s',strtotime($akses->portal_login));
		$data['wakasek'] = $akses->nama_wakepsek;
		$data['nipwakasek'] = $akses->nip_wakepsek;
		$data['kepsek'] = $akses->nama_kepsek;
		$data['nipkepsek'] = $akses->nip_kepsek;
		$data['ketuapemilu'] = $akses->nama_ketua_pemilu;
		$data['nisketua'] = $akses->nis_ketua_pemilu;

		return view('akses',$data);
	}
	public function update_akses()
	{
		$tanggal = Input::get('tanggal');
		$waktu = Input::get('waktu');
		$wakasek = Input::get('wakepsek');
		$nipwakasek = Input::get('nipwakepsek');
		$kepsek = Input::get('kepsek');
		$nipkepsek = Input::get('nipkepsek');
		$ketuapemilu = Input::get('ketuapemilu');
		$nisketua = Input::get('nisketua');


		Akses::where('id',1)->update([
			'portal_login'=>date('Y-m-d',strtotime($tanggal)).' '.$waktu,
			'nama_wakepsek'=>$wakasek,'nip_wakepsek'=>$nipwakasek,'nama_kepsek'=>$kepsek,'nip_kepsek'=>$nipkepsek,'nama_ketua_pemilu'=>$ketuapemilu,'nis_ketua_pemilu'=>$nisketua
		]);
		 \Session::flash('msg_info','Data Berhasil Diperbaharui!');
		return \Redirect::route('akses');
	}
}
?>