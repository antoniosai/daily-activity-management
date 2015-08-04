<?php 

class AdminController extends BaseController {	

	public function getDataUser(){

		$operator = Sentry::findAllUsersWithAccess('operator');
		$operatorCollection = new Illuminate\Database\Eloquent\Collection($operator);

		return Datatable::collection($operatorCollection)
				->addColumn('id', function($model){
					return $model->id;
				})
				->addColumn('full_name', function($model){
					return $model->first_name . ' ' . $model->last_name;
				})
				->addColumn('email', function($model){
					return $model->email;
				})
				->addColumn('last_login', function($model){
					return ($model->last_login ? $model->last_login->toDateTimeString() : '');
				})
				->addColumn('activated_at', function($model){
					return ($model->activated_at ? $model->activated_at->toDateTimeString() : '');
				})
				->addColumn('', function($model){
					if ($model->activated == 1) {
						return '<a href="'.URL::route('user.deactivate', $model->id).'" class="button">Disable</a></td>';
					}
					if ($model->activated == 0){
						return '<a href="'.URL::route('user.activate', $model->id).'" class="button success">Activate</a></td>';
					}
				})
				->searchColumns('full_name','email','last_login')
				->orderColumns('id', 'full_name','email','last_login')
				->make();

		return View::make('dashboard.admin.manageuser');
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

	public function getProfile(){
		return View::make('dashboard.admin.profile');
	}

	public function getManageUser(){

		$operator = Sentry::findAllUsersWithAccess('operator');
		$operatorCollection = new Illuminate\Database\Eloquent\Collection($operator);

		$data = Datatable::collection($operatorCollection)
				->addColumn('full_name', function($model){
					return $model->first_name . ' ' . $model->last_name;
				})
				->showColumns('id', 'email', 'last_login')
				->searchColumns('full_name','email','last_login')
				->orderColumns('full_name','email','last_login')
				->make();

		$group = Group::all();

		return View::make('dashboard.admin.manageuser')->with('group', $group);
	}

	public function getEditUser($id){
		$user = User::findOrFail($id);

		return View::make('dashboard.admin.editprofile')->with('user', $user);
	}

	public function postEditUser(){

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

			return Redirect::to('admin/manage/user')->with("successMessage", "User telah berhasil diupdate");

		}
	}

	public function getDeleteUser($id){
		$user = User::find($id);
		$user_email = $user->email;
		$user->delete($id);
		return Redirect::to('manage/user')->with("successMessage", "User dengan email <b>$user_email</b> telah berhasil dihapus");
	}

	public function getDeactivateUser($id){
		$user = User::find($id);

		$user->activated = 0;
		$user->save();

		$user_email = $user->email;
		return Redirect::back()->with("successMessage", "User dengan email <b>$user_email</b> telah berhasil deaktivasi");
	}

	public function getActivateUser($id){
		$user = User::find($id);

		$user->activated = 1;
		$user->save();
		$user_email = $user->email;
		return Redirect::back()->with("successMessage", "User dengan email <b>$user_email</b> telah berhasil diaktivasi");
	}

	public function getAddNewUser(){
		$group = Group::all();
		return View::make('dashboard.admin.adduser')->with('group', $group);
	}

	public function postAddNewUser(){

		$group = Input::get('group');

		try{
			$user = Sentry::register(array(
				'first_name'    => Input::get('first_name'),
				'last_name' 	=> Input::get('last_name'),
				'email'    		=> Input::get('email'),
				'password' 		=> Input::get('password'),
			), true);


			switch ($group) {
				case 1:{
					$administratorGroup = Sentry::findGroupByName('administrator');
					$user->addGroup($administratorGroup);
				}
				break;

				case 2:{
					$operatorGroup = Sentry::findGroupByName('operator');
					$user->addGroup($operatorGroup);
				}
				break;
			}
		} catch (Cartalyst\Sentry\Users\LoginRequiredException $e){
			echo 'Login field is required.';
		} catch (Cartalyst\Sentry\Users\PasswordRequiredException $e){
			echo 'Password field is required.';
		} catch (Cartalyst\Sentry\Users\UserExistsException $e){
			echo 'User with this login already exists.';
		}

		return Redirect::to('admin/manage/user')->with('successMessage', 'User baru telah berhasil dibuat'); 
	}

	public function postSearchLogbook(){
		$user = User::findOrFail($id);

		return View::make('dashboard.admin.showprofile')->with('user', $user);
	}

	public function getShowProfile($id){
		$user = User::findOrFail($id);

		return View::make('dashboard.admin.showprofile')->with('user', $user);
	}
}