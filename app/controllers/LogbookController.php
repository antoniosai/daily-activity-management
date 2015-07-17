<?php 

class LogbookController extends BaseController {	

	public function getShowLogbook(){

		$data = DB::select(
				DB::raw('SELECT a.created_at AS time, a.title, a.description , c.description AS priorities, b.first_name, b.last_name
						 FROM logbooks a, users b, priorities c
						 WHERE a.user_id = b.id AND a.priorities_id = c.id
						 ORDER BY time DESC'));

		$status = Priorities::all();

		//$data = DB::table('logbooks')->get();

		return View::make('dashboard.admin.logbook')->with('data', $data)
													->with('status', $status);
	}

	public function postSave(){
		$logbook 				= new Logbook;
		$logbook->user_id 		= Sentry::getUser()->id;
		$logbook->title 		= Input::get('title');
		$logbook->description	= Input::get('description');
		$logbook->priorities_id	= Input::get('priority');
		$logbook->save();

		return Redirect::to('admin/logbook')->with('successMessage', "New Event was Added to Logbook's Record");
	}

}