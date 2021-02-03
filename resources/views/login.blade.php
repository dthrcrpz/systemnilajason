@extends('layout')

@section('title')
	Login Page
@stop

@section('loginpage')
	<div class="row">
	<br><br>
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="panel panel-info" style="text-align: center">
				<div class="panel-heading">
					AUTHENTICATION
				</div>
				<div class="panel-body">
			  		 <form class="form-horizontal" method="post" action="/login">
			  		 {{ csrf_field() }}
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="username">Username:</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control input-lg" id="username" placeholder="Enter username" name="username">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="pwd">Password:</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control input-lg" id="pwd" placeholder="Enter password" name="password">
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="w3-btn w3-teal form-control btnLogin btn-lg">Login</button>
					    </div>
					  </div>
					  <div class="{{ session('alerttype') }} text-center">
					  	{{ session('alertmessage') }}
					  </div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>
@stop