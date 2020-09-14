@extends('layouts.app')

@section('content')
	<div class="container">

	
		<div class="row mb-4">
		@foreach($loads as $load)
			<div class="col-md-4">
				<div class="card">
					<div class="card-img-top embed-responsive embed-responsive-21by9">
						<img class="card-img-top embed-responsive-item" src="/images/{{$load->randomImage()}}" alt="image {{$load->randomImage()}}">
					</div>
					<div class="card-img-overlay">
						<h3 class="card-title">
						@foreach($load->categories as $category)
							<span>{{$category->name}}</span>
						</h3>
						@endforeach
					</div>
	                <div class="feature-wrap" style="margin-top: -2em; margin-bottom: -2em; z-index: 888888; position: relative;">
	                    <i class="{{$load->transportMode()}}"></i>  		                                            
	                </div>	

					<div class="card-body">
						<p class="pull-right">Updated {{$load->updated_at->diffForHumans()}}</p>
						<h3 class="card-title">{{$load->name}}</h3>
						<hr>
						<p class="card-text">
							<b>Description:</b> {{$load->size}} x {{$load->quantity}} items and {{$load->containers}} Container(s)
						</p>
						<p class="card-text">
							<b>From: </b> {{$load->pickup_city}} {{$load->pickup_country}}
						</p>
						<p class="card-text">
							<b>To: </b> {{$load->destination_city}} {{$load->destination_country}}
						</p> 
						<p class="card-text">
							<i class="fa fa-calendar fa-3x"> </i>
							<b>Preferred Pickup Date:</b> {{$load->pickup_date->format('D d M Y')}}
						</p>						
					</div>
					<div class="card-footer" style="position: relative; z-index: 999999">
						<a href="/loads/{{$load->slug}}">Read more</a>
					</div>

				</div>

			</div>
			@endforeach
		</div>
		   {{ $loads->links()}}

	</div>
@endsection