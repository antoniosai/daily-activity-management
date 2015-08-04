@extends('dashboard.operator.layout')
@section('header')
<h1 class="page-header">Dashboard Non-Administrator</h1>
<ol class="breadcrumb">
	<li>
		<i class="fa fa-dashboard"></i><a href="{{ action('AdminController@getIndex') }}"> Dashboard</a>
	</li>
</ol>
@stop
@section('content')

<?php $error = Session::get('errorMessage'); ?>
@if($error)
<div class="alert alert-danger" style="text-align: center">{{ $error }}</div>
@endif
<?php $success = Session::get('successMessage'); ?>
@if($success)
<div class="alert alert-success" style="text-align: center">{{ $success }}</div>
@endif



@stop