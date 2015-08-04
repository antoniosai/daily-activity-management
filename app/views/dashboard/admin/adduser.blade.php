@extends('dashboard.admin.layout')

@section('header')
<h1 class="page-header">
	Managemen User
</h1>

<ol class="breadcrumb">
	<li>
		<i class="fa fa-dashboard"></i><a href="{{ action('AdminController@getIndex') }}"> Dashboard</a>
	</li>
	<li>
		<i class="fa fa-user"></i><a href="#"> Managemen User</a>
	</li>
	<li>
		<i class="fa fa-plus"></i><a href="#"> Tambah User</a>
	</li>
</ol>
@stop

@section('content')
<h3>Tambah User</h3>
<hr/>
<div class="row">
	<div class="col-md-6">
		<form action="{{ action('AdminController@postAddNewUser') }}" method="POST">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Nama Awal</label>
						<input type="text" name="first_name" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Nama Akhir</label>
						<input type="text" name="last_name" class="form-control">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="text" name="email" class="form-control">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control">
			</div>
			<div class="form-group">
				<label>Group</label><br/>
				@foreach ($group as $groups)
				<label class="radio-inline"><input type="radio" name="group" value="{{ $groups->id }}">{{ $groups->description }}</label>
				@endforeach
			</div>
			<button type="submit" class="btn btn-success">Simpan</button>
		</form>
	</div>
</div>

@stop