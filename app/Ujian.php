<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
	protected $table = 'ujian';
    protected $guarded = [];

	public function peserta(){
	    return $this->hasMany('App\PesertaUjian', 'ujian_id', 'id');
	}

	public function soals(){
	    return $this->hasMany('App\Soal', 'ujian_id', 'id');
	}
}
