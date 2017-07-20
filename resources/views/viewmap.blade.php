@extends('layout')

@section('title')
	Hotel Rooms
@stop

@section('viewmap')
	<br>
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-10 text-center">
			<img src="/uploads/{{ $hotel->photo }}" class="img-thumbnail" style="border: 1px solid white">
		</div>
		<div class="col-sm-1"></div>
	</div>
	<br>
	<br>
@stop