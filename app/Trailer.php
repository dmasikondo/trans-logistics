<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trailer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */	
	protected $fillable =[
		'name',
	];
    public function fleets()
    {
    	return $this->belongsToMany(Trailer::class)->withTimestamps();
    }

    // sentence-capitalise different variables
     public function getNameAttribute($desc)
     {
         return ucwords($desc);
     }     
}
