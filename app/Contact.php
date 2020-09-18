<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'person' ,'phone', 'whatsapp','user_id',
    ];	

    /**
     * A contact belongs to the user class of the 
     */
   	public function user()
    {
    	return $this->belongsTo(User::class);
    }

    /**
    * Get all of the organisation contacts' capturers.
    */
    public function capturers()
    {
    	return $this->morphMany('App\DataCapturer', 'data_capturable');
    } 

    // sentence-capitalise different variables
     public function getPersonAttribute($desc)
     {
         return ucwords($desc);
     } 

}
