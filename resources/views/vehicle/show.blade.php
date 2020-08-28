@extends('layouts.app')

@section('content')
	<div class="container">	
		<vehicle-private-visibility :vehicle="{{$vehicle}}"></vehicle-private-visibility>	
		<div class="card">			
			<div class="card-header">
				<div class="pull-right">
					<a href="/vehicles/{{$vehicle->slug}}/edit"><i class="fa fa-edit"></i> Edit</a>
					<delete-vehicle :vehicle="{{$vehicle}}"></delete-vehicle>					
				</div>				
				<h3>{{$vehicle->trailer_type}}</h3>
				<p>{{$vehicle->capacity}}</p>
				<span class="text-center">{{$vehicle->available_date}}</span>

			</div>			
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<h4 class="card-title">From</h4>
						<p>{{$vehicle->city_from}}</p>
						<p>{{$vehicle->country_from}}</p>

					</div>
					<div class="col-md-6">
						<h4 class="card-title">Destination</h4>
						<p>{{$vehicle->city_to}}</p>
						<p>{{$vehicle->country_to}}</p>						
					</div>
					<p>{{$vehicle->more_details}}</p>
				</div>				
			</div>
		</div>
			
			<vehicle-public-visibility :vehicle="{{$vehicle}}"></vehicle-public-visibility>

	</div>
	
	
@endsection