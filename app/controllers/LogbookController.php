<?php 

class LogbookController extends BaseController {	

	public function getShowLogbook(){

		// $data = DB::select(
		// 		DB::raw('SELECT b.id, a.created_at AS time, a.title, a.description , a.priorities_id, c.description AS priorities, b.first_name, b.last_name
		// 				 FROM logbooks a, users b, priorities c
		// 				 WHERE a.user_id = b.id AND a.priorities_id = c.id
		// 				 ORDER BY time DESC'));

		$data = DB::table('logbooks')
		->join('priorities', 'logbooks.priorities_id', '=', 'priorities.id')
		->join('users', 'logbooks.user_id', '=', 'users.id')
		->select('users.id', 'logbooks.created_at as time', 'logbooks.title','logbooks.deskripsi','logbooks.priorities_id','priorities.description as priorities','users.first_name')
		->orderBy('time', 'desc')
		//->whereBetween('logbooks.created_at', array('2015-07-14 10:00:00', '2015-07-18 10:00:00'))
		->paginate(10);

		$status = Priorities::all();;

		return View::make('dashboard.admin.logbook')->with('data', $data)
		->with('status', $status);

		// return count($data);
	}

	public function postSave(){

		$logbook 				= new Logbook;
			$logbook->user_id 		= Sentry::getUser()->id;
			$logbook->title 		= Input::get('title');
			$logbook->deskripsi		= Input::get('description');
			$logbook->priorities_id	= Input::get('priority');
			$logbook->save();

			return Redirect::to('admin/logbook')->with('successMessage', "New Event was Added to Logbook's Record");

		// $input = array(
		// 	'title'			=> Input::get('title'),
		// 	'description'	=> Input::get('description'),
		// 	'prioritiy'		=> Input::get('priority')
		// );

		// $rules = array(
		// 	'title'			=> 'required',
		// 	'description'	=> 'required',
		// 	'priority'		=> 'min:6'
		// );

		// $validation = Validator::make($input, $rules);

		// if ($validation->fails()) {
		// 	return Redirect::back()->withErrors($validation)->withInput();
		// } else {
		// 	$logbook 				= new Logbook;
		// 	$logbook->user_id 		= Sentry::getUser()->id;
		// 	$logbook->title 		= Input::get('title');
		// 	$logbook->description	= Input::get('description');
		// 	$logbook->priorities_id	= Input::get('priority');
		// 	$logbook->save();

		// 	return Redirect::to('admin/logbook')->with('successMessage', "New Event was Added to Logbook's Record");
		// }
	}

	public function getSearchLogbook(){

		$data = array(
			'input'			=> Input::get('input')
		);

		$rules = array(
			'input'			=> 'required',
		);

		$message = array(
			'input.message'	=> 'Anda harus masukan pencarian yang benar'
		);

		$validation = Validator::make($data, $rules, $message);

		if ($validation->fails()) {
			return Redirect::back()->withErrors($validation)->withInput();
		} else {

			$searchTerms = explode(' ', Input::get('input'));

			$query = DB::table('logbooks')
			->join('priorities', 'logbooks.priorities_id', '=', 'priorities.id')
			->join('users', 'logbooks.user_id', '=', 'users.id')
			->select('users.id', 'logbooks.created_at as time', 'logbooks.title','logbooks.deskripsi','logbooks.priorities_id','priorities.description as priorities','users.first_name')
			->orderBy('time', 'desc');

			foreach ($searchTerms as $term) {
				$query->where('logbooks.created_at', 'LIKE', '%'. $term . '%')
					  ->orWhere('logbooks.title', 'LIKE', '%'. $term . '%')
					  ->orWhere('logbooks.deskripsi', 'LIKE', '%'. $term . '%')
					  ->orWhere('priorities.description', 'LIKE', '%'. $term . '%')
					  ->orWhere('users.first_name', 'LIKE', '%'. $term . '%')
					  ->orWhere('users.last_name', 'LIKE', '%'. $term . '%');
			}

			$logbook = $query->paginate(5);

			return View::make('dashboard.admin.logbooksearch')->with('logbook', $logbook);

		}
	}

	public function getSerchResult(){
		
	}

}