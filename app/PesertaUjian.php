<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesertaUjian extends Model
{
	protected $table = 'peserta_ujian';
    protected $guarded = [];

	public function user(){
	    return $this->belongsTo('App\User');
	}
}
