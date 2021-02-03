<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class RoomsController extends Controller
{
    public function addrooms(Request $r){
    	$ro = new Room;
    	$ro->hotel_id = session('id');
    	$ro->type = $r->type;
    	$ro->price = $r->price;
    	$ro->photo = request()->file('photos1')->store('/photos/'.session('username'));
    	$ro->save();
    	return back();
    }

    public function delete(Request $r){
    	$ro = new Room;
    	$target = $ro->where('id', $r->id)->first();
    	$target->delete();
    	return back();
    }

    public function managerooms(Request $r){
        $ro = new Room;
        $ro->hotel_id = $r->hotelid;
        $ro->type = $r->type;
        $ro->price = $r->price;
        $ro->photo = request()->file('photos1')->store('/photos/'.session('username'));
        $ro->save();
        return back();
    }
}
