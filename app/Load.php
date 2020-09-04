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
      * check if user has made a bid for this coinsignment
    */  
	public function bidFromUser(User $user)
	{
		return $this->bids()->where('user_id', $user->id);
	}         
    /**
    * Get all of the organisation fleets' capturers.
    */
    public function capturers()
    {
    return $this->morphMany('App\DataCapturer', 'data_capturable');
    }     
}


