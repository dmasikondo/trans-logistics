<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Fleet;
use App\Trailer;
use Auth;

class FleetController extends Controller
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

    /**
     * Display a listing of all trailers.
     *
     * @return \Illuminate\Http\Response
     */
    public function alltrailers()
    {
       return Trailer::orderBy('name','asc')->get();
    }
    public function index(User $user)
    {
    	$fleets = Fleet::where('user_id', $user->id)->get();
    	return $fleets->load(['capturers.uzer', 'trailers']);
    }
    public function post(User $user)
    {
    	$this->validate(request(),[
    		'number_of_horses' => 'required',
    		'number_of_trailers' => 'required',    		
    		'trailer_type' => 'required_with:number_of_trailers>0',
    	]);
    	$fleet = $user->fleets()->create([
    		'number_of_horses' => request()->number_of_horses,
    		'number_of_trailers' => request()->number_of_trailers,
    	]);
		$fleet->trailers()->sync(request()->trailer_type);
    	/**
    	 * create capturer details
    	 */
    	$capturer = Auth::user();
    	$fleet->capturers()->create([
    		'user_id' => $capturer->id,
    	]);    

    	return $fleet;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fleet $fleet)
    {
    	$this->validate(request(),[
    		'number_of_horses' => 'required',
    		'number_of_trailers' => 'required',    		
    		'trailer_type' => 'required_with:number_of_trailers>0',
    	]);
    		 $fleet->update([
    		'number_of_horses' => request()->number_of_horses,
    		'number_of_trailers' => request()->number_of_trailers,
    	]);  
    	$fleet->trailers()->sync(request()->trailer_type);

    	return response()->json(null, 200);      
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fleet $fleet)
    {
    	$fleet->trailers()->detach();
        $fleet->delete();
        return response()->json(null, 200); 
    }

}
