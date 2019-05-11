<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TcExamPesertaUjian extends Model
{
	protected $table = 'tcexam_peserta_ujian';
    protected $guarded = [];

	public function user(){
	    return $this->belongsTo('App\User', 'user_id', 'idUser');
	}

	public function ujians(){
	    return $this->belongsTo('App\TcExamUjian', 'ujian_id', 'id');
	}

	public function packet(){
	    return $this->hasMany('App\TcExamPacket', 'peserta_ujian_id', 'id');
	}
}
