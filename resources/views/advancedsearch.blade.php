@extends('layout')

@section('title')
    Hotel Cataloging System
@stop

@section('index')
	<form method="get" action="/search">
        <div class="input-group" style="width: 700px; margin: auto;">
            <input type="text" class="form-control input-lg" placeholder="Search by name, address" name="q">
            <div class="input-group-btn">
                <button class="w3-btn w3-teal input-lg" type="submit" style="margin-left: -4px; width: 100px">
                    Search
                </button>
            </div>
        </div>
    </form>

    <div class="container">
        @if(count($rooms) == 0)
            <h5 style="color: white; margin-left: 283px">No results found</h5>
        @else
            <h5 style="color: white; margin-left: 283px">{{ count($rooms) }} hotel(s)</h5>
        @endif
        <div class="form-group" id="sortings" style="margin-left: 1px">
            <select class="form-control" id="sel1" onclick="sort()">
                <option value="name">Sort by Name</option>
                <option value="address">Sort by Address</option>
                <option value="price">Sort by Price Range</option>
                <option value="rating">Sort by Rating</option>
            </select>
        </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="panel panel-default hotelsna" id="filterPanel">
            <form method="get" action="/advancedsearch">
                <h4><b>Search by Room</b></h4>
                <p>Price:</p>
                    <div class="form-group">
                        <select name="pricefrom" class="form-control" style="width: 40%">
                            <option value="1000">1000</option>
                            <option value="3000">3000</option>
                            <option value="5000">5000</option>
                            <option value="8000">8000</option>
                            <option value="10000">10000</option>
                        </select>
                        <select name="priceto" class="form-control pull-right" style="width: 40%; margin-top: -34px; margin-right: 10px">
                            <option value="3000">3000</option>
                            <option value="5000">5000</option>
                            <option value="8000">8000</option>
                            <option value="10000">10000</option>
                            <option value="99999">Above</option>
                        </select>
                        <h5 class="pull-right" style="margin-top: -27px; margin-right: 120px">TO</h5>
                    </div>
                <hr class="dividers">
                <pp>Type of Rooms:</p>
                    <select name="roomtype" class="form-control" style="width: 90%">
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
                <hr class="dividers">
                <button class="w3-teal w3-btn" type="submit">Search</button>
                <hr>
            </form>
            </div>
        </div>
        <div class="col-sm-9" style="margin-left: -10px">
            @if($rooms)
                @foreach($rooms as $room)
                <div class="panel panel-default hotelsna">
                    <div class="panel-body">
                        <img class="img img-responsive pull-left hotelImages" width="150" height="1" src="/uploads/{{ $room->photo }}"/>
                        <h4 class="hotelName"><strong>{{ $room->hotel->name }}</strong></h4>
                        <h5 class="hotelAddress">Type: {{ $room->type }}</h5>
                        <h5 class="hotelAddress">Price: {{ $room->price }}</h5>
                        
                        <a class="w3-btn w3-teal" style="float: right;" href="#" onclick="initMap('{{$room->hotel->latitude}}', '{{$room->hotel->longitude}}')" data-toggle="modal" data-target="#mapModal">View Map</a>
                        @if($room->hotel->url == NULL)
                            <button class="w3-btn w3-teal" style="float: right; margin-right: 5px" disabled>Website not available yet</button>
                        @else
                            <a class="w3-btn w3-teal" href="http://{{ $room->hotel->url }}" style="float: right; margin-right: 5px">View Website</a>
                        @endif
                    </div>
                </div>
            @endforeach
            @else
                @foreach($hotels as $hotel)
                    <div class="panel panel-default hotelsna">
                        <div class="panel-body">
                            <img class="img img-responsive pull-left hotelImages" width="150" height="1" src="/uploads/{{ $hotel->photo }}"/>
                            <h4 class="hotelName">{{ $hotel->name }}</h4>
                            <h5 class="hotelAddress">{{ $hotel->address }}</h5>
                            <h5 class="hotelSummary">{{ $hotel->summary }}</h5>
                            <h5 class="hotelPrice">{{ $hotel->price_range }}</h5>
                            @if(count($ro->where('hotel_id', $hotel->id)->get()) == 0)

                            @else
                                <h5 class="hotelRT">Room Types Available</h5>
                                <ul class="hotelRTs">
                                @foreach($ro->where('hotel_id', $hotel->id)->get() as $ros)
                                    <li><h6>{{ $ros->type }}</h6></li>
                                @endforeach
                                </ul>
                            @endif
                            <a class="w3-btn w3-teal" style="float: right;" href="/{{ $hotel->id }}/rooms">View Rooms</a>
                            <a class="w3-btn w3-teal" style="float: right; margin-top: -36px; margin-right: -110px" href="#" onclick="showmap('{{$hotel->map}}', '{{$hotel->name}}')" data-toggle="modal" data-target="#mapModal">View Map</a>
                            @if($hotel->url == NULL)
                                <button class="w3-btn w3-teal" style="float: right; margin-right: 5px" disabled>Website not available yet</button>
                            @else
                                <a class="w3-btn w3-teal" href="http://{{ $hotel->url }}" style="float: right; margin-right: 5px">View Website</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<script>
      function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('hotelmap'), {
          zoom: 10,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiQk8VXh5nJs0I_O-zC5kmyJaiMvQ7apk&callback=initMap">
    </script>
<div id="mapModal" class="modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
      <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px; margin-right: -15px">&times;</button>
        <!-- <img id="mapImage" class="img-responsive" src="sortbyaddress"> -->
        <div id="hotelmap" style="height: 500px;
        width: 100%;"></div>
      </div>
    </div>
  </div>
</div>
@stop