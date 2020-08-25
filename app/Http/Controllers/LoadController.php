<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoadRequest;
use Illuminate\Support\Str;
use App\Category;
use App\User;
use App\Load;
use Auth;

class LoadController extends Controller
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
    public function index()
    {
        //
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

		return $load->slug;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Load $load)
    {
    	$user = $load->load('user');
    	$load = $load->load(['categories']);
        return view ('load.show', compact('load','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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


      $load->update($request->all());
      $load->categories()->sync($request->category_type);
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
    	
    	//check if not set for publishing in which case carrier can not edit it
    	if(request()->is_published ==true)
    	{
    		abort(422, 'Already set for publishing. ');
    	} 
    	else{
	  		 $freight = $load->update(['private_visibility' =>request()->private_visibility]);
	      	 return response()->json(null, 200);    		
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
		//check if not set private by the carrier can not edit it
		if(request()->private_visibility ==false)
		{
			abort(422, 'Consignment is currently set private. ');
		}   
		else{
	      	$freight = $load->update(['public_visibility' =>request()->public_visibility, 'is_published' => true]);
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
        return response()->json(null, 200);	
    }
}