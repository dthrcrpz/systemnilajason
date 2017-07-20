@extends('layout')

@section('title')
	Edit My Hotel
@stop

@section('editmyhotel')
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="panel panel-success" style="text-align: center">
				<div class="panel-heading">
					EDIT MY HOTEL
				</div>
				<div class="panel-body">
			  		 <form class="form-horizontal" method="post" action="/edithotel" enctype="multipart/form-data" data-toggle="validator">
			  		 {{ csrf_field() }}
			  		 {{ method_field('patch') }}
						<div class="form-group">
						    <label class="control-label col-sm-2" for="name">Hotel Name:</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control input-lg" id="name" placeholder="Enter hotel name" value="{{ $hotel->name }}" pattern="[A-Za-z0-9 '-]+" disabled>
						    </div>
						    <input type="hidden" name="name" value="{{ $hotel->name }}">
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-2" for="address">Hotel Address:</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control input-lg" id="address" placeholder="Enter hotel address" name="address" value="{{ $hotel->address }}" required>
						    </div>
						</div>

						<div class="form-group">
						    <label class="control-label col-sm-2" for="url">Location:</label>
						    <div class="col-sm-4">
						      <input type="text" class="form-control input-lg" id="price_range" placeholder="Latitude" name="latitude" value="{{ $hotel->latitude }}" pattern="[0-9 .]+" required>
						    </div>
						    <div class="col-sm-4">
						      <input type="text" class="form-control input-lg" id="price_range" placeholder="Longitude" name="longitude" value="{{ $hotel->longitude }}" pattern="[0-9 .]+" required>
						    </div>
						</div>

						<div class="form-group">
						    <label class="control-label col-sm-2" for="url">Hotel URL:</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control input-lg" id="url" placeholder="www.yourwebsite.com (DO NOT ADD http://)" name="url" value="{{ $hotel->url }}">
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-2" for="url">Contact Number:</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control input-lg" id="number" placeholder="09991234567" name="contactnumber" value="{{ $hotel->contactnumber }}">
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-2" for="url">Price Range:</label>
						    <div class="col-sm-3">
						      <input type="text" class="form-control input-lg" id="price_range" placeholder="Starting Price" name="pricefrom" value="{{ $hotel->pricefrom }}" pattern="[0-9 .]+" required>
						    </div>
						    <div class="col-sm-1">
						    <h4>to</h4>
						    </div>
						    <div class="col-sm-3">
						      <input type="text" class="form-control input-lg" id="price_range" placeholder="Ending Price" name="priceto" value="{{ $hotel->priceto }}" pattern="[0-9 .]+" required>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-2" for="summary">Hotel Summary:</label>
						    <div class="col-sm-10">
						      <textarea type="text" class="form-control input-lg" id="summary" placeholder="Enter hotel summary" name="summary" rows="4" required>{{ $hotel->summary }}</textarea>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-2" for="username">Username:</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control input-lg" id="username" placeholder="Enter Username" name="username" value="{{ $hotel->username }}" required>
						    </div>
						</div>
						<div class="form-group">
						    <label class="control-label col-sm-2" for="password">Password:</label>
						    <div class="col-sm-10">
						      <input type="password" class="form-control input-lg" id="password" placeholder="Enter Password" name="password" value="{{ $hotel->password }}" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" required>
						    </div>
						</div>

						<div class="form-group">
						    <label class="control-label col-sm-2" for="password2">Password:</label>
						    <div class="col-sm-10">
						      <input type="password" class="form-control input-lg" id="password2" data-match="#password" placeholder="Re-enter Password" required>
						    </div>
						</div>

						<!-- set map -->

						<div class="form-group">
						    <label class="control-label col-sm-2" for="photo">Photo:</label>
						    <div class="col-sm-10">
						      <input type="file" class="btn btn-lg file" id="photo" name="photo">
						    </div>
						</div>

						<div class="form-group">
						    <div class="col-sm-offset-2 col-sm-10">
						      <button type="submit" class="btn btn-success form-control btnLogin btn-lg">Update</button>
						    </div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
@stop