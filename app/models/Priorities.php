<?php 

class Priorities extends Eloquent {

	protected $table = 'priorities';

	public function logbook()
	{
		return $this->belongsTo('Logbook');
	}
}