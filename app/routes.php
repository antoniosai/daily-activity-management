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

//Admin Area GET
Route::get('/admin', 'AdminController@getIndex');
Route::get('/admin/profile', 'AdminController@getProfile');
Route::get('/admin/manage/user', 'AdminController@getManageUser');
Route::get('/admin/profile/edit/{id}', 'AdminController@postEditProfile');
Route::get('/admin/manage/user/delete/{id}', 'AdminController@getDeleteUser');
Route::get('/admin/manage/user/deactivate/{id}', 'AdminController@getDeactivateUser');
Route::get('/admin/manage/user/activate/{id}', 'AdminController@getActivateUser');
Route::get('/admin/manage/user/adduser', 'AdminController@getAddNewUser');

//Admin Area POST
Route::post('/admin/profile/edit', 'AdminController@postEditUser');
Route::post('/admin/manage/user/adduser', 'AdminController@postAddNewUser');
//Route::post('');

//Test
Route::get('/test', function(){
	$operator = Sentry::register(array(
				'email'			=> 'supriono.igi@gmail.com',
				'password'		=> 'su19711126',
				'first_name'	=> 'Supriono',
				'last_name'		=> 'IGI',
			));
			
			$operatorGroup = Sentry::findGroupByName('operator');
			$operator->addGroup($operatorGroup);
});

