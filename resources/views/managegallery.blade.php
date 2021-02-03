@extends('layout')

@section('title')
	My Gallery
@stop

@section('mygallery')
	<form class="form-inline" id="upload" method="post" action="/managegallery" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="form-group">
		    <label for="photos">Add Photos:</label>
		    <input type="file" class="form-control btn-sm file" id="photos" name="photos[]" style="border: none" multiple required>
		    <select name="hotelid" class="form-control" style="width: 300px" required>
                @foreach($hotels as $hotel)
                  	<option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                @endforeach
            </select>
		</div>
		  <button type="submit" class="btn btn-default btn-lg">Submit</button>
		  <div id="message"></div>
	</form>
	<br>
	<div class="row">
		@foreach($photos as $photo)
		<div class="col-sm-3 text-center">
			<img src="/uploads/{{ $photo->location }}" width="300" height="300">
			<a class="btn btn-default" href="/gallery/delete/{{ $photo->id }}">Delete</a>
		</div>
		@endforeach
	</div>
@stop