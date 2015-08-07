@extends('dashboard.admin.layout')

@section('title') Logbook @stop
@section('style')
<script>
	function showDialog(id){
		var dialog = $("#"+id).data('dialog');
		if (!dialog.element.data('opened')) {
			dialog.open();
		} else {
			dialog.close();
		}
	}
</script>

<script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@stop
@section('content')

<h1 class="text-light">Logbook <span class="mif-list2 place-right"></span></h1>
<hr class="thin bg-grayLighter">
<button class="button primary" onclick="showDialog('addLogbook')"><span class="mif-plus"></span> Tambah Kejadian</button>
<button class="button success" onclick="showDialog('exportToPdf')"><span class="mif-file-pdf"></span> Export To PDF</button>
<button class="button" onclick="showDialog('advancedSearch')"><span class="mif-search"></span> Pencarian Terperinci</button>
<hr class="thin bg-grayLighter">

@if ($errors->has())
<div class="alert alert-danger">
	<div class="fg-white bg-red padding10">
		<p style="margin-left: 28px"><span class="mif-warning"></span><strong> Terdapat error pada ketika menambahkan event pada logbook: </strong></p>
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
		<button style="margin-left: 28px" class="button" onclick="showDialog('dialog')"> Click here to Try Again</button>
	</div> 
</div>
<hr class="thin bg-grayLighter">
@endif
<h3>Showing Logbooks on Today {{ date('d-M-Y') }}</h3>
{{ Datatable::table()
	->addColumn('Time','Name', 'Deskripsi', 'Status', 'Operator')
	->setUrl(route('api.logbooks'))
	->setOptions('aaSorting', array(
		  array(1, 'desc')
		))
	->setClass('dataTables border bordered')
	->render() 
}}

<br/><br/><br/>
<hr class="thin bg-grayLighter">

<div data-role="dialog" id="addLogbook" class="padding20 cell auto-size " data-close-button="true" data-overlay="true" data-overlay-color="op-dark">
	<h3>Add New Event</h3>
	<hr class="thin bg-grayLighter">
	<form action="{{ action('LogbookController@postSave') }}" method="POST" >
		<div class="input-control text full-size">
			<input type="text" name="title" placeholder="Insert the Title">
		</div>
		<div class="input-control text full-size">
			<textarea name="description" placeholder="Write a Description" id="lb"></textarea>
			<script>
                CKEDITOR.replace( 'lb' );
            </script>

		</div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		<label><b>Priority</b></label><br/><br/>
		@foreach ($status as $stats)
		<label class="radio-inline full-size">
			<input type="radio" name="priority" value="{{ $stats->id }}"> {{ $stats->description }}</label>
		@endforeach
		<br/><br/>
		<div class="place-right"><button class="button success">Add</button></div>
	</form>
</div>

<div data-role="dialog" id="exportToPdf" class="padding20 cell auto-size " data-close-button="true" data-overlay="true" data-overlay-color="op-dark">
	<h3>Export To PDF</h3>
	<hr class="thin bg-grayLighter">
	<form action="{{ action('ExportController@exportToPdf') }}" method="POST" >
		<br/>
		<div class="input-control text full-size" data-role="datepicker">
			<label>From</label>
			<input type="text" name="fromDate" placeholder="Masukan Tanggal">
			<button class="button"><span class="mif-calendar"></span></button>
		</div><br/><br/>

		<div class="input-control text full-size" data-role="datepicker">
			<label>To</label>
			<input type="text" name="toDate" placeholder="Masukan Tanggal">
			<button class="button"><span class="mif-calendar"></span></button>
		</div><br/><br/>

		<div class="input-control select full-size">
		   	<label>Status</label>
		    <select name="sid">
		        <option value="all">-- Semua Status --</option>
		    	@foreach ($status as $stats)
		       	<option value="{{ $stats->id }}">{{ $stats->description }}</option>
		    	@endforeach
		    </select>
		</div><br/><br/>

		<div class="input-control select full-size">
		    <label>Operator</label>
		    <select name="oid">
		       	<option value="all">-- Semua Operator --</option>
		    	@foreach ($user as $operator)
		        <option value="{{ $operator->id }}">{{ $operator->first_name }}</option>
		        @endforeach
		    </select>
		</div><br/><br/>

		<div class="place-right">
			<button class="button primary">Export</button>
		</div>
	</form>
</div>

<div data-role="dialog" id="advancedSearch" class="padding20 cell auto-size " data-close-button="true" data-overlay="true" data-overlay-color="op-dark">
	<h3>Pencarian Terperinci</h3>
	<hr class="thin bg-grayLighter">
	<form action="{{ action('LogbookController@getDatatableFromSearch') }}" method="POST" >
		<br/>
		<div class="input-control text full-size" data-role="datepicker">
			<label>Dari</label>
			<input type="text" name="fromDate">
			<button class="button"><span class="mif-calendar"></span></button>
		</div><br/><br/>

		<div class="input-control text full-size" data-role="datepicker">
			<label>Ke</label>
			<input type="text" name="toDate">
			<button class="button"><span class="mif-calendar"></span></button>
		</div><br/><br/>

		<div class="input-control select full-size">
	    	<label>Status</label>
		    <select>
		       	<option value="all" name="sid">-- Semua Status --</option>
		    	@foreach ($status as $stats)
		            <option value="{{ $stats->id }}" name="sid">{{ $stats->description }}</option>
		        @endforeach
		    </select>
		</div><br/><br/>

		<div class="input-control select full-size">
		    <label>Operator</label>
		    <select>
		    	<option value="all" name="oid">-- Semua Operator --</option>
		    	@foreach ($user as $operator)
		         <option value="{{ $operator->id }}" name="oid">{{ $operator->first_name }}</option>
		        @endforeach
		    </select>
		</div><br/><br/>

		<div class="place-right">
			<button class="button success">Cari Logbook</button>
		</div>
	</form>
</div>

@stop