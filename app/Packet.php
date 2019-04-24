<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
	protected $table = 'packet';
    protected $guarded = [];

	public function soal(){
	    return $this->belongsTo('App\Soal', 'soal_id');
	}
}
