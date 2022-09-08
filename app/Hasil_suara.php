<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hasil_suara extends Model
{
	protected $table='hasil_suara';
	public $timestamps=false;
     protected $fillable = [
        'nis', 'id_calon',
    ];
    public static function cek_pemilih($id)
    {
    	return (self::where('nis',$id)->count() > 0);

    }
    public static function list_hasil_suara()
    {
    	return \DB::select('select count(h.id_calon) as hasil_suara, max(i.id_calon) as id_calon,max(nama_calon) as nama_calon,max(nama_wakil) as nama_wakil from info_calon i left join hasil_suara h on(i.id_calon=h.id_calon) group by i.id_calon');
    }
}
?>