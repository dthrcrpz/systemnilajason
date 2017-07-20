<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['photo', 'type'];

    public function hotel(){
    	return $this->belongsTo(Hotel::class);
    }
}
