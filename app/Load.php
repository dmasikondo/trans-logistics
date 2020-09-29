<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
     * if is a carrier and not own consignment and consignment is published
	 */
	public function userCanBidShipment(User $user)
	{
		return (bool) ($user->hasRole('carrier') && $user->id != $this->user_id && $this->public_visibility ==true);
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



    /**
     * type of transport mode icon to be displayed 
     *  for air, road, rail and sea freight
     */

    public function transportMode()
    {
        switch($this->transport_mode)
        {
            case 'rail freight':
            $type='fa fa-train';
            break;
            case 'road freight':
            $type='fa fa-truck';
            break;  
            case 'sea freight':
            $type='fa fa-ship';
            break;    
            case 'air freight':
            $type='fa fa-plane';
            break;                        
            default:
            $type='fa fa-plane';                                                                                                                                            
        } 

        return $type;       
    }

    /**
     * name of consignment create 
     *  (display ME if logged in user is the one)
     */

    public function nameOfCreator(User $user)
    {
        return (bool) $this->user()->where('id',$user->id)->count();

    }

    public function randomImage()
    {
        $images = ['contact.jpg','destination.jpg','fleet.jpg','freight.jpg','origin.jpg','shipper.jpg'];
        $randomised = array_rand($images);
        return $images[$randomised];
    }

     public function scopePublished($query)
     {
         return $query->where([['is_published', '=','1'], ['public_visibility', '=','1']]);
     }

    /**
      * remove under score on carriage rate
      */     
     public function getCarriageRateAttribute($desc)
     {
         return (string) ucwords(Str::of($desc)->replace('_', ' '));
     }
    // sentence-capitalise different variables
     public function getNameAttribute($desc)
     {
         return ucwords($desc);
     }       
     public function getDescriptionAttribute($desc)
     {
         return ucwords($desc);
     }   
     public function getPickupCityAttribute($desc)
     {
         return ucwords($desc);
     }
     public function getDestinationCityAttribute($desc)
     {
         return ucwords($desc);
     }
     public function getPreferredRouteAttribute($desc)
     {
         return ucwords($desc);
     }  
     public function getPickupStreetAttribute($desc)
     {
         return ucwords($desc);
     }  
     public function getDestinationAddressAttribute($desc)
     {
         return ucwords($desc);
     }
     public function getVehicleTypeAttribute($desc)
     {
         return ucwords($desc);
     }  
  
     public function getPaymentOptionAttribute($desc)
     {
         return ucwords($desc);
     }     
}
