<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Hotel;

class CommentsController extends Controller
{
    public function add(Request $r){
    	$c = new Comment;
    	$c->name = $r->name;
    	$c->body = $r->body;
    	$c->hotel_id = $r->hotelid;
    	$c->save();
    	return redirect('/');
    }

    public function view(Request $r){
    	$c = new Comment;
    	$comments = $c->where('hotel_id', $r->id)->get();
    	return view('commentscontent', compact('comments'));
    }

    public function delete(Request $r){
        $c = new Comment;
        $c->where('id', $r->comment_id)->first();
        $c->delete();
        return redirect('/');
    }
}
