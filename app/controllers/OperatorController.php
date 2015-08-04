<?php 

	Route::get('/profile', 'OperatorController@getProfile');
	Route::get('/profile/edit', 'OperatorController@getEditProfile');
	Route::get('/user/show', 'OperatorController@getUserShow');
	Route::get('/user/show/{id}', 'OperatorController@getUserShowById');

class OperatorController extends BaseController {

	public function getProfile(){
		return View::make('dashboard.operator.profile')->withUser(Sentry::getUser());
	}

	public function getEditProfile(){
		return View::make('dashboard.operator.editprofile')->withUser(Sentry::getUser());
	}

	public function postEditProfile()
	{
		$input = array(
			'first_name'	=> Input::get('first_name'),
			'last_name'		=> Input::get('last_name'),
			'email'			=> Input::get('email')
		);

		$rules = array(
			'first_name'	=> 'required',
			'last_name'		=> 'required',
			'email'			=> 'required|email'
		);

		$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			return Redirect::back()->withErrors($validation)->withInput();
		} else {

			$id = Input::get('id');

			$user = User::findOrFail($id);

			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->save();

			return Redirect::to('profile')->with("successMessage", "Anda telah berhasil mengupdate profile Anda");

		}
	}

	public function getUserShow()
	{
		
	}

	public function getUserShowById($id){
		
	}

}