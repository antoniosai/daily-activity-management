<?php

class PercobaanController extends \BaseController {

	public function getDatatable()
	{

		$query = User::select('first_name', 'last_login', 'id')->get();

		return Datatable::collection($query)
		->addColumn('last_login', function($model){
			return date('M j, Y h:i A', strtotime($model->last_login));
		})
		->addColumn('id', function($model){
			return '<a href="/users/' . $model->id . '">view</a>';
		})
		->searchColumns('name', 'last_login')
		->orderColumns('name', 'last_login')
		->make();

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	$table = Datatable::table()
      ->addColumn('first_name', 'last_login', 'id')
      ->setOptions('aoColumnDefs', array(
      	array(
      		'bVisible' => 'Name',
      		'aTargets' => [0]
      	),
      	array(
      		'bVisible' => false,
      		'aTargets' => [1]
      	),
      	array(
      		'bVisible' => false,
      		'aTargets' => [2]
      	),
      ))
      ->setUrl(route('api.users'))
      ->noScript();

    	return View::make('percobaan', array('table' => $table));

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
