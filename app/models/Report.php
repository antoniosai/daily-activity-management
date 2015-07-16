<?php 

class Report extends Eloquent {

	protected $table = 'logbooks';
	
	public function user()
	{
		return $this->belongsTo('User');
	}

}