<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoadRequest;
use Illuminate\Support\Str;
use App\Category;
use App\User;
use App\Load;
use App\Vehicle;
use Auth;
use Gate;

class LoadController extends Controller
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
     * Display a listing of all load categories.
     *
     * @return \Illuminate\Http\Response
     */

    public function allcategories()
    {
    	return Category::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    
    public function index(Load $loads)
    {
        $loads=$loads->load(['user','categories'])->latest();
        $loads=$loads->orderBy('pickup_date','desc')->paginate(2);  
        return view('load.index', compact('loads'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$user = Auth::user();
        return view('load.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoadRequest $request, User $user)
    {	$slug = Str::slug(request()->name).uniqid();	
		$load = $user->loads()->create(array_merge($request->all(), ['slug' =>$slug]));
		$load->categories()->sync($request->category_type);

    	/**
    	 * create capturer details
    	 */	      
    		$load->capturers()->create([
    		'user_id' => Auth::user()->id,
    		]); 
		return $load->slug;
    }

    /**
     * Display the specified resource.
     *
     * @param  str $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Load $load, Vehicle $vehicle)
    {
	/**
	 * first check if user is authorized to view
	 */
    $user = Auth::user();
        $this->authorize('view', $load);
        //suggested load
        //'capacity','trailer_type', 'route','available_date','city_from','city_to','country_from', 'country_to',
        // trailer type, city country, 
       // $vehicles = $vehicle->where('trailer_type', $load->trailer_type)->get();
        $vehicles = Vehicle::all();
        $load = $load->load(['categories','user','bids']);
    	
        return view ('load.show', compact('load','vehicles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Load $load)
    {
	/**
	 * first check if user is authorized to update
	 */

         if(auth()->user()->can('update', $load) ){
           $load =$load->load(['user','categories']);
        } 
		
        return view('load.edit', compact('load'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LoadRequest $request, Load $load)
    {
	/**
	 * first check if user is authorized to update
	 */
		if(!$this->authorize('update', $load)){
			return $this->authorize('update', $load);
		}   	


      $load->update($request->all());
      $load->categories()->sync($request->category_type);

    	/**
    	 * create capturer details
    	 */	      
    		$load->capturers()->create([
    		'user_id' => Auth::user()->id,
    		]);       
       return response()->json(null, 200);
    }

    /**
     * Update the consignment private visibility resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function privateVisibility(Load $load)
    {
    	
    	//check if not set for publishing in which case shipper can not edit it
    	if($load->is_published)
    	{
    		abort(422, 'Already set for publishing. ');
    	} 
    	else{
    		
	  		 $freight = $load->update(['private_visibility' =>request()->private_visibility]);
	      	 return response()->json(null, 200);    

    	/**
    	 * create capturer details
    	 */	      
    		$load->capturers()->create([
    		'user_id' => Auth::user()->id,
    		]); 	      	 		
    	}   	
   
    }  

    /**
     * Update the consignment public visibility resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publicVisibility(Load $load)
    {
		//check if not set private by the shipper, admin can not edit it
		if($load->private_visibility ==false)
		{
			abort(422, 'Consignment is currently set private. ');
		}   
		else{
	      	$freight = $load->update(['public_visibility' =>request()->public_visibility, 'is_published' => true]);

    	/**
    	 * create capturer details
    	 */	      
    		$load->capturers()->create([
    		'user_id' => Auth::user()->id,
    		]); 	      	
	       	return response()->json(null, 200);			
		}  	

    }
    /**
     * Update the consignment distance and trailer resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function distanceTrailer(Load $load)
    {
	      $freight = $load->update(['distance' =>request()->distance, 'vehicle_type' => request()->vehicle_type]);

    	/**
    	 * create capturer details
    	 */	      
    		$load->capturers()->create([
    		'user_id' => Auth::user()->id,
    		]); 	      
	       return response()->json(null, 200);			
	 	

    }
    /**
     * Display the new load resource.
     *
     * @param  str  $load
     * @return \Illuminate\Http\Response
     */
    public function newFreightValue(Load $load)
    {
    	return Load::where('slug',$load->slug);
    }       

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Load $load)
    {
        $load->delete();
    	/**
    	 * create capturer details
    	 */
    	$load->capturers()->create([
    		'user_id' => Auth::user()->id,
    	]);         
        return response()->json(null, 200);	
    }
}