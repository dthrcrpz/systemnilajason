@extends('layout')

@section('title')
	Homepage
@stop

@section('homepage')
	<form method="get" action="/search">
        <div class="input-group" style="width: 700px; margin: auto;">
            <input type="text" class="form-control input-lg" placeholder="Search by name, address" name="q">
            <div class="input-group-btn">
                <button class="w3-btn w3-teal input-lg" type="submit" style="margin-left: -4px; width: 120px">
                    <span class="glyphicon glyphicon-search"></span> Search
                </button>
            </div>
        </div>
    </form>
    <div class="container-fluid" style="margin-top: 20px">
        <div class="row">
            @foreach($hotels as $hotel)
                @if(!$hotel->photo)

                @else
                    <div class="col-sm-4 text-center">
                        <img class="img-responsive img-rounded img-thumbnail" src="/uploads/{{ $hotel->photo }}" style="height: 300px;">
                        <h5 class="text-center" style="color: white">{{ $hotel->name }}</h5>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@stop