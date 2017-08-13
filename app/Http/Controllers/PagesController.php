<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\Photo;
use App\Roomtype;
use App\Room;
use App\Map;
use App\Rating;

class PagesController extends Controller
{
    public function index(){
        $h = new Hotel;
        $hotels = $h->all();
        return view('homepage', compact('hotels'));
    }

    public function hotels(Request $req){
    	$h = new Hotel;
        $r = new Room;
        $rt = new Rating;
        if($r->sortby == 'name'){
            $hotels = $h->orderBy('name', 'asc')->get();
            $ro = new Room;
            return view('index', compact('hotels', 'ro', 'rt'));
        }elseif($req->sortby == 'address'){
            $hotels = $h->orderBy('address', 'asc')->get();
            $ro = new Room;
            return view('index', compact('hotels', 'ro', 'rt'));
        }elseif($req->sortby == 'price'){
            $hotels = $h->orderBy('price_range', 'asc')->get();
            $ro = new Room;
            return view('index', compact('hotels', 'ro', 'rt'));
        }elseif($req->sortby == 'rating'){
            $rt = new Rating;
            $hotels = $h->orderBy('ratings', 'desc')->get();
            $ro = new Room;
            return view('index', compact('hotels', 'ro', 'rt'));
        }else{
            $hotels = $h->all();
            $ro = new Room;
            return view('index', compact('hotels', 'ro', 'rt'));
        }
    }

    public function login(){
    	return view('login');
    }

    public function addhotel(){
    	return view('addhotel');
    }

    public function viewhotels(){
        $hotels = Hotel::withTrashed()->get();
        return view('viewhotels', compact('hotels'));
    }

    public function editHotel(Hotel $hotel){
        return view('edithotel', compact('hotel'));
    }

    public function editmyhotel(){
        $h = new Hotel;
        $hotel = $h->where('username', session('username'))->first();
        return view('editmyhotel', compact('hotel'));
    }

    public function mygallery(){
        $h = new Hotel;
        $g = new Photo;
        $photos = $g->where('hotel_id', session('id'))->get();
        return view('mygallery', compact('photos'));
    }

    public function managegallery(){
        $h = new Hotel;
        $p = new Photo;
        $hotels = $h->all();
        $photos = $p->all();
        return view('managegallery', compact('photos', 'hotels'));
    }

    public function viewrooms($id){
        $ro = new Room;
        $rooms = $ro->where('hotel_id', $id)->get();
        return view('viewgallery', compact('rooms'));
    }

    public function viewmap($id){
        $h = new Hotel;
        $hotel = $h->where('id', $id)->first();
        return view('viewmap', compact('hotel'));
    }

    public function myroomtypes(){
        $rt = new Roomtype;
        $roomtypes = $rt->where('hotel_id', session('id'))->get();
        return view('myroomtypes', compact('roomtypes'));
    }

    public function myrooms(){
        $r = new Room;
        $rooms = $r->where('hotel_id', session('id'))->get();
        return view('myrooms', compact('rooms'));
    }

    public function maptest(){
        return view('maptest');
    }

    public function managerooms(){
        $r = new Room;
        $rooms = $r->all();
        $h = new Hotel;
        $hotels = $h->all();
        return view('managerooms', compact('rooms', 'hotels'));
    }
}
