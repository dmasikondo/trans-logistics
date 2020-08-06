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
        'person' ,'phone', 'whatsapp',
    ];	
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
