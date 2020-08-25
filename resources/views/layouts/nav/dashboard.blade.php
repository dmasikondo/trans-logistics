<div class="d-flex" id="wrapper">
		<!--sidebar -->
		<div class="bg-light border-right" id="sidebar-wrapper">
			<div class="sidebar-heading">{{strtok($user->organisation,' ')}} Dashboard</div>
			<div class="list-group list-group-flush">
				<a href="#" class="list-group-item list-group-item-action bg-light"><i class="fa fa-home"></i> Users</a>
				<a href="#" class="list-group-item list-group-item-action bg-light">Registration</a>
				<a href="#" class="list-group-item list-group-item-action bg-light">Available Loads</a>
				<a href="#" class="list-group-item list-group-item-action bg-light">Available Trucks</a>
				<a href="#" class="list-group-item list-group-item-action bg-light">Freight Forwarding</a>
				<a href="#" class="list-group-item list-group-item-action bg-light">Warehousing</a>
				<a href="#" class="list-group-item list-group-item-action bg-light">Transport Consultancy</a>
				<a href="#" class="list-group-item list-group-item-action bg-light">Insurance</a>
				<a href="#" class="list-group-item list-group-item-action bg-light">Vehicle Tracking</a>
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
				@yield('dashboard_content')
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