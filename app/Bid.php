<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
	/**
	 * @var string Table	 
	 */

	protected $table = 'bids';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price','date_available','available_capacity','trailer_type','country_location', 'city_location','slug','is_awarded','user_id',
    ];		



    /**
    * Get all of the load for carriage bidders
    */
    public function coinsignment()
    {
    	return $this->morphTo();
    } 
	/**
	 * Get the user who made a bid
	 */
	public function bidder()
	{
		return $this->belongsTo(User::class, 'user_id');
	} 

    // sentence-capitalise different variables
     public function getAvailableCapacityAttribute($desc)
     {
         return ucwords($desc);
     }     

     public function getTrailerTypeAttribute($desc)
     {
         return ucwords($desc);
     } 

     public function getCityLocationAttribute($desc)
     {
         return ucwords($desc);
     }    
     public function getCountryLocationAttribute($desc)
     {
         return ucwords($desc);
     }        

}