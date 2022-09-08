<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;

	use App\Http\Requests;
	use Auth;
	use Input;
	use App\Pemilih;
	use App\User;
	use Redirect;
	use App\Kelas;
	use Excel;
	use Fpdf;
	class Data_pemilih extends Controller
	{
		public function data($kelas)
		{
			$data['jurusan'] = Kelas::where('id_kelas',$kelas)->first();
			$data['title'] = 'Data Pemilih';
			$data['kelas'] = Kelas::where('id_kelas',$kelas)->first();
			$data['pemilih'] = Pemilih::where('id_kelas',$kelas)->get();
			return view('data_pemilih',$data);
		}
		public function simpan_data_pemilih()
		{
			$tanggal = Input::get('tanggal');
			$tanggal_password = date('dmY',strtotime($tanggal));

			$user = user::create([
				'nama'=>Input::get('nama'),
				'username'=>Input::get('nis'),
				'password'=>bcrypt($tanggal_password),
				'level'=>2
			]);
			$data=array(
				'nis'=>Input::get('nis'),
				'nama'=>Input::get('nama'),
				'jenis_kelamin'=>Input::get('jenis'),
				'tanggal_lahir'=>Input::get('tanggal'),
				'tempat_lahir'=>Input::get('tempat'),
				'id_kelas'=>Input::get('id_kelas'),
				'user_id'=>$user->id
			);
			Pemilih::insert($data);
			 \Session::flash('msg_simpan_data_pemilih','Data Pemilih Berhasil Disimpan!');
			return Redirect::back();
		}
		public function hapus_pemilih($nis)
		{
			$pemilih = Pemilih::where('nis','=',$nis)->first();
			Pemilih::where('nis','=',$nis)->delete();
			User::where('id','=',$pemilih->user_id)->delete();
				\Session::flash('msg_hapus_pemilih','Data Pemilih Berhasil Dihapus!');
			return Redirect::back();
		}
		public function edit_pemilih()
		{
			$data=array(
				'nis'=>Input::get('nis'),
				'nama'=>Input::get('nama'),
				'jenis_kelamin'=>Input::get('jenis'),
				'tanggal_lahir'=>Input::get('tanggal'),
				'tempat_lahir'=>Input::get('tempat'),
			);
			Pemilih::where('nis','=',$data['nis'])->update($data);
				\Session::flash('msg_edit_pemilih','Data Pemilih Berhasil Diedit!');
			return Redirect::back();
		}

		private $obj_excel;
		public function upload_pemilih(Request $request)
	    {
	        $kelas = Input::get('id_kelas');
	        $data = [];
	        $user = [];
	        Excel::load($request->file,function($reader){
	            $reader->formatDates(true,'Y-m-d');
	            $this->obj_excel = $reader->toObject();
	        });
	        $user_id = (int) User::max('id');
	        $nis_now = [];
	        $duplicate_nis = [];
	        foreach($this->obj_excel as $v) 
	        {
	            $user_id++;
	            $nis = str_replace(' ', '', $v->nis);
	            if ( ( ! is_null($nis)) && ( ! empty($nis)) && $nis !== 0 ) 
	            {
	                if (Pemilih::where('nis',$nis)->count() > 0 || in_array($nis, $nis_now)) 
	                {
	                    $duplicate_nis[] = $nis.' - '.$v->nama;
	                }
	                else
	                {
	                    $nis_now[] = $nis;
	                    $user[] = [
	                            'id'=>$user_id,
	                            'nama' => $v->nama,
	                            'username'=>$nis,
	                            'password'=>bcrypt(date('dmY',strtotime($v->tanggal_lahir))),
	                            'level'=>2,
	                            'created_at'=>date('Y-m-d H:i:s'),
	                            'updated_at'=>date('Y-m-d H:i:s'),
	                        ];
	                    $data[] = [
	                            'user_id' => $user_id,
	                            'nis' =>$v->nis,
	                            'nama' => $v->nama,
	                            'tempat_lahir' => $v->tempat_lahir,
	                            'tanggal_lahir' => date('Y-m-d',strtotime($v->tanggal_lahir)),
	                            'jenis_kelamin' => $v->jenis_kelamin,
	                            'id_kelas' =>$kelas,
	                        ];
	                }
	            }
	        }
	        if (sizeof($duplicate_nis) > 0) 
	        {
	        	\Session::flash('msg_duplicate', $duplicate_nis);
	        }
	        if (sizeof($user) > 0) 
	        {
	            User::insert($user);
	            Pemilih::insert($data);
	            \Session::flash('msg_berhasil','Data Pemilih Berhasil Diupload!');
	        }
	        return Redirect::route('data_pemilih',$kelas);
	    }

	    public function cetak_kartu_pemilih($id_kelas)
	     {
		    $pemilih = Pemilih::join('users as u','pemilih.user_id','=','u.id')
		                      ->select('pemilih.nama','u.username','pemilih.tanggal_lahir')
		                      ->where('pemilih.id_kelas','=',$id_kelas)
		                      ->get();

		      $kelas = Kelas::where('id_kelas',$id_kelas)->first();
		      $pdf = new fpdf('P','mm');
		      $pdf::AddPage('P','A4');
		      $pdf::SetMargins(10,5);
		      $pdf::SetFont('courier','B','12');
		      $pdf::SetTitle("Kartu Pemilih");
		      $pdf::SetTextColor(0,0,0);
		      $y = $pdf::getY()-15;
		      $x = 20;
		      $newPage = false;
		      if (count($pemilih) > 0) 
		      {
		      	$pdf::Cell(0,12,'Daftar Kartu Pemilih Kelas '.$kelas->nama_kelas,0,0,'C');
		      	$pdf::ln();
		      	$y = $pdf::getY() - 15;
		        foreach ($pemilih as $i => $p) 
		        {
		          if ($newPage) 
		          {
		            $pdf::AddPage('P','A4');
		            $y = $pdf::getY()-10;
		          }
		          if ( ($i+1)%2 == 0) 
		          {
		            $x = 112;
		            $y -= 34.5;
		          } 
		          else 
		          {
		            $x = 20;
		            $y +=15;
		          }
		          $pdf::SetFont('courier','B','12');
		          $pdf::SetXY($x,$y);
		          $pdf::Image( url('cic.png'),($x+2),($y+2.4),8,7.2,'png'); // logo sekolah
		          $pdf::Cell(12,12,"",'LTBR');
		          $pdf::Cell(68,12,"KARTU LOGIN PEMILIH",'TBR',0,'C');
		          $y+=12;
		          $pdf::setXY($x,$y);
		          $pdf::SetFont('courier','','10');
		          $pdf::Cell(80,3,'','LRT');
		          $y+=3;
		          $pdf::setXY($x,$y);
		          $pdf::Cell(25,7,"Nama Pemilih ",'L');
		          $pdf::Cell(55,7,": ".$p->nama,'R');
		          $y+=5.5;
		          $pdf::setXY($x,$y);
		          $pdf::Cell(25,7,"Username",'L');
		          $pdf::Cell(55,7,": ".$p->username,'R');
		          $y+=5.5;
		          $pdf::setXY($x,$y);
		          $pdf::Cell(25,7,"Password",'L');
		          $tanggal_password = date('dmY',strtotime($p->tanggal_lahir));
		          $pdf::Cell(55,7,": ".$tanggal_password,'R');
		          $y+=5.5;
		          $pdf::setXY($x,$y);
		          $pdf::Cell(80,3,'','LRB');
		          $y+=3;
		          $pdf::setXY($x,$y);
		          $pdf::Cell(80,7,strtoupper('Universitas CIC CIREBON'),1,0,'C');
		          $newPage = (($i+1)%10 == 0)?true:false;
		        }
		      }
		      else 
		      {
		        $pdf::SetTextColor(223,80,0);
		        $pdf::Cell(0,10,"Tidak Pemilih!",1);
		      }
		      $pdf::Output(0);
		      exit;
		  }
	}
?>	