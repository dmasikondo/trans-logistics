<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class RegistrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
        $this->middleware('shipper');
    }  
   /**
    * view Registration of Organisation's contact resources
    *
    */

   public function show(Request $request)
   {
   		if($request->carrier =='yes'){
   			Auth::user()->roles()->sync([2]);
   		}
   		else if($request->carrier =='no'){
   			Auth::user()->roles()->sync([3]);
   		}   		

   		$user = Auth::user();
   		return view('registration.contacts', compact('user'));
   }
   /**
    * view Registration of Organisation's business location resources
    */
   public function buslocations()
   {
   		$user = Auth::user();
   		return view('registration.buslocations', compact('user'));   	
   }

   /**
    * view Registration of Organisation's fleet information resources
    */
   public function fleets()
   {
   		$user = Auth::user();
   		return view('registration.fleets', compact('user'));   	
   } 

   /**
    * view Registration of Organisation's directors resources
    */
   public function directors()
   {
   		$user = Auth::user();
   		return view('registration.directors', compact('user'));   	
   } 
   /**
    * view Registration of Organisation's traderefs resources
    */
   public function traderefs()
   {
   		$user = Auth::user();
   		return view('registration.traderefs', compact('user'));   	
   }        
}
