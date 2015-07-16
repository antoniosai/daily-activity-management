<?php

class User extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	protected $fillable = array('first_name', 'last_name', 'email');

	public function logbook(){
		return $this->hasMany('Logbook');
	}

	public function report(){
		return $this->hasMany('Report');
	}
}
