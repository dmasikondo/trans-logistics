<?php

namespace App\Policies;

use App\Load;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class LoadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     * user must be owner 
     *  or manager and is not private 
     *  or superadmin and is not private
     * or consignment is public
     * @param  \App\User  $user
     * @param  \App\Load  $load
     * @return mixed
     */
    public function view(User $user, Load $load)
    {
       // return true;

     return (
                ($load->user_id === $user->id) || 
                ($user->hasRole('manager') && $load->private_visibility == true) || 
                ($user->hasRole('superAdmin')  && $load->private_visibility == true) ||
                ($load->is_published && $load->public_visibility == true)
            )
        ;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     * if owner and not yet published / is admin
     * if manager and is not private
     * if superadmin and is not private
     *
     * @param  \App\User  $user
     * @param  \App\Load  $load
     * @return mixed
     */
    public function update(User $user, Load $load)
    {
        return (
                ($load->user_id === $user->id && !$load->is_published) || 
                ($user->hasRole('admin') && $load->user_id == $user->id)||
                ($user->hasRole('manager') && $load->private_visibility) || 
                ($user->hasRole('superAdmin')  && $load->private_visibility)
            )
        ;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Load  $load
     * @return mixed
     */
    public function delete(User $user, Load $load)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Load  $load
     * @return mixed
     */
    public function restore(User $user, Load $load)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Load  $load
     * @return mixed
     */
    public function forceDelete(User $user, Load $load)
    {
        //
    }


    /**
     * Determine whether the user can view some confidentials.
     * user is the creator or is superadmin or manager
     * @param  \App\User  $user
     * @param  \App\Load  $load
     * @return mixed
     */
    public function confidential(User $user, Load $load)
    {
        
       // return true;
        return (($load->user_id === $user->id) || $user->hasRole('manager') || $user->hasRole('superadmin'));
    }  

    /**
     * Determine whether the user can view some confidentials.
     * User is creator who is admin or is mananger or superadmin
     *
     * @param  \App\User  $user
     * @param  \App\Load  $load
     * @return mixed
     */
    public function superconfidential(User $user, Load $load)
    {
        return (($load->user_id === $user->id && ($user->hasRole('admin'))) || $user->hasRole('manager') || $user->hasRole('superadmin'));
    }  

    /**
     * Determine whether the user can view some confidentials.
     *
     * @param  \App\User  $user
     * @param  \App\Load  $load
     * @return mixed
     */
    public function ownerOnly(User $user, Load $load)
    {
        
        return ($load->user_id === $user->id);
    } 

    /**
      * Can place a bid to ship the coinsignment on conditions:
      * must be  a carrier
      * not owner of the coinsignment
      * the coinsignemnt is published
    */  

    public function canBid(User $user, Load $load)  
    {
        return ($user->hasRole('carrier') && ($user->id === $load->user_id) && $load->public_visibility);
    }  
}
