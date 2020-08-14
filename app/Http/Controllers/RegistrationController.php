<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class RegistrationController extends Controller
{
   /**
    * view Registration of Organisation's contact resources
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
}
