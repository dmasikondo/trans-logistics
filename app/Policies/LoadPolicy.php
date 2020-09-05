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
     *
     * @param  \App\User  $user
     * @param  \App\Load  $load
     * @return mixed
     */
    public function view(User $user, Load $load)
    {
        //if owner
        // not owner -> if published
        //if super admin // manager
        return (($load->user_id === $user->id) || 
                ($user->hasRole('manager') && $load->private_visibility) || 
                ($user->hasRole('superAdmin')  && $load->private_visibility) ||
                ($load->is_published && $load->public_visibility))
                ? 
                 Response::allow()
                 : Response::deny('You do not own this consignment.')
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
     *
     * @param  \App\User  $user
     * @param  \App\Load  $load
     * @return mixed
     */
    public function update(User $user, Load $load)
    {
        //created by user or user is admin
        return (($load->user_id === $user->id && !$load->is_published) || 
                ($user->hasRole('admin') && $load->user_id === $user->id)||
                ($user->hasRole('manager') && $load->is_published) || 
                ($user->hasRole('admin') && $load->user_id === $user->id)||
                ($user->hasRole('superAdmin')  && $load->is_published))? 
            Response::allow()
            : Response::deny('You do not own this consignment.')
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
     *
     * @param  \App\User  $user
     * @param  \App\Load  $load
     * @return mixed
     */
    public function confidential(User $user, Load $load)
    {
        // creator
        // ADMINS
        return (($load->user_id ===$user->id) || $user->hasRole('manager') || $user->hasRole('superadmin'));
    }  

    /**
     * Determine whether the user can view some confidentials.
     *
     * @param  \App\User  $user
     * @param  \App\Load  $load
     * @return mixed
     */
    public function superconfidential(User $user, Load $load)
    {
        // creator who is admin
        // ADMINS
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
        // creator who is admin
        // ADMINS
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
        return ($user->hasRole('carrier') && $user->id === $load->user_id && $load->public_visibility);
    }  
}
