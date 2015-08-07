@extends('export.layout')

@section('style')
<style type="text/css">
table.table-style-one {
        font-family: verdana,arial,sans-serif;
        font-size:11px;
        color:#333333;
        border-width: 1px;
        border-color: #3A3A3A;
        border-collapse: collapse;
    }
    table.table-style-one th {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #3A3A3A;
        background-color: #B3B3B3;
    }
    table.table-style-one td {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #3A3A3A;
        background-color: #ffffff;
    }
</style>
@stop

@section('content')
<p>
	
<h3>IT Department KSA Logbook Report</h3>
Operator Selected: <strong>{{ $opName }}</strong> | Status Selected: <strong>{{ $sName }}</strong>
<br/>
From: <strong>{{ $fromDate }}</strong> 
To: <strong>{{ $toDate }}</strong> 

</p>  
<hr/>
Total Event : <strong>{{ $count }}</strong>
<table class="table-style-one">
	<tr>
		<th style="width: 20%">Time</th>
		<th style="width: 22%">Title</th>
		<th>Description</th>
		<th style="width: 10%" style="width: 18%">Priority</th>
		<th style="width: 10%">Operator</th>
	</tr>
	@foreach ($data as $logbook)
	<tr>
		<td>{{ $logbook->created_at }}</td>
		<td>{{ $logbook->title }}</td>
		<td>{{ $logbook->deskripsi }}</td>
		<td>{{ $logbook->priority }}</td>
		<td>{{ $logbook->first_name }}</td>
	</tr>
	@endforeach
</table>
@stop