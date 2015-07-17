<?php 

class AdminController extends BaseController {	

	public function getIndex(){
		$user = User::where('activated', 0)->count();
		return View::make('dashboard.admin.index')->with('user', $user);
	}

	public function getProfile(){
		return View::make('dashboard.admin.profile');
	}

	public function getManageUser(){
		$user = DB::table('users')->where('activated', '=', 1)->get();
		$user_nonaktif = User::where('activated', '=', 0)->get();

		return View::make('dashboard.admin.manageuser')
		->with('user', $user)
		->with('user_nonaktif', $user_nonaktif);
	}

	public function getEditUser($id){

	}

	public function postEditUser(){

	}

	public function getDeleteUser($id){

	}

	public function getDeactivateUser($id){
		$user = User::find($id);

		$user->activated = 0;
		$user->save();

		$user_email = Sentry::getUser()->email;
		return Redirect::to('admin/manage/user')->with('successMessage', "User dengan email $user_email telah berhasil deaktivasi");
	}

	public function getActivateUser($id){
		$user = User::find($id);

		$user->activated = 1;
		$user->save();
		$user_email = Sentry::getUser()->email;
		return Redirect::to('admin/manage/user')->with('successMessage', "User dengan email $user_email telah berhasil diaktivasi");
	}

	public function getAddNewUser(){
		return View::make('dashboard.admin.adduser');
	}

	public function postAddNewUser(){
		try{
			$user = Sentry::register(array(
				'first_name'    => Input::get('first_name'),
				'last_name' => Input::get('last_name'),
				'email'    => Input::get('email'),
				'password' => Input::get('password'),
			), true);

			$operatorGroup = Sentry::findGroupByName('operator');
			$user->addGroup($operatorGroup);

		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e){
			echo 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e){
			echo 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e){
			echo 'User with this login already exists.';
		}

		return Redirect::to('admin/manage/user'); 
	}
}