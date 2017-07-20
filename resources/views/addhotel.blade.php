@extends('layout')

@section('title')
	Register Your Company
@stop

@section('addhotel')
	@if(session('type') == 'superadmin')
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="panel panel-default" style="text-align: center">
				<div class="panel-heading">
					ADD HOTEL AND HOTEL ACCOUNT
				</div>
				<div class="panel-body">
			  		 <form class="form-horizontal" method="post" action="/addhotel" data-toggle="validator">
			  		 {{ csrf_field() }}
			  		 	<div class="{{ session('addalert') }}">
			  		 		{{ session('addalertmessage') }}
			  		 	</div>
						<div class="form-group">
						    <label class="control-label col-sm-2" for="name">Hotel Name:</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control input-lg" id="name" placeholder="Enter hotel name" name="name" required>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-2" for="username">Username:</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control input-lg" id="username" placeholder="Enter Username" name="username" required>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-2" for="password">Password:</label>
						    <div class="col-sm-10">
						      <input type="password" class="form-control input-lg" id="password" placeholder="Enter Password" name="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" required>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-2" for="password">Re-Enter Password:</label>
						    <div class="col-sm-10">
						      <input type="password" class="form-control input-lg" id="password2" placeholder="Re-enter Password" data-match="#password" required>
						    </div>
						</div>
						 
						<div class="form-group">
						    <div class="col-sm-offset-2 col-sm-10">
						      <button type="submit" class="w3-btn w3-teal form-control btnLogin btn-lg">Save</button>
						    </div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
	@else
		Error
	@endif
@stop