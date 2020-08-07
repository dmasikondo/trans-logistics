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
         * if user has not yet stated role
         */
    
                
        /**
         * if user has only filled the initial registration form
         */
      /*  if($request->user()->hasRole('no-role'))
        {
            return redirect('/home');
        }*/

        /**
         * if user has not yet filled in contacts form
         */
        if($request->user()->hasRole('carrier-initialising') || $request->user()->hasRole('general-initialising'))
        {
            return redirect('/organisation-contacts');
        }   

        /**
         * if user has filled in contacts form
         */
        if($request->user()->hasRole('general') || $request->user()->hasRole('carrier'))
        {
            return redirect('/dashboard/'.$request->user()->slug);
        }              

        return $next($request);
    }
}
