<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Home
//Route::get('/', 'TestController@index');

//User Area Get Action
Route::get('/register', 'UserController@getRegister');
Route::get('/login', 'UserController@getLogin');
Route::get('/logout', 'UserController@getLogout');

//User Area Post Action
Route::post('/register', 'UserController@postRegister');
Route::post('/login', 'UserController@postLogin');

Route::group(['prefix' => 'admin','before'=>'auth'],function()
{

	//Admin Area GET
	Route::get('/', 'AdminController@getIndex');
	Route::get('/profile', 'AdminController@getProfile');
	Route::get('/manage/user', 'AdminController@getManageUser');
	Route::get('/profile/edit/{id}', 'AdminController@postEditProfile');
	Route::get('/manage/user/delete/{id}', 'AdminController@getDeleteUser');
	Route::get('/manage/user/deactivate/{id}', 'AdminController@getDeactivateUser');
	Route::get('/manage/user/activate/{id}', 'AdminController@getActivateUser');
	Route::get('/manage/user/adduser', 'AdminController@getAddNewUser');

	//Admin Area POST
	Route::post('/profile/edit', 'AdminController@postEditUser');
	Route::post('/manage/user/adduser', 'AdminController@postAddNewUser');
	//Route::post('');

	//Logbook Area
	Route::get('/logbook', 'LogbookController@getShowLogbook');
	Route::post('/logbook/save', 'LogbookController@postSave');
});
//About Page
Route::get('/about', function(){
	return View::make('dashboard.about');
});
//Test
Route::get('/test', function(){
	
	$credentials = array(
		'email'		=>	'admin@mail.com',
		'password'	=>	'admin'
	);

	$data = Sentry::authenticate($credentials, false);

	$user = User::find(Sentry::getUser()->id);

	$logbook = new Logbook;

	$logbook->user_id		=	Sentry::getUser()->id;
	$logbook->title 		=	"First Title";
	$logbook->description 	=	"First Description";
	$logbook->lbstats_id	=	2;
	$logbook->priorities_id	=	3;
	$user->logbook()->save($logbook);

});

Route::get('/test2', function(){
	$user = User::has('logbook')->get();

	return $user;
});


