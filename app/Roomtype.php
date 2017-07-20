<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roomtype extends Model
{
	protected $fillable = ['hotel_id', 'room_type', 'isadded'];
    public function hotel(){
    	return $this->belongsToMany(Hotel::class);
    }
}
