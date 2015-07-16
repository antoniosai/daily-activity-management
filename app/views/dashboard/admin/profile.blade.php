@extends('dashboard.admin.layout')
@section('header')
<h1 class="page-header">
	Profile
</h1>

<ol class="breadcrumb">
	<li>
		<i class="fa fa-dashboard"></i><a href="{{ action('AdminController@getIndex') }}"> Dashboard</a>
	</li>
	<li>
		<i class="fa fa-user"></i><a href="{{ action('AdminController@getProfile') }}"> Profile</a>
	</li>
</ol>
@stop

@section('content')
<?php $error = Session::get('errorMessage'); ?>
@if($error)
<p class="bg-danger">{{ $error }}</p>
@endif
<?php $success = Session::get('successMessage'); ?>
@if($error)
<p class="bg-success">{{ $success }}</p>
@endif
<div class="row">
	<div class="col-md-8">
		<table class="table">
			<tr>
				<th>Nama Depan</th>
				<td>: </td>
				<td>{{ Sentry::getUser()->first_name }}</td>
			</tr>
			<tr>
				<th>Nama Belakang</th>
				<td>: </td>
				<td>{{ Sentry::getUser()->last_name }}</td>
			</tr>
			<tr>
				<th>Email Anda</th>
				<td>:</td>
				<td>{{ Sentry::getUser()->email }}</td>
			</tr>
			<tr>
				<th>Active Since</th>
				<td>:</td>
				<td>{{ Sentry::getUser()->activated_at }}</td>
			</tr>
			<tr>
				<th>Last Login</th>
				<td>:</td>
				<td>{{ Sentry::getUser()->last_login }}</td>
			</tr>
		</table>
	</div>
	<div class="col-md-4">
		<img src="{{ asset('images/gambar.jpg') }}" style="width: 200px" class="img img-circle">
		<h5>Your Profile Picture</h5>
	</div>
</div>
<p class="bg-info">Ask your Administrator to Change your Information and Password</p>
<br/>
<br/>
@stop