<?php

namespace App\Http\Middleware;

use Closure;

class ShipperMiddleware
{
    /**
     * Handle an incoming request.
     * Shipper must be a logged in user with contact details
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * if user does not have any contacts
         */
        if($request->user()->hasRole('no-role')){
            return redirect('/home');
        }        

        /**
         * if user has stated whether is a carrier or not
         */
        if($request->user()->hasRole('carrier-initialising') || $request->user()->hasRole('general-initialising'))
        {
            return redirect('/organisation-contacts');
        }   
        /**
         * if user does not have any contacts
         */
        if(!$request->user()->hasContact() && !$request->user()->hasRole('no-role')){
            return redirect('/organisation-contacts');
        }
        /**
         * if user does not have any contacts
         */
        if(!$request->user()->hasContact() && !$request->user()->hasRole('no-role')){
            return redirect('/organisation-contacts');
        }        
        return $next($request);
    }
}
