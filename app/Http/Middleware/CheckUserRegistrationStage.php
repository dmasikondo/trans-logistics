<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckUserRegistrationStage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
 
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
         * if user has filled in contacts form or is an admin
         */        
        if($request->user()->hasRole('general') || 
            $request->user()->hasRole('carrier') || 
            $request->user()->hasRole('admin')|| 
            $request->user()->hasRole('manager')||
            $request->user()->hasRole('superadmin'))
        {
            return redirect('/dashboard/'.$request->user()->slug);
        }              

        return $next($request);
    }
}
