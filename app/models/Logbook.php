<?php 

class Logbook extends Eloquent {

	protected $table = 'logbooks';

	public function user(){
		return $this->belongsTo('User');
	}

	public function priorities(){
		return $this->hasOne('Priorities');
	}
}