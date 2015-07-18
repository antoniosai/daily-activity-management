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
	<thead style="">
		<th style="width:18%;text-align: center">Time</th>
		<th style="width:25%;text-align: center">Title</th>
		<th style="text-align: center">Description</th>
		<th style="width:12%;text-align: center">Status</th>
		<th style="width:15%;text-align: center">Operator</th>
	</thead>
	@foreach ($logbook as $datas)
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
			<td style="text-align:center">{{ link_to_action('AdminController@getShowProfile', $datas->first_name, array($datas->id)) }}</td>
		</tbody>
		@elseif ($datas->priorities_id == 2)
		<tbody>
			<td style="text-align:center">{{ $hari }},<br/> {{ date('d M Y H:i', strtotime($datas->time)) }}</td>
			<td>{{ $datas->title }}</td>
			<td>{{ $datas->deskripsi }}</td>
			<td class="warning" style="text-align:center">{{ $datas->priorities }}</td>
			<td style="text-align:center">{{ link_to_action('AdminController@getShowProfile', $datas->first_name, array($datas->id)) }}</td>
		</tbody>
		@elseif ($datas->priorities_id == 1)
		<tbody>
			<td style="text-align:center">{{ $hari }},<br/> {{ date('d M Y H:i', strtotime($datas->time)) }}</td>
			<td>{{ $datas->title }}</td>
			<td>{{ $datas->deskripsi }}</td>
			<td class="success" style="text-align:center">{{ $datas->priorities }}</td>
			<td style="text-align:center">{{ link_to_action('AdminController@getShowProfile', $datas->first_name, array($datas->id)) }}</td>
		</tbody>
		@endif
	@endforeach
</table>
{{ $logbook->links() }}
@stop