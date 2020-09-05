@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

    @can('ownerOnly', $load)
					 <private-visibility-button :load="{{$load}}"></private-visibility-button>
	@endcan
			
            <div class="card mt-4">
            	<div class="card-header">
            		{{$load->transport_mode}}

     @can('update', $load)

            		<span class="pull-right">
            			{{$load->amount}} {{$load->carriage_rate}}
            			<a href="/loads/{{$load->slug}}/edit"><i class="fa fa-edit">Edit</i></a>
            			<delete-load :freight="{{$load}}"></delete-load>
            		</span>

	@endcan            		

            	</div>

    @can('update', $load)
            	<distance-vehicletype :freight="{{$load}}"></distance-vehicletype>
    @endcan
                <div class="card-body">					
					
					 <h6 class="card-title">
					 		<p>{{$load->name}}
					 			<span class="fa fa-legal"></span>
					 			{{$load->quantity}} x {{$load->size }}  {{$load->containers}}containers<br>
					 			 ~ {{$load->preferred_route}} Route
					 	
						 		<span class="pull-right text-muted">
						 			@foreach($load->categories as $category )
						 				{{$category->name}}
						 			@endforeach
						 		</span>
						 	</p>

					 		<p>{{$load->requirements}}</p>

					 </h6>

					 <div class="row">
					 	<div class="col-md-6">
					 		<h5>
					 			<span class="fa fa-map-marker text-success"> </span>
					 			Pick up location
					 		</h5>
					 		<p>
	@can('confidential', $load)					 			
					 			<span>{{$load->pickup_street}}</span><br>
	@endcan
					 			<span>{{$load->pickup_city}}</span><br>
					 			<span>{{$load->pickup_country}}</span><br>
					 			<span class="fa fa-calendar text-success"> </span>	
								Ready to Pick up on <br>
								{{$load->pickup_date->format('l d F Y')}}
					 		</p>
					 	</div>
					 	<div class="col-md-6">
					 		<h5>
								<span class="fa fa-map-marker text-danger"> </span>
					 			Destination
					 		</h5>
					 		<p>
	@can('confidential', $load)	
					 			<span>{{$load->destination_street}}</span><br>
	@endcan
					 			<span>{{$load->destination_city}}</span><br>
					 			<span>{{$load->destination_country}}</span><br>
					 			<span class="fa fa-calendar text-danger"> </span> 	
								Expected to be delivered on <br>
								{{$load->destination_date->format('l d F Y')}}					 			
					 		</p>					 		
					 	</div>					 	

					 </div>
					<hr>	
					<div class="media">
						<div class="">
							Payment Options:
						</div>						
						<div class="media-body ml-3 float-right">
							<span class="media-heading float-left"> 
								{{$load->payment_option}}
							</span>	
						</div>
						
					</div>
					<bid-component :load="{{$load}}"></bid-component>
                </div>
            </div>	

     @can('superconfidential', $load)		
				<public-visibility-button :load="{{$load}}"></public-visibility-button>	
	@endcan	
        </div>
    </div>
</div>
@endsection