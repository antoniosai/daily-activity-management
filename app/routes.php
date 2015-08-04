<?php

Route::resource('coba', 'Coba');

Route::get('/', 'UserController@getLogin');

Route::get('/register', 'UserController@getRegister');
Route::get('/login', 'UserController@getLogin');
Route::get('/logout', 'UserController@getLogout');

//User Area Post Action
Route::post('/register', 'UserController@postRegister');
Route::post('/login', 'UserController@postLogin');

Route::get('/api/logbooks', array('as' => 'api.logbooks', 'uses' => 'LogbookController@getDatatable'));
Route::get('/api/logbooksbyid', array('as' => 'api.logbooksbyid', 'uses' => 'LogbookController@getDatatableById'));

Route::get('/api/users', array('as' => 'api.users', 'uses' => 'AdminController@getDataUser'));

Route::group(['prefix' => '/','before'=>'auth'],function(){

	Route::get('/', 'AdminController@getIndex');

	Route::get('/profile', 'OperatorController@getProfile');
	Route::get('/profile/edit', 'OperatorController@getEditProfile');
	Route::post('/profile/edit', 'OperatorController@postEditProfile');
	Route::get('/user/show', 'OperatorController@getUserShow');
	Route::get('/user/show/{id}', 'OperatorController@getUserShowById');
	
	//Logbook Area
	Route::get('/logbook', 'LogbookController@getShowLogbook');
	Route::post('/logbook/save', 'LogbookController@postSave');
	Route::post('/logbook/search/', 'LogbookController@getDatatableFromSearch');
	
	Route::group(['prefix' => 'admin', 'before' => 'admin'], function(){
			//Admin Area GET
		Route::get('/profile', 'AdminController@getProfile');
		Route::get('/manage/user', array('as' => 'user.api', 'uses' => 'AdminController@getManageUser'));
		Route::get('/profile/edit/{id}', array('as'=>'profile.edit', 'uses'=>'AdminController@postEditProfile'));
		Route::get('/manage/user/delete/{id}', array('as'=>'user.delete', 'uses'=>'AdminController@getDeleteUser'));
		Route::get('/manage/user/edit/{id}', array('as'=>'user.edit', 'uses'=>'AdminController@getEditUser'));
		Route::get('/manage/user/deactivate/{id}', array('as'=>'user.deactivate', 'uses'=>'AdminController@getDeactivateUser'));
		Route::get('/manage/user/activate/{id}', array('as'=>'user.activate', 'uses'=>'AdminController@getActivateUser'));
		Route::get('/manage/user/adduser', 'AdminController@getAddNewUser');
		Route::get('/manage/user/show/{id}', array('as'=>'user.show','uses'=>'AdminController@getShowProfile'));

		//Admin Area POST
		Route::post('/profile/edit', 'AdminController@postEditUser');
		Route::post('/manage/user/adduser', 'AdminController@postAddNewUser');

		//Logbook Area
		Route::get('/logbooks', 'LogbookController@getShowLogbook');
		Route::post('/logbooks/save', 'LogbookController@postSave');
		Route::get('/logbooks/search', 'LogbookController@getSearchLogbook');
		Route::get('/logbooks/search/result', 'LogbookController@getSerchResult');	

	});

});

Route::get('test', function(){
	return View::make('dashboard.operator.index');
});

Route::get('test2', function(){
	return View::make('dashboard.guest.registermessage');
});

Route::get('motor/searchinput/{jenis}/',function($jenis){
return 'Motor dengan jenis : '.$jenis;
});

Route::resource('coba', 'PercobaanController');
