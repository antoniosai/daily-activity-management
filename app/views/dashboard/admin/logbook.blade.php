@extends('dashboard.admin.layout')
@section('header')
<h1 class="page-header">
	Logbook
</h1>

<ol class="breadcrumb">
	<li>
		<i class="fa fa-dashboard"></i><a href="{{ action('AdminController@getIndex') }}"> Dashboard</a>
	</li>
	<li>
		<i class="fa fa-tasks"></i><a href="{{ action('AdminController@getProfile') }}"> Logbook</a>
	</li>
</ol>
@stop

@section('content')
<table class="table table-bordered table-hover">
	<thead>
		<th>Time</th>
		<th>Title</th>
		<th>Description</th>
		<th>Status</th>
		<th>Operator</th>
	</thead>
	@foreach ($data as $datas)
		<tbody>
			<td>{{ $datas->time }}</td>
			<td>{{ $datas->title }}</td>
			<td>{{ $datas->description }}</td>
			<td>{{ $datas->priorities }}</td>
			<td>{{ $datas->first_name }}</td>
		</tbody>
	@endforeach
</table>
<hr/>
<h3>Add New Event</h3>
<form action="{{ action('LogbookController@postSave') }}" method="POST">
	<div class="form-group">
	<label>Title</label>
	<input class="form-control" type="text" name="title" placeholder="Insert the Title">
</div>
<div class="form-group">
	<label>Description</label>
	<textarea name="description" class="form-control" placeholder="Write a Description"></textarea>
</div>
<div class="form-group">
	<label>Priority</label><br/>
	@foreach ($status as $stats)
	<label class="radio-inline">
	<input type="radio" name="priority" value="{{ $stats->id }}">{{ $stats->description }}</label>
	@endforeach
</div>
<input type="submit" class="btn btn-success" value="Tambah Data">
</form>
@stop