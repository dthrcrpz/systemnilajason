<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\Photo;
use App\Roomtype;
use App\Room;
use App\Rating;

class HotelsController extends Controller
{
    public function add(Request $request){
        $h = new Hotel;
        $h->name = $request->name;
        $h->username = $request->username;
        $h->password = $request->password;
        $h->address = "Address has not been updated yet";
        $h->summary = "Summary has not been updated yet";
        $h->pricefrom = "1000";
        $h->priceto = "3000";
        $h->save();
        $id = $h->orderBy('created_at', 'desc')->first()->id;
        $this->addroomtype($id);
        session()->flash('addalert', 'alert alert-info');
        session()->flash('addalertmessage', 'Hotel has been added');
        return back();
    }

    public function delete(Hotel $hotel){
        foreach($hotel->rooms as $room){$room->delete();}
        if($hotel->photo){foreach($hotel->photo as $photo){$photo->delete();}}
        if($hotel->roomtype){foreach($hotel->roomtype as $roomtype){$roomtype->delete();}}
        if($hotel->ratings){foreach($hotel->ratings as $rating){$rating->delete();}}
        if($hotel->comments){foreach($hotel->comments as $comment){$comment->delete();}}
        $hotel->delete();
        return back();
    }

    public function update(Request $request, Hotel $hotel){
        $hotel->update($request->all());
        return redirect('/viewhotels');
    }

    public function editmyhotel(Request $request){
        if(!request()->file('photo')){
            $h = new Hotel;
            $hotel = $h->where('username', session('username'))->first();
            // $map = request()->file('map')->store('/uploads/maps/'.$request->username);
            $hotel->update([
                'name' => $request->name,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'url' => $request->url,
                'contactnumber' => $request->contactnumber,
                'pricefrom' => $request->pricefrom,
                'priceto' => $request->priceto,
                'summary' => $request->summary,
                'username' => $request->username,
                'password' => $request->password,
                ]);
            return redirect('/');
        }else{
            $h = new Hotel;
            $hotel = $h->where('username', session('username'))->first();
            $photo = request()->file('photo')->store('/uploads/photos/'.$request->username);
            $hotel->update([
                'name' => $request->name,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'contactnumber' => $request->contactnumber,
                'url' => $request->url,
                'price_range' => $request->price_range,
                'summary' => $request->summary,
                'username' => $request->username,
                'password' => $request->password,
                'photo' => $photo,
                ]);
            return redirect('/');
        }
    }

    public function admineditmyhotel(Request $request){
        if(!request()->file('photo')){
            $h = new Hotel;
            $hotel = $h->where('id', $request->hotelid)->first();
            // $map = request()->file('map')->store('/uploads/maps/'.$request->username);
            $hotel->update([
                'name' => $request->name,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'url' => $request->url,
                'contactnumber' => $request->contactnumber,
                'pricefrom' => $request->pricefrom,
                'priceto' => $request->priceto,
                'summary' => $request->summary,
                'username' => $request->username,
                'password' => $request->password,
                ]);
            return redirect('/');
        }else{
            $h = new Hotel;
            $hotel = $h->where('id', $request->hotelid)->first();
            $photo = request()->file('photo')->store('/uploads/photos/'.$request->username);
            $hotel->update([
                'name' => $request->name,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'contactnumber' => $request->contactnumber,
                'url' => $request->url,
                'price_range' => $request->price_range,
                'summary' => $request->summary,
                'username' => $request->username,
                'password' => $request->password,
                'photo' => $photo,
                ]);
            return redirect('/');
        }
    }

    public function search(Request $request){
        $h = new Hotel;
        $q = $request->q;
        $ro = new Room;
        $hotels = $h->where('name', 'LIKE', '%'.$q.'%')->orWhere('address', 'LIKE', '%'.$q.'%')->orWhere('pricefrom', 'LIKE', '%'.$q.'%')->orWhere('priceto', 'LIKE', '%'.$q.'%')->get();
        return view('index', compact('hotels', 'ro'));
    }

    public function advancedsearch(Request $request){
        $h = new Hotel;
        $r = new Room;
        $q = $request->price_range;
        $room = $request->rooms;
        $rt = new Roomtype;
        $rooms = $r->whereBetween('price', [$request->pricefrom, $request->priceto])->where('type', $request->roomtype)->get();
        $hotels = $h->all();
        $ro = new Room;
        return view('advancedsearch', compact('rooms', 'hotels', 'rt', 'ro'));
        return $rooms;
    }

    public function addphotos(Request $request){
        $uploads = $request->file('photos');
        if($request->hasFile('photos')){
            foreach($uploads as $up){
                $p = new Photo;
                $upload = $up->store('/galleries/'.session('username'));
                $p->location = $upload;
                $p->hotel_id = session('id');
                $p->save();
            }
        }else{
            echo "no files were selected";
        }
        return back();
    }

    public function managegallery(Request $request){
        $uploads = $request->file('photos');
        if($request->hasFile('photos')){
            foreach($uploads as $up){
                $p = new Photo;
                $upload = $up->store('/galleries/'.$request->hotelusername);
                $p->location = $upload;
                $p->hotel_id = $request->hotelid;
                $p->save();
            }
        }else{
            echo "no files were selected";
        }
        return back();
    }

    public function deletephoto(Photo $id){
        $id->delete();
        return back();
    }

    public function testing(){
        echo "testing";
    }

    public function addroomtype($id){
        $rt = new Roomtype;
        $rt->hotel_id = $id;
        $rt->room_type = "Standard Room";
        $rt->isadded = "no";
        $rt->save();

        $rt = new Roomtype;
        $rt->hotel_id = $id;
        $rt->room_type = "Deluxe Room";
        $rt->isadded = "no";
        $rt->save();

        $rt = new Roomtype;
        $rt->hotel_id = $id;
        $rt->room_type = "Double Suite";
        $rt->isadded = "no";
        $rt->save();

        $rt = new Roomtype;
        $rt->hotel_id = $id;
        $rt->room_type = "Family Suite";
        $rt->isadded = "no";
        $rt->save();

        $rt = new Roomtype;
        $rt->hotel_id = $id;
        $rt->room_type = "Premiere Suite";
        $rt->isadded = "no";
        $rt->save();

        $rt = new Roomtype;
        $rt->hotel_id = $id;
        $rt->room_type = "Superior Room";
        $rt->isadded = "no";
        $rt->save();

        $rt = new Roomtype;
        $rt->hotel_id = $id;
        $rt->room_type = "Superior Quadraple";
        $rt->isadded = "no";
        $rt->save();

        $rt = new Roomtype;
        $rt->hotel_id = $id;
        $rt->room_type = "Signature Suite";
        $rt->isadded = "no";
        $rt->save();
    }

    public function rateup(Request $r){
        $rt = new Rating;
        $check = $rt->where('hotel_id', $r->h)->where('rater', session('myIP'))->where('value', 1)->first();
        if($check){
            return '<span class="glyphicon glyphicon-thumbs-up"></span> '.$check = $rt->where('hotel_id', $r->h)->where('value', 1)->count().' &nbsp;&nbsp;&nbsp;
                <span class="glyphicon glyphicon-thumbs-down"></span> '.$check = $rt->where('hotel_id', $r->h)->where('value', 0)->count();
        }else{
            $rt->hotel_id = $r->h;
            $rt->rater = session('myIP');
            $rt->value = 1;
            $rt->save();
            return '<span class="glyphicon glyphicon-thumbs-up"></span> '.$check = $rt->where('hotel_id', $r->h)->where('value', 1)->count().' &nbsp;&nbsp;&nbsp;
                <span class="glyphicon glyphicon-thumbs-down"></span> '.$check = $rt->where('hotel_id', $r->h)->where('value', 0)->count();
        }
    }

    public function ratedown(Request $r){
        $rt = new Rating;
        $check = $rt->where('hotel_id', $r->h)->where('rater', session('myIP'))->where('value', 0)->first();
        if($check){
            return '<span class="glyphicon glyphicon-thumbs-up"></span> '.$check = $rt->where('hotel_id', $r->h)->where('value', 1)->count().' &nbsp;&nbsp;&nbsp;
                <span class="glyphicon glyphicon-thumbs-down"></span> '.$check = $rt->where('hotel_id', $r->h)->where('value', 0)->count();
        }else{
            $rt->hotel_id = $r->h;
            $rt->rater = session('myIP');
            $rt->value = 0;
            $rt->save();
            return '<span class="glyphicon glyphicon-thumbs-up"></span> '.$check = $rt->where('hotel_id', $r->h)->where('value', 1)->count().' &nbsp;&nbsp;&nbsp;
                <span class="glyphicon glyphicon-thumbs-down"></span> '.$check = $rt->where('hotel_id', $r->h)->where('value', 0)->count();
        }
    }
}
