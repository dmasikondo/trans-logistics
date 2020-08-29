<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VehicleRequest;
use Illuminate\Support\Str;
use App\User;
use App\Vehicle;
use Auth;

class VehicleController extends Controller
{

	public function __construct()
	{
		return $this->middleware('auth');
	}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$user = Auth::user();
        return view('vehicle.create', compact('user'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleRequest $request)

    {	$slug = Str::slug(request()->trailer_type).uniqid();	
		$vehicle = Auth::user()->vehicles()->create(array_merge($request->all(), ['slug' =>$slug]));

    	/**
    	 * create capturer details
    	 */	      
    		$vehicle->capturers()->create([
    		'user_id' => Auth::user()->id,
    		]); 
		return $vehicle->slug;
    } 

    /**
     * Display the specified resource.
     *
     * @param  str $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        return view ('vehicle.show', compact('vehicle'));
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  str $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        return view('vehicle.edit', compact('vehicle'));
    }

   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  str slug
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleRequest $request, Vehicle $vehicle)
    {


      $vehicle->update($request->all());

    	/**
    	 * create capturer details
    	 */	      
    		$vehicle->capturers()->create([
    		'user_id' => Auth::user()->id,
    		]);       
       return response()->json(null, 200);
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  str $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
    	/**
    	 * create capturer details
    	 */
    	$vehicle->capturers()->create([
    		'user_id' => Auth::user()->id,
    	]);         
        return response()->json(null, 200);	
    }  

    /**
     * Update the vehicle in need of goods to ship private visibility resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  str $vehicle
     * @return \Illuminate\Http\Response
     */
    public function privateVisibility(Vehicle $vehicle)
    {
    	
    	//check if not set for publishing in which case carrier can not edit it
    	if(request()->is_published ==true)
    	{
    		abort(422, 'Already set for publishing. ');
    	} 
    	else{
     		
	  		 $vehicle = $vehicle->update(['private_visibility' =>request()->private_visibility]);
	      	 return $vehicle;  

    	/**
    	 * create capturer details
    	 */	      
    		$vehicle->capturers()->create([
    		'user_id' => Auth::user()->id,
    		]);	      	 		
    	}     	  	
   
    } 

  /**
     * Update the vehicle in need of goods to ship public visibility resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  str $vehicle
     * @return \Illuminate\Http\Response
     */
    public function publicVisibility(Vehicle $vehicle)
    {
		//check if not set private by the carrier, admin can not edit it
		if($vehicle->private_visibility ==false)
		{
			abort(422, 'Vehicle is currently set private. ');
		}   
		else{
	      	$vehicle->update(['public_visibility' =>request()->public_visibility, 'is_published' => true]);

    	/**
    	 * create capturer details
    	 */	      
    		$vehicle->capturers()->create([
    		'user_id' => Auth::user()->id,
    		]); 	      	
	       	return response()->json(null, 200);			
			}  	

    	}                      
}
