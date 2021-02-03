<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use SoftDeletes;

    protected $fillable = ['username', 'password', 'name', 'address', 'url', 'summary', 'photo', 'pricefrom', 'priceto', 'map', 'contactnumber', 'latitude', 'longitude', 'ratings'];

    public function photos(){
    	return $this->hasMany(Photo::class);
    }

    public function roomtypes(){
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
