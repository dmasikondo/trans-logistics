@extends('layouts.app')
<style>
	#wrapper{
		overflow-x: hidden;
	}
	#sidebar-wrapper{
		min-height: 100vh;
		margin-left: -15rem;
		transition: margin .25s ease-out;		
	}
	#sidebar-wrapper .sidebar-heading{
		padding: 0.875rem 1.25rem;
		font-size: 1.2rem;
	}
	#sidebar-wrapper .list-group{
		width: 15rem;
	}
	#page-content-wrapper{
		min-width: 100vw;
	}
	#wrapper .toggled #sidebar-wrapper{
		margin-left: 0;
	}
	@media(min-width: 768px){
		#sidebar-wrapper{
			margin-left: 0;
		}
		#page-content-wrapper{
			min-width: 0;
			width: 100%;
		}

		#wrapper .toggled #sidebar-wrapper{
			margin-left: -15rem;
		}
	}	
</style>
	@extends('layouts.nav.dashboard')
		@section('dashboard_content')
				<div class="row">
					<div class="col-md-4 mt-4">
						<div class="card">
							<div class="card-header">
								Contacts 
								<span class="fa fa-phone"></span>
								<span class="fa fa-whatsapp"></span>
								<span class="{{$user->contacts->isEmpty()? 'fa fa-warning text-danger': 'fa fa-check text-success'}} pull-right"></span>
							</div>
							<div class="card-body">
						<!--- user has contact details -->
								@if(!$user->contacts->isEmpty())
										<p>
											<span class="badge badge-info">{{count($user->contacts)}} </span> 
											Contact Details inserted
										</p>
										<a href="/organisation-contacts" class="btn btn-outline-success">View / Update</a>
								@else
										<p>
											You need to update your contact numbers. No contacts inserted yet
										</p>
										<a href="/organisation-contacts" class="btn btn-outline-danger">Update</a>									
								@endif

							</div>
						</div>
					</div>

					<div class="col-md-4 mt-4">
						<div class="card">
							<div class="card-header">
								Physical location 
								<span class="fa fa-map-marker"></span>
								<span class="fa fa-warning text-danger pull-right"></span>								
							</div>
							<div class="card-body">
								Organisation Physical Location
							</div>
						</div>
					</div>

					<div class="col-md-4 mt-4">
						<div class="card">
							<div class="card-header">
								Fleet Information
								<span class="fa fa-truck"></span>
								<span class="fa fa-warning text-danger pull-right"></span>									
							</div>
							<div class="card-body">
								Horses and trailers
							</div>
						</div>
					</div>					

				</div>
				<div class="row mt-4">

					<div class="col-md-4 mt-4">
						<div class="card">
							<div class="card-header">
								Directors Infor
								<span class="fa fa-users"></span>
								<span class="fa fa-warning text-danger pull-right"></span>									
							</div>
							<div class="card-body">
								Information on Director
							</div>
						</div>
					</div>					

					<div class="col-md-4 mt-4">
						<div class="card">
							<div class="card-header">
								Trade references
								<span class="fa fa-list"></span>
								<span class="fa fa-warning text-danger pull-right"></span>									
							</div>
							<div class="card-body">
								Some Trade References
							</div>
						</div>
					</div>

					<div class="col-md-4 mt-4">
						<div class="card">
							<div class="card-header">
								Company Profile
								<span class="fa fa-upload"></span>
								<span class="fa fa-warning text-danger pull-right"></span>									
							</div>
							<div class="card-body">
								Upload Company Profile Doc
							</div>
						</div>
					</div>

				</div>
@endsection