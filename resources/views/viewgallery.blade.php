@extends('layout')

@section('title')
	Hotel Rooms
@stop

@section('viewgallery')
	<br>
	<div class="row">
		@foreach($rooms as $room)
		<div class="col-sm-4 text-center">
			<a href="#"	data-toggle="modal" data-target="#viewroommodal" onclick="loadroomphoto('{{ $room->photo }}')"><center><img src="/uploads/{{ $room->photo }}" class="img-responsive" style="height: 300px"></center></a>
			<p class="alert alert-success">{{ $room->type }}<br>
			<font class="text-center" style="color: black">P {{ $room->price }}.00</font>
			</p>
		</div>
		@endforeach
	</div>
	<div id="viewroommodal" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"></h4>
	      </div>
	      <div class="modal-body">
	        <img class="img-responsive" id="roomphoto">
	      </div>
	    </div>
	  </div>
	</div>
@stop