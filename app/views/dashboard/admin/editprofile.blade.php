@extends('dashboard.admin.layout')
@section('header')
<h1 class="page-header">
	Profile
</h1>

<ol class="breadcrumb">
	<li>
		<i class="fa fa-dashboard"></i><a href="{{ action('AdminController@getIndex') }}"> Dashboard</a>
	</li>
	<li>
		<i class="fa fa-user"></i><a href="{{ action('AdminController@getProfile') }}"> Profile</a>
	</li>
	<li>
		<i class="fa fa-wrench"></i><a href="#"> Edit Profile</a>
	</li>
</ol>
@stop

@section('content')
<p class="warning">SADasd	</p>
<div class="row">
<form action="{{ action('AdminController@postEditProfile') }}" method="POST" id="formCheckPassword">
<input type="hidden" name="id" value="{{ $user->id }}">
	<div class="col-md-12">
		<table class="table">
			<tr>
				<th>Nama Depan</th>
				<td>:</td>
				<td><input type="text" name="first_name"  value="{{ $user->first_name }}" class="form-control"></td>
			</tr>
			<tr>
				<th>Nama Belakang</th>
				<td>:</td>
				<td><input type="text" name="last_name"  value="{{ $user->last_name }}" class="form-control"></td>
			</tr>
			<tr>
				<th>Email Anda</th>
				<td>:</td>
				<td><input type="text" name="email"  value="{{ $user->email }}" class="form-control"></td>
			</tr>
			<tr>
				<th>Password Baru</th>
				<td>:</td>
				<td><input type="password" name="password" class="form-control" id="password"></td>
			</tr>
			<tr>
				<th>Konfirm Password</th>
				<td>:</td>
				<td><input type="password" name="password" class="form-control" id="cfmPassword"></td>
			</tr>
		</table>
	</div>

</div>


<button type="submit" class="btn btn-success">Simpan</button>
</form>
<br/>
<br/>

<script type="text/javascript">
	 $("#formCheckPassword").validate({
           rules: {
               password: { 
                 required: true,
                    minlength: 6,
                    maxlength: 10,

               } , 

                   cfmPassword: { 
                    equalTo: "#password",
                     minlength: 6,
                     maxlength: 10
               }


           },
     messages:{
         password: { 
                 required:"the password is required"

               }
     }

});
</script>
@stop