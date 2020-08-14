<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Director;
use Auth;

class DirectorController extends Controller
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
    	$directors = Director::where('user_id', $user->id)->get();
    	return $directors->load('capturers.uzer');
    }
    public function post(User $user)
    {
    	$this->validate(request(),[
    		'phone' => 'required',
    		'address' => 'required',    		
    		'name' => 'required|min:2',
    	]);
    	$director = $user->directors()->create([
    		'phone' => request()->phone,
    		'address' => request()->address,
    		'name' => request()->name,
    	]);
    	/**
    	 * create capturer details
    	 */
    	$capturer = Auth::user();
    	$director->capturers()->create([
    		'user_id' => $capturer->id,
    	]);    

    	return $director;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Director $director)
    {
    	$this->validate(request(),[
    		'phone' => 'required',
    		'address' => 'required',    		
    		'name' => 'required|min:2',
    	]);
    	$director = $director->update([
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
    public function destroy(Director $director)
    {
        $director->delete();
        return response()->json(null, 200); 
    }  
}
