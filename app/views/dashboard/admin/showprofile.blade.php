@extends('dashboard.admin.layout')
@section('header')
<h1 class="page-header">
	{{ $user->first_name }}'s Profile
</h1>

<ol class="breadcrumb">
	<li>
		<i class="fa fa-dashboard"></i><a href="{{ action('AdminController@getIndex') }}"> Dashboard</a>
	</li>
	<li>
		<i class="fa fa-user"></i><a href="{{ action('AdminController@getProfile') }}"> Profile</a>
	</li>
	<li>
		<i class="fa fa-user"></i><a href="#"> User Profile</a>
	</li>
</ol>
@stop

@section('content')
<div class="row">
	<div class="col-md-8">
		<table class="table">
			<tr>
				<th>#ID User</th>
				<td>: </td>
				<td>{{ $user->id }}</td>
			</tr>
			<tr>
				<th>Status</th>
				<td>:</td>
				@if ($user->activated == 0)
					<td>Belum diaktivasi <a href="{{ URL::route('user.activate', $user->id) }}" class="btn btn-success btn-xs">Klik sini untuk mengaktifkan</a></td>
				@else
					<td>Sudah diaktivasi   <a href="{{ URL::route('user.deactivate', $user->id) }}" class="btn btn-default btn-xs">Klik sini untuk menonaktifkan</a></td>
				@endif
				
			</tr>
			<tr>
				<th>Nama Depan</th>
				<td>: </td>
				<td>{{ $user->first_name }}</td>
			</tr>
			<tr>
				<th>Nama Belakang</th>
				<td>: </td>
				<td>{{ $user->last_name }}</td>
			</tr>
			<tr>
				<th>Email Anda</th>
				<td>:</td>
				<td>{{ $user->email }}</td>
			</tr>
			<tr>
				<th>Active Since</th>
				<td>:</td>
				<td>{{ $user->activated_at }}</td>
			</tr>
			<tr>
				<th>Last Login</th>
				<td>:</td>
				<td>{{ $user->last_login }}</td>
			</tr>
		</table>
	</div>
	<div class="col-md-4">
		<img src="{{ asset('images/gambar.jpg') }}" style="width: 200px" class="img img-circle">
		<h5>Your Profile Picture</h5>
	</div>
</div>
<a href="" class="btn btn-success" style="margin-right: 20px">Edit Profile</a> or <a href="" class="btn btn-info" style="margin-left: 20px">Change Password</a>
<br/>
<br/>
@stop