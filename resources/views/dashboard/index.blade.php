@extends('layouts.app')
<style>
/*	.wrapper{
		display: block;
	}
	#sidebar{
		min-width: 250px;
		max-width: 250px;
		height: 100vh;
		position: fixed;
		top: 0;
		left: 0;
		/* top layer */
/*		z-index:9999;
	}
	.overlay{
		display:none;
		position: fixed;
		/* full screen*/
/*		width: 100vw;
		height: vh;
		/*transparent black */
/*		background: rgba(0,0,0,0.7);
		/*middle layer, i.e. appear below */
/*		z-index: 998;
		opacity: 0;
		/* animate the transition */
/*		transition: all 0.5s ease-in-out;
	}
	/* display .overlay when it has the .active class */
/*	.overlay.active{
		display: block;
		opacity: 1;
	}
	#dismiss{
		width: 35px;
		height: 35px
		position: absolute;
		/*top right corner of the sidebar */
/*		top: 10px;
		right: 10px;
	}*/

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
@section('content')
	<div class="d-flex" id="wrapper">
		<!--sidebar -->
		<div class="bg-light border-right" id="sidebar-wrapper">
			<div class="sidebar-heading">Start Bootstrap</div>
			<div class="list-group list-group-flush">
				<a href="#" class="list-group-item list-group-item-action bg-light"><i class="fa fa-home"></i> Dashboard</a>
				<a href="#" class="list-group-item list-group-item-action bg-light">Shortcuts</a>
				<a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>
				<a href="#" class="list-group-item list-group-item-action bg-light">Events</a>
				<a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
			</div>
		</div>

		<!--#sidebar wrapper -->

		<!-- Page Content -->
		<div id="page-content-wrapper">
			<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
				<button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
						<li class="nav-item active">
							<a href="#" class="nav-link"><span class="sr-only">(current)</span>One</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">TWo</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">Three</a>
						</li>
						<li class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a href="" class="dropdown-item">Action</a>
								<a href="" class="dropdown-item">Another Action </a>
								<div class="dropdown-divider"></div>
								<a href="#" class="dropdown-item">Something else here</a>
							</div>
						</li>

					</ul>
				</div>
			</nav>

			<div class="container-fluid">
				<h1>Lorem ipsum.</h1>
				<p>Lorem ipsum dolor.</p>
				<p>Illo perspiciatis, consequatur.</p>
			</div>
		</div>
			<!-- page content wrapper-->
	</div>
		<!-- #wrapper -->
		<script>
			$('#menu-toggle').click(function(e){
				e.preventDefault();
				$('#wrapper').toggleClass('toggled');
			})
		</script>
@endsection