<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug' ,'organisation', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();    
    }
 

    /**
     * Assign user a role
     */

    public function assignRole($role)
    {
       // $check_if_role_exists = Role::where('name',$role)->get();
            

        return $this->roles()->save(Role::firstOrCreate(['name' =>$role]));
    } 

    /**
      * Check if the user has role of 
    */   

    public function hasRole($role)
    {
        return $this->roles->contains('name',$role);
    }  

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    } 

    public function buslocations()
    {
        return $this->hasMany(Buslocation::class);
    }   

    public function fleets()
    {
        return $this->hasMany(Fleet::class);
    } 
    public function directors()
    {
        return $this->hasMany(Director::class);
    }  

     public function traderefs()
    {
        return $this->hasMany(Traderef::class);
    }
     public function loads()
    {
        return $this->hasMany(Load::class);
    }   

     public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    } 

    // sentence-capitalise different variables
     public function getOrganisationAttribute($desc)
     {
         return ucwords($desc);
     } 
}
