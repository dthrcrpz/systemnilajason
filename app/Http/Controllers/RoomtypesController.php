<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\Roomtype;

class RoomtypesController extends Controller
{
    public function add(Request $request){
    	$rt = new Roomtype;
    	$target = $rt->where('id', $request->id)->first();
    	$target->update(['isadded' => 'yes']);
    	return back();
    }

    public function remove(Request $request){
    	$rt = new Roomtype;
    	$target = $rt->where('id', $request->id)->first();
    	$target->update(['isadded' => 'no']);
    	return back();
    }
}
