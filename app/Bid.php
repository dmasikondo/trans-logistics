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
        'price','date_available','available_capacity','trailer_type','vehicle_location','slug',
    ];		

    public function freight(){
    	return $this->belongsTo(Load::class);
    }

    /**
    * Get all of the load for carriage bidders
    */
    public function bidders()
    {
    return $this->morphMany('App\Interested', 'interestedable');
    }     
}
