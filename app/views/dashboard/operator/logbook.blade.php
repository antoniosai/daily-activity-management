@extends('dashboard.operator.layout')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/media/css/jquery.dataTables.css') }}">
    <script type="text/javascript" src="{{ asset('assets/media/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/media/js/jquery.dataTables.min.js') }}"></script>
@stop

@section('header')
<h1 class="page-header">
	Logbook
</h1>

<ol class="breadcrumb">
	<li>
		<i class="fa fa-dashboard"></i><a href="{{ action('AdminController@getIndex') }}"> Dashboard</a>
	</li>
	<li>
		<i class="fa fa-tasks"></i><a href="{{ action('LogbookController@getShowLogbook') }}"> Logbook</a>
	</li>
</ol>
@stop

@section('content')
		
<?php $success = Session::get('successMessage'); ?>
@if($success)
    <div class="alert alert-success" style="text-align: center">{{ $success }}</div>
@endif
{{ $data->links() }}
<table class="table table-bordered table-hover">
	<thead style="">
		<th style="width:18%;text-align: center">Time</th>
		<th style="width:25%;text-align: center">Title</th>
		<th style="text-align: center">Description</th>
		<th style="width:12%;text-align: center">Status</th>
		<th style="width:15%;text-align: center">Operator</th>
	</thead>
	@foreach ($data as $datas)
	{{-- Blok PHP untuk Menkonversi hari --}}
	<?php 
		$unix = strtotime($datas->time);
		$hari = date("D", $unix); 
		$hari = str_replace('Sun', 'Minggu', $hari);
		$hari = str_replace('Mon', 'Senin', $hari);
		$hari = str_replace('Tue', 'Selasa', $hari);
		$hari = str_replace('Wed', 'Rabu', $hari);
		$hari = str_replace('Thu', 'Kamis', $hari);
		$hari = str_replace('Fri', 'Jum\'at', $hari);
		$hari = str_replace('Sat', 'Sabtu', $hari);
	?>
		@if ($datas->priorities_id == 3)
		<tbody>
			<td style="text-align:center">{{ $hari,"<br/>", date('d M Y H:i', strtotime($datas->time)) }}</td>
			<td>{{ $datas->title }}</td>
			<td>{{ $datas->deskripsi }}</td>
			<td class="danger" style="text-align:center">{{ $datas->priorities }}</td>
			<td style="text-align:center">{{ link_to_action('AdminController@getShowProfile', $datas->first_name. ' ' . $datas->last_name, array($datas->id)) }}</td>
		</tbody>
		@elseif ($datas->priorities_id == 2)
		<tbody>
			<td style="text-align:center">{{ $hari }},<br/> {{ date('d M Y H:i', strtotime($datas->time)) }}</td>
			<td>{{ $datas->title }}</td>
			<td>{{ $datas->deskripsi }}</td>
			<td class="warning" style="text-align:center">{{ $datas->priorities }}</td>
			<td style="text-align:center">{{ link_to_action('AdminController@getShowProfile', $datas->first_name. ' ' . $datas->last_name, array($datas->id)) }}</td>
		</tbody>
		</tbody>
		@elseif ($datas->priorities_id == 1)
		<tbody>
			<td style="text-align:center">{{ $hari }},<br/> {{ date('d M Y H:i', strtotime($datas->time)) }}</td>
			<td>{{ $datas->title }}</td>
			<td>{{ $datas->deskripsi }}</td>
			<td class="success" style="text-align:center">{{ $datas->priorities }}</td>
			<td style="text-align:center">{{ link_to_action('AdminController@getShowProfile', $datas->first_name. ' ' . $datas->last_name, array($datas->id)) }}</td>
		</tbody>
		</tbody>
		@endif
	@endforeach
</table>
{{ $data->links() }}

<hr/>
<h2>Add New Event</h2>
<br/>
@if ($errors->has())
    <div class="alert alert-danger">
        <p>Terdapat error pada: </p><br/>
         @foreach ($errors->all() as $error)
            <i class="fa fa-remove"></i> {{ $error }}<br/>   
        @endforeach
    </div>
@endif
<form action="{{ action('LogbookController@postSave') }}" method="POST" id="add">
	<div class="form-group @if ($errors->has('title')) has-error @endif">
		<label>Title</label>
		<input class="form-control" type="text" name="title" placeholder="Insert the Title">
	</div>
	<div class="form-group @if($errors->has('description')) has-error @endif">
		<label>Description</label>
		<textarea name="description" class="form-control" placeholder="Write a Description"></textarea>
	</div>
	<div class="form-group @if ($errors->has('priority')) has-error @endif">
		<label>Priority</label><br/>
		@foreach ($status as $stats)
		<label class="radio-inline">
		<input type="radio" name="priority" value="{{ $stats->id }}">{{ $stats->description }}</label>
		@endforeach
	</div>
<input type="submit" class="btn btn-success" value="Add Event">
</form>

<hr/>
<h2>Pencarian Detail</h2>
<br/>
<h4>Pencarian Berdasarkan Rentan Waktu</h4>
<form>
<div id="custom-search-input">
    <div class="input-group">
        <form action="{{ action('LogbookController@getSearchLogbook') }}" method="get">
            <div class="form-group @if ($errors->has('priority')) has-error @endif">
                <input type="text" name="input" class="form-control input-sm" placeholder="Cari ..." />
	                <span class="input-group-btn">
	                    <button class="btn btn-info btn-sm">
	                    	<i class="glyphicon glyphicon-search"></i>
	                        Cari
	                    </button>
	                </span>
            </div>
        </form>
    </div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-6">
				<label>Dari</label>
			</div>

			<div class="col-md-6">
				<label>Ke</label>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-12">
				<label>Oleh Operator</label>
			</div>
		</div>
	</div>
</div>
</form>
@stop