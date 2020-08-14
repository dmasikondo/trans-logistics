<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */	
	protected $fillable =[
		'number_of_horses','number_of_trailers','user_id',
	];
    public function trailers()
    {
    	return $this->belongsToMany(Trailer::class)->withTimestamps();
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    /**
    * Get all of the organisation fleets' capturers.
    */
    public function capturers()
    {
    return $this->morphMany('App\DataCapturer', 'data_capturable');
    }     
}
