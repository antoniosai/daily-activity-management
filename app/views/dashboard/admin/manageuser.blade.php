@extends('dashboard.admin.layout')
@section('header')
<h1 class="page-header">
	User Management
</h1>

<ol class="breadcrumb">
	<li>
		<i class="fa fa-dashboard"></i><a href="{{ action('AdminController@getIndex') }}"> Dashboard</a>
	</li>
	<li>
		<i class="fa fa-user"></i><a href="#"> Managemen User</a>
	</li>
</ol>
@stop

@section('content')

<?php $error = Session::get('errorMessage'); ?>
@if($error)
<div class="alert alert-danger" style="text-align: center">{{ $error }}</div>
@endif
<?php $success = Session::get('successMessage'); ?>
@if($error)
<div class="alert alert-success" style="text-align: center">{{ $success }}</div>
@endif
<a href="{{ action('AdminController@getAddNewUser') }}" class="btn btn-success">Add New User</a>

<hr/>
<h4>Active User</h4>
<table class="table table-hover table-bordered">
	<thead>
		<th>#ID</th>
		<th>Email</th>
		<th>Full Name</th>
		<th>Last Login</th>
		<th>Option for User</th>
	</thead>
	@foreach ($user as $users)
	@if ($users->id != 11)
	<tr>
		<td>{{ $users->id }}</td>
		<td>{{ link_to_action('AdminController@getShowProfile', $users->email, array($users->id)) }}</td>
		<td>{{ $users->first_name . ' ' . $users->last_name }}</td>
		<td>{{ $users->last_login }}</td>
		<td style="padding-left: 5px">
			<a href="{{ URL::route('user.deactivate', $users->id) }}" class="btn btn-warning btn-xs">Edit</a> 
			<a href="{{ URL::route('user.delete', $users->id) }}" class="btn btn-danger btn-xs">Delete</a> 
			<a href="{{ URL::route('user.deactivate', $users->id) }}" class="btn btn-default btn-xs">Deactivate</a></td>
		</td>
	</tr>
	@endif
	@endforeach
</table>

<hr/>

@if (!$user_nonaktif->count() == 0)
<h4>User(s) that waiting for Approval</h4>
<table class="table table-hover table-bordered">
	<thead>
		<th>#ID</th>
		<th>Email</th>
		<th>Full Name</th>
		<th>Request Time</th>
		<th>Option</th>
	</thead>
	@foreach ($user_nonaktif as $user)
	<tr>
		<td>{{ $user->id }}</td>
		<td>{{ link_to_action('AdminController@getShowProfile', $user->email, array($user->id)) }}</td>
		<td>{{ $user->first_name . ' ' . $users->last_name }}</td>
		<td>{{ $user->created_at }}</td>
		<td><a href="{{ URL::route('user.deactivate', $users->id) }}" class="btn btn-warning btn-xs">Edit</a> 
			<a href="{{ URL::route('user.delete', $users->id) }}" class="btn btn-danger btn-xs">Delete</a> <a href="{{ URL::route('user.activate', $user->id) }}" class="btn btn-success btn-xs">Activate</a></td>

		</tr>
		@endforeach
	</table>
	@else
	<h4>You have no user to Approve</h4>
	@endif

	@stop