<?php

class ExportController extends \BaseController {

	public function exportToPdf(){

		$fromDate = Input::get('fromDate');
		$toDate = Input::get('toDate');
		$sid = Input::get('sid');
		$oid = Input::get('oid');

		$data = DB::table('logbooks')
		->join('priorities', 'logbooks.priorities_id', '=', 'priorities.id')
		->join('users', 'logbooks.user_id', '=', 'users.id')
		->where('logbooks.priorities_id', '=', $sid)
		->where('logbooks.user_id', '=', $oid)
		->select('logbooks.user_id', 'users.id', 'logbooks.created_at', 'logbooks.title','logbooks.deskripsi','logbooks.priorities_id','priorities.description as priority','users.first_name', 'users.last_name')
		->whereBetween('logbooks.created_at', array($fromDate, $toDate))
		->orderBy('logbooks.created_at', 'asc')->get();

		return View::make('export.pdf')->with('data', $data)
									   ->with('fromDate', $fromDate)
									   ->with('toDate', $toDate)
									   ->with('sid', $sid)
									   ->with('oid', $oid);
	}
}
