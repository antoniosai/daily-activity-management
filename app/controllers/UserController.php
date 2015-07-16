<?php

class UserController extends BaseController {

	public function __construct() {
        if(Sentry::check()) return Redirect::to('admin');
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
			$user = Sentry::authenticate($credentials, false);
			if ($user) {
				return Redirect::to('admin');
			}
		} catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
			return Redirect::to('login')->with('errorMessage', 'Bad Email or Password');
		} catch (Exception $e) {
			return Redirect::to('login')->with('errorMessage', 'That account was not found in our System');
		}
	}

	public function postRegister(){

		try {
			Sentry::register(array(
				'email'    		=> '1406019@sttgarut.ac.id',
				'password' 		=> '090996o9o9g6!@#',
				'first_name'	=> 'Antonio',
				'last_name'		=> 'Saiful'
			), true);
		} catch (Cartalyst\Sentry\Users\UserExistsException $e) {
			
		}
	}

	public function getLogout(){
		Sentry::logout();
		return Redirect::to('login')->with('successMessage', 'Anda telah berhasil Logout');
	}

}
