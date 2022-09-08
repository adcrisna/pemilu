<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemilih extends Model
{
	protected $table='pemilih';
	public $timestamps=false;
     protected $fillable = [
        'nis', 'nama', 'jenis_kelmin','tanggal_lahir','tempat_lahir','id_kelas','jurusan'
    ];
}
?>