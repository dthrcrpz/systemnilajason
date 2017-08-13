<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['hotel_id', 'rater', 'value'];

    public function hotel(){
    	return $this->belongsTo(Hotel::class);
    }
}
