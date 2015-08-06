@extends('export.layout')

@section('content')
<h3>IT Department KSA Logbook Report</h3>
Operator Selected: <strong>{{ $opName }}</strong>
<br/>
Operator Selected: <strong>{{ $sName }}</strong>
<br/>
From: <strong>{{ $fromDate }}</strong> 
To: <strong>{{ $toDate }}</strong>   
<hr/>
Total Event : <strong>{{ $count }}</strong>
<table class="table border bordered">
	<thead>
		<th style="width: 20%">Time</th>
		<th style="width: 22%">Title</th>
		<th>Description</th>
		<th style="width: 10%" style="width: 18%">Priority</th>
		<th style="width: 10%">Operator</th>
	</thead>
	@foreach ($data as $logbook)
	<tbody>
		<td>{{ $logbook->created_at }}</td>
		<td>{{ $logbook->title }}</td>
		<td>{{ $logbook->deskripsi }}</td>
		<td>{{ $logbook->priority }}</td>
		<td>{{ $logbook->first_name }}</td>
	</tbody>
	@endforeach
</table>
@stop