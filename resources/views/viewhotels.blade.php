@extends('layout')

@section('title')
	Hotels
@stop

@section('viewhotels')
@if(session('type') == 'superadmin')
<table class="table">
	<thead>
      	<tr style="color: white">
	        <th>Hotel Name</th>
	        <th>Hotel Admin's Username</th>
          <th>Hotel Admin's Password</th>
	        <th>Is Archived</th>
	        <th>Actions</th>
      	</tr>
    </thead>
    <tbody>
    	@foreach($hotels as $hotel)
    	<tr class="success">
	        <td>{{ $hotel->name }}</td>
	        <td>{{ $hotel->username }}</td>
          <td>{{ $hotel->password }}</td>
	        <td>
            @if($hotel->trashed())
              Yes
            @else
              No
            @endif 
          </td>
	        <td>
          @if($hotel->trashed())
          <a href="/viewhotels/restore/{{ $hotel->id }}">Restore</a>
          @else
          <a href="/viewhotels/edit/{{ $hotel->id }}">Edit</a> || <a href="#" data-toggle="modal" data-target="#deleteModal" onclick="setHotelToDelete('{{ $hotel->id }}')">Archive</a>
          @endif
          </td>
    	</tr>
    	@endforeach
    </tbody>
</table>

<div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirmation</h4>
      </div>
      <div class="modal-body">
        <p>Archive this hotel?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deleteHotel()">Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>

  </div>
</div>
@else
	Error
@endif
@stop