@extends('dashboard.admin.layout')
@section('header')
<h1 class="page-header">
	About
</h1>

<ol class="breadcrumb">
	<li>
		<i class="fa fa-tickets"></i><a href="{{ action('AdminController@getIndex') }}"> About</a>
	</li>
</ol>
@stop

@section('content')
<p>Aplikasi ini dibuat untuk membantu pekerjaan sehari pada IT Department.</p>
@stop