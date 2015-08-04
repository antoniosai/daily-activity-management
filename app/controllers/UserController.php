<?php

class UserController extends BaseController {

	public function __construct() {
        if(Sentry::check()) return Redirect::to('admin');
    }

    public function getIndex(){
    	$user = Sentry::getUser();
		$admin = Sentry::findGroupByName('administrator');
		$operator = Sentry::findGroupByName('operator');

		if ($user->inGroup($admin)) {
			$activated = User::where('activated', 0)->count();
			return View::make('dashboard.admin.index')->with('user', $activated);
		}

		if ($user->inGroup($operator)) {
			return View::make('dashboard.operator.index');
		}
    }

	public function getLogin(){
		return View::make('dashboard.guest.login');
	}

	public function getRegister(){
		return View::make('dashboard.guest.register');
	}

	public function postLogin(){
		$credentials = array(
				'email'		=> Input::get('email'),
				'password'	=> Input::get('password')
			);
		
		try {
			$login = Sentry::authenticate($credentials, false);
			if ($login) {
				return Redirect::to('/');
			}
		} catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
			return Redirect::to('login')->with('errorMessage', 'Bad Email or Password');
		} catch (Exception $e) {
			return Redirect::to('login')->with('errorMessage', 'That account was not found in our System');
		}
	}

	public function postRegister(){

		$rules = array(
			'first_name'	=> 'required',
			'last_name'		=> 'required',
			'email'			=> 'required|email|unique:users,email,:id',
			'password' 		=> 'required',
			'password_confirmation' 		=> 'required|same:password'
		);

		$validation = Validator::make(Input::all(), $rules);

		if ($validation->fails()) {
			return Redirect::back()->withErrors($validation)->withInput(Input::except('password', 'password_confirm'));
		} else {
			$user = Sentry::register(array(
				'first_name'    => Input::get('first_name'),
				'last_name' 	=> Input::get('last_name'),
				'email'    		=> Input::get('email'),
				'password' 		=> Input::get('password'),
			), false);

			$operatorGroup = Sentry::findGroupByName('operator');
			$user->addGroup($operatorGroup);

			return View::make('dashboard.guest.registermessage');
		}
	}

	public function getLogout(){
		Sentry::logout();
		return Redirect::to('login')->with('successMessage', 'Anda telah berhasil Logout');
	}

}
