<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataCapturer extends Model
{
	/**
	 * @var string Table	 
	 */

	protected $table = 'data_capturers';

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
	public function data_capturable()
	{
		return $this->morphTo();
	}

	public function uzer()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
