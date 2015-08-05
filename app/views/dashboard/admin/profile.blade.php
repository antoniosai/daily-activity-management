@extends('dashboard.admin.layout')

@section('content')
<h1 class="text-light">Profile <span class="mif-profile place-right"></span></h1>
<hr class="thin bg-grayLighter">
<?php $error = Session::get('errorMessage'); ?>
@if($error)
<p class="bg-danger">{{ $error }}</p>
@endif
<?php $success = Session::get('successMessage'); ?>
@if($error)
<p class="bg-success">{{ $success }}</p>
@endif
<div class="row flex-gird-container">
	<div class="cell colspan8">
		<h3>Your Details <button class="button primary">Edit Profile</button></h3>
		<table class="table striped hovered border">
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
				<th>Aktif Sejak</th>
				<td>:</td>
				<td>{{ Sentry::getUser()->activated_at }}</td>
			</tr>
			<tr>
				<th>Login Terakhir</th>
				<td>:</td>
				<td>{{ Sentry::getUser()->last_login }}</td>
			</tr>
			<tr>
				<th>Update Terakhir</th>
				<td>:</td>
				<td>{{ Sentry::getUser()->updated_at }}</td>
			</tr>
		</table>
	</div>
	<div class="cell colspan4" style="margin-left: 15px">

	</div>
</div>
<hr class="thin bg-grayLighter">
<h3>Your Last Activity</h3>

<div class="tabcontrol2" data-role="tabControl">
	<ul class="tabs">
		<li><a href="#frame_1">Shift Report</a></li>
		<li><a href="#frame_2">Logbook</a></li>
	</ul>
	<div class="frames">
		<div class="frame" id="frame_1">
			{{ Datatable::table()
				->addColumn('Time','Name', 'Deskripsi', 'Status', 'Operator')
				->setUrl(route('api.logbooksbyid'))
				->setClass('dataTables border bordered')
				->render() 
			}}
		</div>
		<div class="frame" id="frame_2">
			Test	
		</div>
	</div>
</div>

<p class="bg-info">Ask your Administrator to Change your Information and Password</p>
<br/>
<br/>
@stop