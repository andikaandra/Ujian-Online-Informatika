<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TcExamPacket extends Model
{
	protected $table = 'tcexam_packet';
    protected $guarded = [];

	public function soal(){
	    return $this->belongsTo('App\TcExamSoal', 'soal_id');
	}
}
