<?php 

use Nicolaslopezj\Searchable\SearchableTrait;

class Logbook extends Eloquent {

use SearchableTrait;

	protected $searchable = [

        'columns' => [
            'logbooks.created_at' =>10,
            'logbooks.title' => 10,
            'logbooks.deskripsi' => 10,
            'priorities.description' => 2,
            'users.first_name' => 5,
            'users.last_name' => 2,
        ],

        'joins' => [
            'users'      => ['users.id','logbooks.user_id'],
            'priorities' => ['priorities.id', 'logbooks.priorities_id'],
        ],

    ];

	public function user(){
		return $this->belongsTo('User');
	}

	public function priorities(){
		return $this->hasOne('Priorities');
	}
}