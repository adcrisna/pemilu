<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info_calon extends Model
{	
	protected $table='info_calon';
	public $timestamps=false;
     protected $fillable = [
        'id_calon', 'nama_calon','nama_Wakil','visi','misi','deskripsi_calon','foto_calon'
    ];
}
?>