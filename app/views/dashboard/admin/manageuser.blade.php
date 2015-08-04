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
@stop
@section('content')
<h1 class="text-light">User Management <span class="mif-users place-right"></span></h1>
<hr class="thin bg-grayLighter">
<button class="button primary" onclick="showDialog('addUser')"><span class="mif-plus"></span> Tambah User Baru</button>
<hr class="thin bg-grayLighter">

<?php $error = Session::get('errorMessage'); ?>
@if($error)
<p class="bg-danger">{{ $error }}</p>
@endif
<?php $success = Session::get('successMessage'); ?>
@if($success)
<p class="bg-success">{{ $success }}</p>
@endif



<h3>User Terdaftar</h3>
{{ Datatable::table()
	->addColumn('#ID', 'Nama', 'Email', 'Login Terakhir', 'Aktif Sejak', 'Opsi')
	->setUrl(route('api.users'))
	->setClass('dataTables border bordered')
	->render() 
}}

<div data-role="dialog" id="addUser" class="padding20 cell" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" style="width: 100px">
	<h3>Tambah User Baru</h3>
	<hr class="thin bg-grayLighter">
	<form action="{{ action('AdminController@postAddNewUser') }}" method="POST" >
		<div class="input-control text full-size">
			<input type="text" name="first_name" placeholder="Masukan Nama Pertama">
		</div><br/>
		<div class="input-control text full-size">
			<input type="text" name="last_name" placeholder="Masukan Nama Akhir">
		</div><br/>
		<div class="input-control text full-size">
			<input type="text" name="email" placeholder="Masukan Alamat Email">
		</div><br/>
		<div class="row">
			<div class="cell colspan6">
				<div class="input-control password full-size" style="padding-right: 15px">
					<input type="password" name="password" placeholder="Masukan Alamat Email">
				</div>
			</div>
			<div class="cell colspan6">
				<div class="input-control password full-size">
					<input type="password" name="password_confirmation" placeholder="Masukan Alamat Email">
				</div>
			</div>
		</div>


		<br/><br/>
		<label><b>Group</b></label><br/><br/>
		@foreach ($group as $grup)
		<label class="radio-inline full-size">
			<input type="radio" name="group" value="{{ $grup->id }}"> {{ $grup->description }}</label>
		@endforeach
		<br/><br/>
		<hr class="thin bg-grayLighter">
		<div class="place-right">
			<button class="button success large-button">Add</button>
		</div>
	</form>
</div>

@stop