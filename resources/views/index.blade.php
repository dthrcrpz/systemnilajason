@extends('layout')

@section('title')
    Hotel Cataloging System
@stop

@section('index')
	<form method="get" action="/search">
        <div class="input-group" style="width: 700px; margin: auto;">
            <input type="text" class="form-control input-lg" placeholder="Search by name, address, or price range" name="q">
            <div class="input-group-btn">
                <button class="w3-btn w3-teal input-lg" type="submit" style="margin-left: -4px; width: 120px">
                    <span class="glyphicon glyphicon-search"></span> Search
                </button>
            </div>
        </div>
    </form>

    <div class="container">
        @if(count($hotels) == 0)
            <h5 style="color: white; margin-left: 283px">No results found</h5>
        @else
            <h5 style="color: white; margin-left: 283px;">{{ count($hotels) }} hotel(s)</h5>
        @endif
        <div class="form-group" id="sortings" style="margin-left: 1px">
            <select class="form-control" id="sel1" onchange="sort()">
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
                @foreach($hotels as $hotel)
                    <div class="panel panel-default hotelsna">
                        <div class="panel-body">
                            <h4 class="pull-right">Rate:
                                <a href="#" onclick="rateUp('{{ $hotel->id }}')"><span class="glyphicon glyphicon-thumbs-up"></span></a>
                                <a href="#" onclick="rateDown('{{ $hotel->id }}')"><span class="glyphicon glyphicon-thumbs-down"></span></a>
                            </h4>
                            <img class="img img-responsive pull-left hotelImages" width="150" height="1" src="/uploads/{{ $hotel->photo }}"/>
                            <h4 class="hotelName"><strong>{{ $hotel->name }}</strong></h4>
                            <h5 class="hotelAddress">{{ $hotel->address }}</h5>
                            <h5 class="hotelAddress">{{ $hotel->contactnumber }}</h5>
                            <h5 class="hotelAddress">Ratings: <font id="hotelRatings{{ $hotel->id }}">
                                <span class="glyphicon glyphicon-thumbs-up"></span> {{ count($hotel->ratings->where('value', '1')) }} &nbsp;&nbsp;&nbsp;
                                <span class="glyphicon glyphicon-thumbs-down"></span> {{ count($hotel->ratings->where('value', '0')) }}
                            </font></h5>
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
                            <a class="w3-btn w3-teal" style="float: right; margin-right: 5px" href="#" onclick="initMap('{{$hotel->latitude}}', '{{$hotel->longitude}}')" data-toggle="modal" data-target="#mapModal">View Map</a>
                            @if($hotel->url == NULL)
                                <button class="w3-btn w3-teal" style="float: right; margin-right: 5px" disabled>Website not available yet</button>
                            @else
                                <a class="w3-btn w3-teal" href="http://{{ $hotel->url }}" style="float: right; margin-right: 5px">View Website</a>
                            @endif
                            <a class="w3-btn w3-teal" href="#" style="float: right; margin-right: 5px" data-toggle="modal" data-target="#commentsModal" onclick="hotelComment('{{ $hotel->id }}')">Comments</a>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
</div>
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

<div id="commentsModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Comments</h4>
                          </div>
                          <div class="modal-body" style="max-height: 400px; overflow: auto;">
                              <button data-toggle="collapse" data-target="#commentForm" class="btn btn-warning">Add Comment</button>
                              <div id="commentForm" class="collapse">
                                <form method="post" action="/comments/add">
                                 {{ csrf_field() }}
                                  <div class="form-group">
                                    <label for="name">Your Name:</label>
                                    <input type="name" class="form-control" id="name" name="name">
                                  </div>
                                  <div class="form-group">
                                    <label for="body">Comment:</label>
                                    <textarea class="form-control" id="body" name="body" cols="3"></textarea>
                                  </div>
                                  <input type="hidden" name="hotelid" id="comment_hotelid">
                                  <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                                </div>
                                <hr>
                                <div id="commentsContent">

                                </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>
@stop