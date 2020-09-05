<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'loads';	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug','transport_mode','name','description','size','containers','pickup_city', 'destination_city','pickup_street', 'destination_street','destination_country','pickup_country','quantity',
		'pickup_date','preferred_route','destination_date','vehicle_type','carriage_rate','payment_option','amount','status','distance','is_published','public_visibility','private_visibility',
		'requirements',
    ];

 	protected $dates = ['pickup_date','destination_date',];

    public function categories()
    {
    	return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    /**
     * Get the shipment bids
     */
    public function bids()
    {
   
    	return $this->morphMany('App\Bid', 'bidable');
 
    }

    /**
     * get the number of carriers who have made bids
     */

    public function numberOfBids()
    {
    	return $this->bids()->count();
    } 

    /**
      * check bids made by the user for this coinsignment
    */  
	public function bidFromUser(User $user)
	{
		return $this->bids()->where('user_id', $user->id);
	} 

	/**
	 * check if user can Bid or unBid
	 */
	public function userCanBidShipment(User $user)
	{
		return (bool) $user->hasRole('carrier') && $user->id !== $this->user_id && $this->public_visibility;
	}

	/**
	 * check if user can Bid or unBid
	 */
	public function userCanSeeBidder(User $user)
	{
		return (bool) $user->hasRole('admin') ||$user->hasRole('manager') || $user->hasRole('superadmin');
	}

    /**
    * Get all of the organisation fleets' capturers.
    */
    public function capturers()
    {
    return $this->morphMany('App\DataCapturer', 'data_capturable');
    }  

    /**
      * check if user has has captured this consignnment
    */  
	public function captureFromUser(User $user)
	{
		return $this->capturers()->where('user_id', $user->id);
	} 


}


