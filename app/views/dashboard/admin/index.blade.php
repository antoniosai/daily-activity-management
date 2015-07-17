@extends('dashboard.admin.layout')
@section('header')
<h1 class="page-header">Dashboard</h1>
<ol class="breadcrumb">
	<li>
		<i class="fa fa-dashboard"></i><a href="{{ action('AdminController@getIndex') }}"> Dashboard</a>
	</li>
</ol>
@stop

@section('content')
<div class="row">

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-user fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{{ $user }}</div>
						<div>Users Are Waiting For Your Approval</div>
					</div>
				</div>
			</div>
			<a href="{{ action('AdminController@getManageUser') }}">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-tasks fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">12</div>
						<div>New Tasks!</div>
					</div>
				</div>
			</div>
			<a href="#">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-shopping-cart fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">124</div>
						<div>New Orders!</div>
					</div>
				</div>
			</div>
			<a href="#">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-support fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">13</div>
						<div>Support Tickets!</div>
					</div>
				</div>
			</div>
			<a href="#">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

</div>





    <div id="myModal" class="modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">Confirmation</h4>

                </div>

                <div class="modal-body">

                    <p>Do you want to save changes you made to document before closing?</p>

                    <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-primary">Save changes</button>

                </div>

            </div>

        </div>

    </div>



    <!-- Button HTML (to Trigger Modal) -->

    <a href="#myModal" role="button" class="btn btn-large btn-primary" data-toggle="modal">Launch Demo Modal</a>

     

    <!-- Modal HTML -->

    <div id="myModal" class="modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">Confirmation</h4>

                </div>

                <div class="modal-body">

                    <p>Do you want to save changes you made to document before closing?</p>

                    <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-primary">Save changes</button>

                </div>

            </div>

        </div>

    </div>



    <script type="text/javascript">

    $(document).ready(function(){

        $(".btn").click(function(){

            $("#myModal").modal('show');

        });

    });

    </script>





@stop