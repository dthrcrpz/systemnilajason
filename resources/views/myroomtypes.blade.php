@extends('layout')

@section('title')
	My Room Types
@stop

@section('myroomtypes')
<div class="container">
  <h2>Manage Room Types</h2>
  <p>Add or Remove the room types available at your hotel</p>            
  <table class="table">
    <thead>
      <tr>
        <th>Room Type</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($roomtypes as $roomtype)
	    <tr>
	        <td>{{ $roomtype->room_type }}</td>
	        <td>
	        	@if($roomtype->isadded == 'no')
	        		<button class="w3-btn w3-teal" onclick="addroomtype({{ $roomtype->id }})">Add</button>
	        	@else
	        		<button class="w3-btn w3-red" onclick="removeroomtype({{ $roomtype->id }})">Remove</button>
	        	@endif
	        </td>
	    </tr>
    @endforeach
    </tbody>
  </table>
</div>
@stop