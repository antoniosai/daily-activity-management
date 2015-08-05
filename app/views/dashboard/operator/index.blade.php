@extends('dashboard.operator.layout')
@section('content')
<h1 class="text-light">Dashboard <span class="mif-home place-right"></span></h1>
<hr class="thin bg-grayLighter">
<button class="button primary" onclick="showDialog('addLogbook')"><span class="mif-plus"></span> Tambah Kejadian</button>
<button class="button success" onclick="showDialog('exportToPdf')"><span class="mif-file-pdf"></span> Export To PDF</button>
<button class="button" onclick="showDialog('advancedSearch')"><span class="mif-search"></span> Pencarian Terperinci</button>
<hr class="thin bg-grayLighter">
<?php $error = Session::get('errorMessage'); ?>
@if($error)
<div class="fg-white bg-red padding10" style="text-align: center">{{ $error }}</div>
<hr class="thin bg-grayLighter">
@endif
<?php $success = Session::get('successMessage'); ?>
@if($success)
<div class="fg-white bg-green padding10" style="text-align: center">{{ $success }}</div>
<hr class="thin bg-grayLighter">
@endif

<h4>Aktivitas {{ Sentry::getUser()->first_name}}</h4>
<hr class="thin bg-grayLighter">

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


@stop