<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Buslocation;
use Auth;

class BuslocationController extends Controller
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
    	$buslocations = Buslocation::where('user_id', $user->id)->get();
    	return $buslocations->load('capturers.uzer');
    }
    public function post(User $user)
    {
    	$this->validate(request(),[
    		'country' => 'required',
    		'city' => 'required',    		
    		'address' => 'required|min:2',
    	]);
    	$buslocation = $user->buslocations()->create([
    		'country' => request()->country,
    		'city' => request()->city,
    		'address' => request()->address,
    	]);
    	/**
    	 * create capturer details
    	 */
    	$capturer = Auth::user();
    	$buslocation->capturers()->create([
    		'user_id' => $capturer->id,
    	]);    

    	return $buslocation;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buslocation $buslocation)
    {
    	$this->validate(request(),[
    		'country' => 'required',
    		'city' => 'required',    		
    		'address' => 'required|min:2',
    	]);
    	$buslocation = $buslocation->update([
    		'country' => request()->country,
    		'city' => request()->city,
    		'address' => request()->address,
    	]);  
    	return response()->json(null, 200);      
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buslocation $buslocation)
    {
        $buslocation->delete();
        return response()->json(null, 200); 
    }
}
