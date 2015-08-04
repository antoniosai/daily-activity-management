<?php 

class LogbookController extends BaseController {	

	public function getDatatable(){
		$id = Sentry::getUser()->id;
		$query = DB::table('logbooks')
		->join('priorities', 'logbooks.priorities_id', '=', 'priorities.id')
		->join('users', 'logbooks.user_id', '=', 'users.id')
		->select('logbooks.user_id', 'users.id', 'logbooks.created_at', 'logbooks.title','logbooks.deskripsi','logbooks.priorities_id','priorities.description as priorities','users.first_name', 'users.last_name')
		->orderBy('logbooks.created_at', 'asc')->get();

		$data = new Illuminate\Database\Eloquent\Collection($query);

		return Datatable::collection($data)
		->addColumn('created_at', function($model){

			$unix = strtotime($model->created_at);
			$hari = date("D", $unix); 
			$hari = str_replace('Sun', 'Minggu', $hari);
			$hari = str_replace('Mon', 'Senin', $hari);
			$hari = str_replace('Tue', 'Selasa', $hari);
			$hari = str_replace('Wed', 'Rabu', $hari);
			$hari = str_replace('Thu', 'Kamis', $hari);
			$hari = str_replace('Fri', 'Jum\'at', $hari);
			$hari = str_replace('Sat', 'Sabtu', $hari);

			return '<div style="text-align: center;">' . $hari . '<br/>' . date('d M Y H:i', strtotime($model->created_at)) . '</div>';
		})
		->addColumn('title', function($model){
			return $model->title;
		})
		->addColumn('deskripsi', function($model){
			return $model->deskripsi;
		})
		->addColumn('priorities', function($model){
			switch ($model->priorities_id) {
				case 1:
					return '<div style="text-align: center;"><span class="tag success"><h6>'.$model->priorities.'</h6></span></div>';
					break;
				case 2:
					return '<div style="text-align: center;"><span class="tag info"><h6>'.$model->priorities.'</h6></span></div>';
					break;
				case 3:
					return '<div style="text-align: center;"><span class="tag warning"><h6>'.$model->priorities.'</h6></span></div>';
					break;

			}
		})
		->addColumn('deskripsi', function($model){
			return $model->deskripsi;
		})
		->addColumn('operator', function($model){
			return '<div style="text-align: center"><a href="'.URL::route('user.show', $model->id).'"> '.$model->first_name. '<br/>'.$model->last_name.'</a></div>';
			// return '<a href="'.URL::route('user.activate', $model->id).'" class="button success">Activate</a></td>';
		})
		->searchColumns('created_at','title','deskripsi','priorities','operator')
		->make();

	}

	public function getDatatableFromSearch(){

		$fromDate = Input::get('fromDate');
		$toDate = Input::get('toDate');
		$sid = Input::get('sid');
		$oid = Input::get('oid');

		return "Sidnya adalah $fromDate" . ' '. "OID adalah: $toDate" ;

		$query = DB::table('logbooks')
		->join('priorities', 'logbooks.priorities_id', '=', 'priorities.id')
		->join('users', 'logbooks.user_id', '=', 'users.id')
		->select('logbooks.user_id', 'users.id', 'logbooks.created_at', 'logbooks.title','logbooks.deskripsi','logbooks.priorities_id','priorities.description as priorities','users.first_name', 'users.last_name')
		->orderBy('logbooks.created_at', 'asc');
		
		$query->where('logbooks.user_id', '=', $oid );

		$logbook = $query->get();

		$data = new Illuminate\Database\Eloquent\Collection($logbook);

		$result = Datatable::collection($data)
		->addColumn('created_at', function($model){

			$unix = strtotime($model->created_at);
			$hari = date("D", $unix); 
			$hari = str_replace('Sun', 'Minggu', $hari);
			$hari = str_replace('Mon', 'Senin', $hari);
			$hari = str_replace('Tue', 'Selasa', $hari);
			$hari = str_replace('Wed', 'Rabu', $hari);
			$hari = str_replace('Thu', 'Kamis', $hari);
			$hari = str_replace('Fri', 'Jum\'at', $hari);
			$hari = str_replace('Sat', 'Sabtu', $hari);

			return '<div style="text-align: center;">' . $hari . '<br/>' . date('d M Y H:i', strtotime($model->created_at)) . '</div>';
		})
		->addColumn('title', function($model){
			return $model->title;
		})
		->addColumn('deskripsi', function($model){
			return $model->deskripsi;
		})
		->addColumn('priorities', function($model){
			switch ($model->priorities_id) {
				case 1:
					return '<div style="text-align: center;"><span class="tag success"><h6>'.$model->priorities.'</h6></span></div>';
					break;
				case 2:
					return '<div style="text-align: center;"><span class="tag info"><h6>'.$model->priorities.'</h6></span></div>';
					break;
				case 3:
					return '<div style="text-align: center;"><span class="tag warning"><h6>'.$model->priorities.'</h6></span></div>';
					break;

			}
		})
		->addColumn('deskripsi', function($model){
			return $model->deskripsi;
		})
		->addColumn('operator', function($model){
			return '<div style="text-align: center"><a href="'.URL::route('user.show', $model->id).'"> '.$model->first_name. '<br/>'.$model->last_name.'</a></div>';
			// return '<a href="'.URL::route('user.activate', $model->id).'" class="button success">Activate</a></td>';
		})
		->searchColumns('created_at','title','deskripsi','priorities','operator')
		->make();



	}

	public function getDatatableById(){
		$id = Sentry::getUser()->id;

		$query = DB::table('logbooks')
		->join('priorities', 'logbooks.priorities_id', '=', 'priorities.id')
		->join('users', 'logbooks.user_id', '=', 'users.id')
		->where('logbooks.user_id', '=', $id)
		->select('logbooks.user_id', 'users.id', 'logbooks.created_at', 'logbooks.title','logbooks.deskripsi','logbooks.priorities_id','priorities.description as priorities','users.first_name', 'users.last_name')
		->orderBy('created_at', 'desc')->get();

		$data = new Illuminate\Database\Eloquent\Collection($query);

		return Datatable::collection($data)
		->addColumn('created_at', function($model){

			$unix = strtotime($model->created_at);
			$hari = date("D", $unix); 
			$hari = str_replace('Sun', 'Minggu', $hari);
			$hari = str_replace('Mon', 'Senin', $hari);
			$hari = str_replace('Tue', 'Selasa', $hari);
			$hari = str_replace('Wed', 'Rabu', $hari);
			$hari = str_replace('Thu', 'Kamis', $hari);
			$hari = str_replace('Fri', 'Jum\'at', $hari);
			$hari = str_replace('Sat', 'Sabtu', $hari);

			return '<div style="text-align: center;">' . $hari . '<br/>' . date('d M Y H:i', strtotime($model->created_at)) . '</div>';
		})
		->addColumn('title', function($model){
			return $model->title;
		})
		->addColumn('deskripsi', function($model){
			return $model->deskripsi;
		})
		->addColumn('priorities', function($model){
			if ($model->priorities_id == 1) {
				return '<div style="text-align: center;"><span class="tag success"><h6>'.$model->priorities.'</h6></span></div>';
			}
			if ($model->priorities_id == 2) {
				return '<div style="text-align: center;"><span class="tag info"><h6>'.$model->priorities.'</h6></span></div>';
			}
			if ($model->priorities_id == 3) {
				return '<div style="text-align: center;"><span class="tag warning"><h6>'.$model->priorities.'</h6></span></div>';
			}
		})
		->addColumn('deskripsi', function($model){
			return $model->deskripsi;
		})
		->addColumn('operator', function($model){
			return $model->first_name . ' ' . $model->last_name;
		})
		->searchColumns('created_at','title','deskripsi','priorities','operator')
		->orderColumns('created_at','desc')
		->make();

	}

	public function getShowLogbook(){

		$id = Sentry::getUser()->id;

		$data = DB::table('logbooks')
		->join('priorities', 'logbooks.priorities_id', '=', 'priorities.id')
		->join('users', 'logbooks.user_id', '=', 'users.id')
		->select('users.id', 'logbooks.created_at as time', 'logbooks.title','logbooks.deskripsi','logbooks.priorities_id','priorities.description as priorities','users.first_name', 'users.last_name')
		->orderBy('time', 'desc')
		->paginate(15);

		$status = Priorities::all();
		$operator = User::all();

		$user = Sentry::getUser();
		$admin = Sentry::findGroupByName('administrator');

		if($user->inGroup($admin)){
			return View::make('dashboard.admin.logbook')->with('status', $status)
														->with('user', $operator);
		} else {
			return View::make('dashboard.operator.logbook')->with('status', $status)
														   ->with('user', $operator);
		}
	}

	public function getShowLogbookById($id){

		$id = Sentry::getUser()->id;

		$data = DB::table('logbooks')
		->join('priorities', 'logbooks.priorities_id', '=', 'priorities.id')
		->join('users', 'logbooks.user_id', '=', 'users.id')
		->select('users.id', 'logbooks.created_at as time', 'logbooks.title','logbooks.deskripsi','logbooks.priorities_id','priorities.description as priorities','users.first_name', 'users.last_name')
		->orderBy('time', 'desc')
		->paginate(15);

		$status = Priorities::all();

		$user = Sentry::getUser();

		$admin = Sentry::findGroupByName('administrator');

		if($user->inGroup($admin)){
			return View::make('dashboard.admin.logbook')->with('status', $status);
		} else {
			return View::make('dashboard.operator.logbook')->with('status', $status);
		}
	}

	public function postSave(){

		$input = array(
			'title'			=> Input::get('title'),
			'description'	=> Input::get('description'),
			'prioritiy'		=> Input::get('priority')
		);

		$rules = array(
			'title'			=> 'required',
			'description'	=> 'required',
		);

		$messages = array(
			'title.required' => 'Judulnya yang benar',
			'description.required' => 'Deskripsi yang benar',
			'priority.required' => 'Pilih salah satu prioritas'
		);

		$validation = Validator::make($input, $rules, $messages);

		if ($validation->fails()) {
			return Redirect::back()->withErrors($validation)->withInput();
		} else {
			$logbook 				= new Logbook;
			$logbook->user_id 		= Sentry::getUser()->id;
			$logbook->title 		= Input::get('title');
			$logbook->deskripsi		= Input::get('description');
			$logbook->priorities_id	= Input::get('priority');
			$logbook->save();

			return Redirect::back()->with('successMessage', "New Event was Added to Logbook's Record");
		}
	}

	public function getSearchLogbook(){

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
		$logbook->setPath("");

		return View::make('dashboard.admin.logbooksearch')->with('logbook', $logbook);
	}

	public function getSerchResult(){
		$result  = new LogbookController;
		$hasil = $result->getSearchLogbook();

		$user = Sentry::getUser();

		$admin = Sentry::findGroupByName('administrator');

		if($user->inGroup($admin)){
			return View::make('dashboard.admin.logbooksearch')->with('logbook', $hasil);
		} else {
			return View::make('dashboard.operator.logbooksearch')->with('logbook', $hasil);
		}

	}

}