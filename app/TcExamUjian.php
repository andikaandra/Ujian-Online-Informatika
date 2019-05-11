<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TcExamUjian extends Model
{
	protected $table = 'tcexam_ujian';
    protected $guarded = [];

	public function peserta(){
	    return $this->hasMany('App\TcExamPesertaUjian', 'ujian_id', 'id');
	}

	public function soals(){
	    return $this->hasMany('App\TcExamSoal', 'ujian_id', 'id');
	}

	public function dosen(){
	    return $this->belongsTo('App\User', 'id_dosen', 'idUser');
	}
}
