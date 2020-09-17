@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
<!-- private visibility -->        	
    @can('ownerOnly', $load)
					 <private-visibility-button :load="{{$load}}"></private-visibility-button>
	@endcan

				<div class="card">
					<div class="card-img-top embed-responsive embed-responsive-21by9">
						<img class="card-img-top embed-responsive-item" src="/images/{{$load->randomImage()}}" alt="image {{$load->randomImage()}}">
					</div>
<!-- consignment category -->
					<div class="card-img-overlay">
						<h3 class="card-title">
						@foreach($load->categories as $category)
							<kbd>{{$category->name}}</kbd>
						</h3>
						@endforeach
					</div>
					<div class="row">
		                <div class="feature-wrap col-md-6" style="margin-top: -6em; z-index: 888888; position: relative;">
		                    <i class="{{$load->transportMode()}}"></i>

		                </div>	
		                <div class="col-md-5 text-right">

		                	<p>
		                		<small class="textmuted">Updated {{$load->updated_at->diffForHumans()}}</small>	
		                	</p>
<!-- Edit and Delete links -->		                	

		@can('update', $load)
				     		<p>
			            		<span class="pull-left">			            			
			            			<a href="/loads/{{$load->slug}}/edit"><i class="fa fa-edit"> Edit</i></a>
			            		</span>		
			            		<delete-load :freight="{{$load}}"></delete-load>			     			
				     		</p>
		@endcan	

		                </div>	

	    @can('update', $load)
	            		<distance-vehicletype :freight="{{$load}}"></distance-vehicletype>
	    @endcan

					</div>

					<div class="card-body">
<!-- Consignemnt details -->						
						<h3 class="card-title">{{$load->name}}</h3>
						<hr>
						<p class="card-text">
							<b>Description:</b> {{$load->size}} x {{$load->quantity}} items and {{$load->containers}} Container(s)
						</p>
						<p class="card-text">
							<b>Distance (km): </b> {{ is_null($load->distance)? 'Not Stated' : $load->distance }}
						</p>
						<p class="card-text">
							<b>Required Truck Type: </b> {{is_null($load->vehicle_type)? 'Not Specified' : $load->vehicle_type}}
						</p> 
						<div class="row">
							<div class="col-md-6">
								<p class="card-text">
									<i class="fa fa-calendar fa-3x"> </i>
									<b>Preferred Pickup Date:</b> {{$load->pickup_date->format('D d M Y')}}
								</p>								
							</div>
							<div class="col-md-6">
								<p class="card-text">
									<i class="fa fa-road fa-3x"> </i>
									<b>Preferred Route:</b> {{is_null($load->preferred_route)? 'Not Specified' : $load->preferred_route}}
								</p>										
							</div>
						</div>
						
					</div>
					<div class="card-footer" style="position: relative; z-index: 999999">
						<bid-component :load="{{$load}}"></bid-component>
					</div>

				</div>
<!-- public-visibility -->
	    @can('superconfidential', $load)		
					<public-visibility-button :load="{{$load}}"></public-visibility-button>	
		@endcan	

				<div class="row justify-center">
					<div class="col-md-7 offset-md-1">
						<h3><kbd>More Details</kbd></h3>

						{!! nl2br($load->requirements)!!}					
					</div>
				</div>


<!-- location --> <div class="row justify-center about wow fadeInDown">
				 	<div class="col-md-5 offset-md-1">
				 		<h5>
				 			<span class="fa fa-map-marker fa-3x text-primary"> </span>
				 			Pick up location
				 		</h5>
				 		<p>
@can('confidential', $load)					 			
				 			<span class="fa fa-lg fa-road"> </span> {{$load->pickup_street}} <small class="text-muted">(Not Public)</small><br>
@endcan
				 			<span class="fa fa-lg fa-building"> </span> {{$load->pickup_city}}<br>
				 			<span class="fa fa-lg fa-flag"> </span> {{$load->pickup_country}}<br>
				 			<span class="fa fa-lg fa-calendar"> </span>	
							Ready to Pick up on <br>
							{{$load->pickup_date->format('l d F Y')}}
				 		</p>
				 	</div>
				 	<div class="col-md-6">
				 		<h5>
							<span class="fa fa-map-marker text-danger fa-3x"> </span>
				 			Destination Location
				 		</h5>
				 		<p>
@can('confidential', $load)	
				 			<span class=" fa fa-lg fa-road"> </span> {{$load->destination_street}} <small class="text-muted">(Not Public)</small><br>
@endcan
				 			<span class=" fa fa-lg fa-building"> </span> {{$load->destination_city}}<br>
				 			<span class=" fa fa-lg fa-flag"> </span> {{$load->destination_country}}<br>
				 			<span class="fa fa-calendar fa-lg">   </span>	
							Expected to be delivered on <br>
							{{$load->destination_date->format('l d F Y')}}					 			
				 		</p>					 		
				 	</div>					 	

				 </div>	
				 <div class="row">
				 	<div class="col-md-6">
				 		<h3>
<!--Payment -->	 			<mark>Payment Offer</mark>
				 			<span class="fa fa-money fa-2x pull-right"></span>
				 		</h3>
						<ul class="list-group">
						  <li class="list-group-item list-group-item-success">Carriage Rate: - {{$load->carriage_rate}}</li>
						  <li class="list-group-item list-group-item-info">{{$load->amount}}</li>
						  <li class="list-group-item list-group-item-warning">{{$load->payment_option}}</li>
						</ul>
				 	</div>
<!--Consignment Creator -->
 @can('superconfidential', $load)
					<div class="col-md-6">
		                <div class="feature-wrap">
		                    <i class="fa fa-user"></i>
		                    <h3>Consignment Creator <small class="text-muted">(Not Public)</small></h3>
		                    <h4>
		                    	<a href="/#">{{$load->nameOfCreator(Auth::user())? 'Me' : $load->user->organisation}}</a> 
		                    </h4>
		                    <p>{{$load->user->email}}</p>
		            @foreach($load->user->roles as $role)
		                    <span class="pull-right label label-success">{{$role->name}}</span>
		          	@endforeach

		                </div>						
					</div>
@endcan
<!-- end of consignment creator -->				 	
				 </div>	

        </div>
<!-- end of Consignment listing -->

		<div class="col-md-3 offset-md-1">
<!-- Freight bids --->
			<h3>
				Consignment Bids
				<span class="badge badge-default">{{$load->bids->count()}}</span>
			</h3>
			@foreach($load->bids as $bid)
				<div class="media mb-4">
					<span class="circle {{App\Bid::randomColor()}} mr-2">{{substr($bid->bidder->organisation,0,1)}}</span>
					<div class="media-body">
						<a href="/bids/{{$bid->slug}}">{{$bid->bidder->organisation}}</a> <br>
						{{$bid->city_location}}, {{$bid->country_location}} <br>
						{{$bid->trailer_type}}
						<small class="text-muted">Posted {{$bid->updated_at->diffForHumans()}}</small> 						
					</div>
				</div>	

			@endforeach

<!-- Suggested vehicles -->
			<h3>
				Suggested Vehicles
				<span class="badge badge-default">{{$vehicles->count()}}</span>
			</h3>
			@foreach($vehicles as $vehicle)
				<div class="media">
					<span class="circle">{{substr($vehicle->user->organisation,0,1)}}</span>
					<div class="media-body">
						<p>
							{{$vehicle->user->organisation}} <br>
							{{$vehicle->trailer_type}}<br>
							{{$vehicle->city_from}} To {{$vehicle->city_to}}<br>

							<small class="text-muted">Posted {{$vehicle->updated_at->diffForHumans()}}</small> 
						</p>
					</div>
				</div>	

					


			@endforeach
		</div>


    </div>
</div>

@endsection

