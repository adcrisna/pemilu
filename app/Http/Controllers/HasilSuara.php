<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use App\Http\Requests;
	use Auth;
	use Input;
	use App\Pemilih;
	use App\User;
	use Redirect;
	use App\Hasil_suara;
	use Fpdf;
	use App\Info_calon;
	use App\Akses;
	class HasilSuara extends Controller
	{
		public function tampil_hasil()
		{	
		$data['title']='Hasil Suara';
		$data['hasil_suara'] = Hasil_Suara::list_hasil_suara();
		return view('hasil_suara',$data);
		}
		public function cari_hapus(){
			$nis = Input::get('ceknis');
			$c = Hasil_suara::where('nis',$nis)->first();
			if ($c) {	
				$pesan ='Hasil Suara Dari Nis :'.$nis.' Berhasil Dihapus';
			Hasil_suara::where('nis',$nis)->delete();
			}
		else
		{
			$pesan ='Nis Yang Anda Maksud Tidak Ada';
		}

		\Session::flash('msg_cari',$pesan);
			return Redirect::route('hasil_suara');
		}
		public function reset()
		{
			Hasil_suara::truncate();
				\Session::flash('msg_reset','Semua Hasil Suara Berhasil DiReset!');
			return Redirect::route('hasil_suara');
		}
		public function cetak_berita_acara()
		{
			$pdf = new fPdf('P','mm');
			$pdf::SetAutoPageBreak(true);
			$pdf::SetTitle("Berita Acara Pemilihan");
			$pdf::addPage('P','A4');
			$pdf::image( asset('cic.png'), $pdf::getX()+2, 9, 25 , 20,'PNG');
			$pdf::setX(40);
			$pdf::SetFont('Helvetica','B','13');
			$pdf::cell(160,6,"BERITA ACARA PEMILIHAN UMUM KETUA DAN WAKIL KETUA ",0,2,'C');
			$pdf::SetFont('Helvetica','B','14');
			$pdf::cell(160,6,"Universitas CIC CIREBON",0,2,'C');
			$pdf::SetFont('Helvetica','B','12');
			$pdf::cell(160,6," MASA BAKTI 2020-2021",0,2,'C');
			$pdf::line(10,($pdf::getY()+3),200,($pdf::getY()+3));
			$pdf::ln();
			$pdf::SetFont('Helvetica','B','11');
			$pdf::cell(30,6,'NO URUT',1,0,'C');
			$pdf::cell(80,6,'NAMA PASANGAN CALON',1,0,'C');
			$pdf::cell(40,6,'POSISI CALON',1,0,'C');
			$pdf::cell(40,6,'JUMLAH SUARA',1,1,'C');
			$pdf::SetFont('Helvetica','','11');

			$akses = Akses::first();
			$sudah_memilih =Hasil_Suara::count('nis');
        	$total_pemilih =Pemilih::count('nis');
        	$tidak_memilih =$total_pemilih - $sudah_memilih;
			$calon = Hasil_Suara::list_hasil_suara();
			foreach ($calon as $i => $c) 
			{	
			$pdf::cell(30,12,$i+1,1,0,'C');
			$pdf::cell(80,6,$c->nama_calon,1,0,'C');
			$y = $pdf::getY();
			$x = $pdf::getX();
			$pdf::setXY(40, $y+6);
			$pdf::cell(80,6,$c->nama_wakil,1,0,'C');
			$x = $pdf::getX();
			$pdf::setXY($x, $y);
			$pdf::cell(40,6,'KETUA',1,0,'C');
			$pdf::setXY($x, $y+6);
			$pdf::cell(40,6,'WAKIL',1,0,'C');
			$x = $pdf::getX();
			$pdf::setXY($x, $y);
			$pdf::cell(40,12,$c->hasil_suara,1,1,'C');
			}
			$pdf::SetFont('Helvetica','B','11');
			$pdf::cell(110,6,'JUMLAH PEMILIH/PENGGUNA HAK SUARA',1,0,'C');
			$pdf::cell(40,6,'',1,0,'C');
			$pdf::cell(40,6,$total_pemilih,1,1,'C');
			$pdf::cell(110,6,'JUMLAH YANG MENGGUNAKAN HAK SUARA',1,0,'C');
			$pdf::cell(40,6,'',1,0,'C');
			$pdf::cell(40,6,$sudah_memilih,1,1,'C');
			$pdf::cell(110,6,'JUMLAH YANG TIDAK MENGGUNAKAN HAK SUARA',1,0,'C');
			$pdf::cell(40,6,'',1,0,'C');
			$pdf::cell(40,6,$tidak_memilih,1,1,'C');
			$pdf::ln();
			$pdf::SetFont('Helvetica','B','11');
			$pdf::cell(60,6,'',0,0,'C');
			$pdf::cell(70,6,'',0,0,'C');
			$pdf::cell(60,6,'Cirebon, '.date('d M Y'),0,0,'C');
			$pdf::ln();
			$pdf::ln();
			$pdf::SetFont('Helvetica','B','11');
			$pdf::cell(60,6,'Kemahasiswaan',0,0,'C');
			$pdf::cell(70,6,'',0,0,'C');
			$pdf::cell(60,6,'Ketua Pemilu',0,0,'C');
			$pdf::ln();
			$pdf::ln();
			$pdf::ln();
			$pdf::ln();
			$pdf::ln();
			$pdf::SetFont('Helvetica','B','11');
			$pdf::cell(60,6,$akses->nama_wakepsek,0,0,'C');
			$pdf::cell(70,6,'',0,0,'C');
			$pdf::cell(60,6,$akses->nama_ketua_pemilu,0,0,'C');
			$pdf::ln();
			$pdf::SetFont('Helvetica','B','11');
			$pdf::cell(60,6,'NIP. '.$akses->nip_wakepsek,0,0,'C');
			$pdf::cell(70,6,'',0,0,'C');
			$pdf::cell(60,6,'NIM. '.$akses->nis_ketua_pemilu,0,0,'C');
			$pdf::ln();
			$pdf::SetFont('Helvetica','B','11');
			$pdf::cell(60,6,'',0,0,'C');
			$pdf::cell(70,6,'',0,0,'C');
			$pdf::cell(60,6,'',0,0,'C');
			$pdf::ln();
			$pdf::SetFont('Helvetica','B','11');
			$pdf::cell(60,6,'',0,0,'C');
			$pdf::cell(70,6,'Mengetahui',0,0,'C');
			$pdf::cell(60,6,'',0,0,'C');
			$pdf::ln();
			$pdf::SetFont('Helvetica','B','11');
			$pdf::cell(60,6,'',0,0,'C');
			$pdf::cell(70,6,'Rektor Universitas CIC CIREBON',0,0,'C');
			$pdf::cell(60,6,'',0,0,'C');
			$pdf::ln();
			$pdf::ln();
			$pdf::ln();
			$pdf::ln();
			$pdf::ln();
			$pdf::SetFont('Helvetica','B','11');
			$pdf::cell(60,6,'',0,0,'C');
			$pdf::cell(70,6,$akses->nama_kepsek,0,0,'C');
			$pdf::cell(60,6,'',0,0,'C');
			$pdf::ln();
			$pdf::SetFont('Helvetica','B','11');
			$pdf::cell(60,6,'',0,0,'C');
			$pdf::cell(70,6,'NIP. '.$akses->nip_kepsek,0,0,'C');
			$pdf::cell(60,6,'',0,0,'C');

			$pdf::Output(0);
			exit;
		}
	}
?>