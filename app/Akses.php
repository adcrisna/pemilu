<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akses extends Model
{
    protected $table='akses';
	public $timestamps=false;
     protected $fillable = ['id', 'portal_login','nama_wakepsek','nip_wakepsek','nama_kepsek','nip_kepsek','nama_ketua_pemilu','nis_ketua_pemilu'];
}
?>