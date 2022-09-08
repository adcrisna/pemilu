<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',['uses'=>'Login@form']);
Route::get('/logout',['uses'=>'Home@logout','as'=>'logout']);
Route::post('/proses_login',['uses'=>'Login@proseslogin','as'=>'proses_login']);

Route::group(['middleware'=>'auth'],function(){
	Route::group(['prefix'=>'admin','middleware'=>'checklevel:1'],function(){
		Route::get('/home',['uses'=>'Home@home','as'=>'home-admin']);
		Route::group(['prefix'=>'pemilih'],function(){
			route::get('/data/{kelas}',['uses'=>'Data_pemilih@data','as'=>'data_pemilih']);
			route::post('/simpan_data_pemilih',['uses'=>'Data_pemilih@simpan_data_pemilih','as'=>'simpan_data_pemilih']);
			route::get('/hapus_pemilih/{nis}',['uses'=>'Data_pemilih@hapus_pemilih','as'=>'hapus-pemilih']);
			route::post('/edit_pemilih',['uses'=>'Data_pemilih@edit_pemilih','as'=>'edit_pemilih']);
			route::post('/upload_pemilih',['uses'=>'Data_pemilih@upload_pemilih','as'=>'upload-pemilih']);
			route::get('/cetak_kartu/{id_kelas}',['uses'=>'Data_pemilih@cetak_kartu_pemilih','as'=>'cetak-kartu-pemilih']);
		});
		Route::group(['prefix'=>'info_calon'],function(){
			route::get('/info',['uses'=>'Info@info','as'=>'info_calon']);
			route::post('/simpan_data_calon',['uses'=>'Info@simpan_data_calon','as'=>'simpan_data_calon']);
			route::get('/hapus_calon/{id_calon}',['uses'=>'Info@hapus_calon','as'=>'hapus-calon']);
			route::post('/edit_calon',['uses'=>'Info@edit_calon','as'=>'edit_calon']);
		});
		Route::group(['prefix'=>'hasil_suara'],function(){
			route::get('/hasil_suara',['uses'=>'HasilSuara@tampil_hasil','as'=>'hasil_suara']);
			route::post('/cari_hapus',['uses'=>'HasilSuara@cari_hapus','as'=>'cari_hapus']);
			route::post('/reset_suara',['uses'=>'HasilSuara@reset','as'=>'reset_hasil_suara']);
			route::get('/cetak_berita',['uses'=>'HasilSuara@cetak_berita_acara','as'=>'cetak-berita-acara']);
		});
		Route::group(['prefix'=>'users'],function(){
			route::get('/data_admin',['uses'=>'Admin@data_admin','as'=>'data_admin']);
			route::post('/simpan_data_admin',['uses'=>'Admin@simpan_data_admin','as'=>'simpan_data_admin']);
			route::get('/hapus_admin/{id}',['uses'=>'Admin@hapus_admin','as'=>'hapus_admin']);
			route::post('/edit_admin',['uses'=>'Admin@edit_admin','as'=>'edit_admin']);
		});
		route::group(['prefix'=>'akses'],function(){
			route::get('/akses_pemilih',['uses'=>'AksesController@index','as'=>'akses']);
			route::post('/update_akses',['uses'=>'AksesController@update_akses','as'=>'update_akses']);
		});
		route::group(['prefix'=>'jurusan'],function(){
			route::get('/data_jurusan',['uses'=>'JurusanController@index','as'=>'data-jurusan']);
			route::post('/simpan_data_jurusan',['uses'=>'JurusanController@simpan_data_jurusan','as'=>'simpan_data_jurusan']);
			route::get('/hapus_jurusan/{id_jurusan}',['uses'=>'JurusanController@hapus_jurusan','as'=>'hapus-jurusan']);
			route::post('/edit_jurusan',['uses'=>'JurusanController@edit_jurusan','as'=>'edit_jurusan']);
		});
		route::group(['prefix'=>'kelas'],function(){
			route::get('/data/{jurusan}',['uses'=>'KelasController@index','as'=>'data-kelas']);
			route::post('/simpan_data_kelas',['uses'=>'KelasController@simpan_data_kelas','as'=>'simpan_data_kelas']);
			route::get('/hapus_kelas/{id_kelas}',['uses'=>'KelasController@hapus_kelas','as'=>'hapus-kelas']);
			route::post('/edit_kelas',['uses'=>'KelasController@edit_kelas','as'=>'edit-kelas']);
		});
	});
	Route::group(['prefix'=>'pemilih','middleware'=>'checklevel:2'],function(){
		Route::get('/cek-suara',['uses'=>'Home_pemilih@cek_suara','as'=>'cek-suara']);
		route::get('/pemilihan',['uses'=>'Home_pemilih@data_calon','as'=>'pemilihan']);
		route::post('/pilih_calon',['uses'=>'Home_pemilih@pilih_calon','as'=>'pilih_calon']);
		});
	});
?>