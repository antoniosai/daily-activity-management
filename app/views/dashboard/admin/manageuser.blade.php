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
		@if ($users->id != 4)
		<tr>
			<td>{{ $users->id }}</td>
			<td>{{ $users->email }}</td>
			<td>{{ $users->first_name . ' ' . $users->last_name }}</td>
			<td>{{ $users->last_login }}</td>
			<td style="padding-left: 5px"><a href="" class="btn btn-warning">Edit</a> <a href="" class="btn btn-danger">Delete</a> {{ link_to_action('AdminController@getDeactivateUser', 'Deactivatex', array($users->id)) }}</td>
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
		<td>{{ $user->email }}</td>
		<td>{{ $user->first_name . ' ' . $users->last_name }}</td>
		<td>{{ $user->created_at }}</td>
		<td>{{ link_to_action('AdminController@getActivateUser', 'Activate', array($user->id)) }}</td>
	</tr>
	@endforeach
</table>
@else
<h4>You have no user to Approve</h4>
@endif

@stop