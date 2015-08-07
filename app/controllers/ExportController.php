<?php

class ExportController extends \BaseController {

	public function exportToPdf(){


		$data = DB::table('logbooks')
		->join('priorities', 'logbooks.priorities_id', '=', 'priorities.id')
		->join('users', 'logbooks.user_id', '=', 'users.id');
		
		$fromDate = Input::get('fromDate');
		$toDate = Input::get('toDate');
		$sid = Input::get('sid');
		$oid = Input::get('oid');

		if ($oid == 'all') {
			$opName = "Semua Operator";
		} else if ($oid) {
			$user = User::find($oid);
			$opName = $user->first_name . ' ' . $user->last_name;
			$data->where('logbooks.user_id', '=', $oid);
		}

		if ($sid == 'all') {
		 	$sName = "Semua Status";
		 } else if ($sid) {
			$status = Priorities::find($sid);
			$sName = $status->description;
			$data->where('logbooks.priorities_id', '=', $sid);
		}

		$query = $data->select('logbooks.user_id', 'users.id', 'logbooks.created_at', 'logbooks.title','logbooks.deskripsi','logbooks.priorities_id','priorities.description as priority','users.first_name', 'users.last_name')
					  ->whereBetween('logbooks.created_at', array($fromDate, $toDate))
		           	  ->orderBy('logbooks.created_at', 'asc');

		$logbook = [
			'data' => $query->get(),
			'fromDate' => $fromDate,
			'toDate' => $toDate,
			'sName' => $sName,
			'opName' => $opName,
			'count' => $data->count()	
		];

		// $pdf = View::make('export.pdf', $logbook);
		// return $pdf;

		$pdf = PDF::loadView('export.pdf', $logbook);
		return $pdf->stream();
	}
}
