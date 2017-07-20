@extends('layout')

@section('title')
	My Rooms
@stop

@section('myrooms')
	<form class="form-inline" id="upload" method="post" action="/managerooms" enctype="multipart/form-data">
		{{ csrf_field() }}
	<div class="row">
		<div class="form-group col-sm-12">
		    <input type="file" class="form-control btn-sm file" id="photo1" name="photos1" style="border: none" required>
		    Room Type
		     <select name="type" class="form-control" style="width: 300px" required>
                        <option>Standard Room</option>
                        <option>Deluxe Room</option>
                        <option>Double Suite</option>
                        <option>Family Suite</option>
                        <option>Premiere Suite</option>
                        <option>Superior Room</option>
                        <option>Superior Quadraple</option>
                        <option>Signature Suite</option>
                        <option>Event Room</option>
             </select>
            <input type="text" pattern="[0-9]+" class="form-control" name="price" placeholder="Price">
            <select name="hotelid" class="form-control" style="width: 300px" required>
                  @foreach($hotels as $hotel)
                  	<option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                  @endforeach
             </select>
		    <button type="submit" class="w3-btn w3-teal">Upload</button>
		</div>
	</div>
	</form>
	<br>
	<div class="row">
		@foreach($rooms as $room)
		<div class="col-sm-3 text-center" style="border: 1px solid white; padding: 3px 3px 3px 3px">
			<center><img src="/uploads/{{ $room->photo }}" class="img-responsive" style="height: 300px"></center>
			<p class="text-center" style="margin-top: 5px; background-color: white"><strong>{{ $room->type }}</strong> on {{ $room->hotel->name }}<br><span class="">P {{ $room->price }}</span></p>
			<a class="w3-btn w3-teal" href="#" onclick="deleteroom({{$room->id}})">Delete</a>
		</div>
		@endforeach
	</div>
@stop