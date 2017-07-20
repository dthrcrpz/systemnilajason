<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = ['username', 'password', 'name', 'address', 'url', 'summary', 'photo', 'pricefrom', 'priceto', 'map', 'contactnumber', 'latitude', 'longitude'];

    public function photo(){
    	return $this->hasMany(Photo::class);
    }

    public function roomtype(){
    	return $this->hasMany(Roomtype::class);
    }

    public function rooms(){
    	return $this->hasMany(Room::class);
    }

    public function ratings(){
        return $this->hasMany(Rating::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
