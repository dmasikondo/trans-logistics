<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Traderef;
use Auth;

class TraderefController extends Controller
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
    	$traderefs = Traderef::where('user_id', $user->id)->get();
    	return $traderefs->load('capturers.uzer');
    }
    public function post(User $user)
    {
    	$this->validate(request(),[
    		'phone' => 'required',
    		'address' => 'required',    		
    		'name' => 'required|min:2',
    	]);
    	$traderef = $user->traderefs()->create([
    		'phone' => request()->phone,
    		'address' => request()->address,
    		'name' => request()->name,
    	]);
    	/**
    	 * create capturer details
    	 */
    	$capturer = Auth::user();
    	$traderef->capturers()->create([
    		'user_id' => $capturer->id,
    	]);    

    	return $traderef;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Traderef $traderef)
    {
    	$this->validate(request(),[
    		'phone' => 'required',
    		'address' => 'required',    		
    		'name' => 'required|min:2',
    	]);
    	$traderef = $traderef->update([
    		'phone' => request()->phone,
    		'address' => request()->address,
    		'name' => request()->name,
    	]);  
    	return response()->json(null, 200);      
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Traderef $traderef)
    {
        $traderef->delete();
        return response()->json(null, 200); 
    } 
}
