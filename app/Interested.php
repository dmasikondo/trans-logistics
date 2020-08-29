<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interested extends Model
{
	/**
	 * @var string Table	 
	 */

	protected $table = 'interested';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
    ];		
	/**
	* Get the owning DataCapturable model.
	*/
	public function interestable()
	{
		return $this->morphTo();
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
