@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card">    
            <div class="card-header">
                <h2 class="py-4">
                	Bid for: {{$bid->bidable->name}}
                	<small class="pull-right">
                		{{$bid->bidable->pickup_city}} To {{$bid->bidable->destination_city}}
                		<span class="fa-3x {{$bid->bidable->transportMode()}}"></span>
                	</small>
                	
                </h2>
                <div class="feature-wrap justify-content-center d-flex">
                    <i class="fa fa-gavel"></i>                          
                </div> 

                <div class="row">

	                <div class="col-md-9">
	                    <a href="/loads/{{$bid->bidable->slug}}" >  
	                        Back <i class="fa fa-chevron-left fa-2x text-success"></i>
	                    </a>                                        
	                </div>

					<div class="col-md-3 media mb-4 justify-content-right d-flex">
						<span class="circle {{App\Bid::randomColor()}} mr-2">{{substr($bid->bidder->organisation,0,1)}}</span>
						<div class="media-body">
							<a href="/bids/{{$bid->slug}}">{{$bid->bidder->organisation}}</a> <br>
							<small class="text-muted">Posted {{$bid->updated_at->diffForHumans()}}</small> 						
						</div>
					</div>  

                </div>

            </div>  
          </div>
<!--Bid comparisaon --> 
				<ul class="list-group">
				  <li class="list-group-item">
					  	<b>Trailer Type</b> 
					  	<span class="pull-right">{{$bid->trailer_type}} 
					  		<b class="text-muted"> | required</b> 
					  		{{$bid->bidable->vehicle_type}}
					  	</span>	
					  	<span class="fa {{$bid->trailer_type === $bid->bidable->vehicle_type? 'text-success fa-check': 'text-danger fa-remove'}}"><span>			
				  </li>

				  <li class="list-group-item">
					  	<b>Vehicle Country Location</b> 
					  	<span class="pull-right">{{$bid->country_location}} 
					  		<b class="text-muted"> | required</b> 
					  		{{$bid->bidable->pickup_country}}
					  	</span>	
					  	<span class="fa {{$bid->country_location === $bid->bidable->pickup_country? 'text-success fa-check': 'text-danger fa-remove'}}"><span>			
				  </li>	

				  <li class="list-group-item">
					  	<b>Vehicle City Location</b> 
					  	<span class="pull-right">{{$bid->city_location}} 
					  		<b class="text-muted"> | required</b> 
					  		{{$bid->bidable->destination_city}}
					  		<kbd>Preferred Route: {{$bid->bidable->preferred_route}}</kbd>
					  	</span>	
					  	<span class="fa {{$bid->city_location === $bid->bidable->destination_city? 'text-success fa-check': 'text-danger fa-remove'}}"><span>			
				  </li>		

				  <li class="list-group-item">
					  	<b>Vehicle Capacity (tonnes)</b> 
					  	<span class="pull-right">{{$bid->available_capacity}} 
					  		<b class="text-muted"> | required</b> 
					  		{{$bid->bidable->size}} x 
					  		{{$bid->bidable->quantity}}
					  		{{is_null($bid->bidable->containers)? '0' : $bid->bidable->containers}}Container(s)
					  	</span>				
				  </li>					  		  

				  <li class="list-group-item">
					  	<b>Cost US$</b> 
					  	<span class="pull-right">{{$bid->price}} 
					  		<b class="text-muted"> | required</b> 
					  		{{$bid->bidable->carriage_rate}} 
					  		{{$bid->bidable->amount}}
					  		<kbd>{{$bid->bidable->payment_option}}</kbd>
					  	</span>				
				  </li>	
				</ul>


	<!--- Other Bidders -->
			<div class="card">
	         	<div class="card-body">
	         		<h4 style="margin-top: -2em;">Other Bidders</h4>
			@foreach($bids as $bid)	
					<a href="/bids/{{$bid->slug}}" title={{$bid->bidder->organisation}}>
						<span class="float-left circle {{App\Bid::randomColor()}} mr-2">{{substr($bid->bidder->organisation,0,1)}}</span>	
					</a>		
								
			@endforeach	         		
	         	</div>
	         </div>						         
	</div>
@endsection