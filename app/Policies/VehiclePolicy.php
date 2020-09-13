<?php

namespace App\Policies;

use App\User;
use App\Vehicle;
use Illuminate\Auth\Access\HandlesAuthorization;

class VehiclePolicy
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
     * @param  \App\Vehicle  $vehicle
     * @return mixed
     */
    public function view(User $user, Vehicle $vehicle)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     * user must be a carrier or admin
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('carrier') || $user->hasRole('admin') || $user->hasRole('superadmin') || $user->hasRole('manager');
    }

    /**
     * Determine whether the user can update the model.
     * own vehicle and vehicle not published or  own vehicle and user is admin or any vehicle and user is manager or superadmin and
     * 
     * @param  \App\User  $user
     * @param  \App\Vehicle  $vehicle
     * @return mixed
     */
    public function update(User $user, Vehicle $vehicle)
    {
        return ($vehicle->user_id === $user->id && !$vehicle->is_published ) || 
                ($vehicle->$vehicle->user_id === $user->id && ($user->hasRole('admin') || $user->hasRole('manager') || $user->hasRole('superadmin'))) ||
                (($vehicle->private_visibility) && ($user->hasRole('superuser') || $user->hasRole('admin')));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Vehicle  $vehicle
     * @return mixed
     */
    public function delete(User $user, Vehicle $vehicle)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Vehicle  $vehicle
     * @return mixed
     */
    public function restore(User $user, Vehicle $vehicle)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Vehicle  $vehicle
     * @return mixed
     */
    public function forceDelete(User $user, Vehicle $vehicle)
    {
        //
    }
}
