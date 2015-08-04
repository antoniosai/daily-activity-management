<?php

class Coba extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Datatable::shouldHandle()) {
		$operator = Sentry::findAllUsersWithAccess('operator');
		$operatorCollection = new Illuminate\Database\Eloquent\Collection($operator);

		return Datatable::collection($operatorCollection)
				->addColumn('full_name', function($model){
					return $model->first_name . ' ' . $model->last_name;
				})
				->showColumns('id', 'email', 'last_login')
				->searchColumns('full_name','email','last_login')
				->orderColumns('full_name','email','last_login')
				->make();
		}

		return View::make('dashboard.admin.manageuser');
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
