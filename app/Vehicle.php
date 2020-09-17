<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */	
	protected $fillable =[
		'slug','more_details','capacity','trailer_type', 'route','available_date','city_from','city_to','country_from', 'country_to','load_type','user_id',
		'private_visibility','public_visibility','is_published',
	];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    /**
    * Get all of the organisation vehicles' capturers.
    */
    public function capturers()
    {
    return $this->morphMany('App\DataCapturer', 'data_capturable');
    } 

    // sentence-capitalise different variables
     public function getMoreDetailsAttribute($desc)
     {
         return ucwords($desc);
     }       
     public function getCapacityAttribute($desc)
     {
         return ucwords($desc);
     }   
     public function getTrailerTypeAttribute($desc)
     {
         return ucwords($desc);
     } 

     public function getCityFromAttribute($desc)
     {
         return ucwords($desc);
     } 
     public function getCityToAttribute($desc)
     {
         return ucwords($desc);
     }  
     public function getRouteAttribute($desc)
     {
         return ucwords($desc);
     }          
}
