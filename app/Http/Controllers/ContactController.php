<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contact;
use Auth;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(User $user)
    {
    	$contacts = Contact::where('user_id', $user->id)->get();
    	return $contacts->load('capturers.uzer');
    }
    public function post(User $user)
    {
    	$this->validate(request(),[
    		'phone' => 'required|unique:contacts',
    		'whatsapp' => 'sometimes|unique:contacts',    		
    		'person' => 'required|min:2',
    	]);
    	$contact = $user->contacts()->create([
    		'phone' => request()->phone,
    		'whatsapp' => request()->whatsapp,
    		'person' => request()->person,
    	]);
    	/**
    	 * create capturer details
    	 */
    	$capturer = Auth::user();
    	$contact->capturers()->create([
    		'user_id' => $capturer->id,
    	]);

    	/**
    	 * update user role to indicate that contacts form has been filled
    	 */

   		if($user->hasRole('carrier-initialising')){
   			$user->roles()->sync([5]);
   		}
   		else if($user->hasRole('general-initialising')){
   			$user->roles()->sync([4]);
   		}

    	return $contact;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
    	$this->validate(request(),[
    		'phone' => 'required|unique:contacts,phone,'.$contact->id,
    		'whatsapp' => 'sometimes|unique:contacts,whatsapp,'.$contact->id,    		
    		'person' => 'required|min:2',
    	]);
    	$contact = $contact->update([
    		'phone' => request()->phone,
    		'whatsapp' => request()->whatsapp,
    		'person' => request()->person,
    	]);  
    	return response()->json(null, 200);      
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->json(null, 200); 
    }  
}