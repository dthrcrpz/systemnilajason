<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
	protected $fillable = ['location'];

    public function hotel(){
    	return $this->belongsTo(Hotel::class);
    }
}
