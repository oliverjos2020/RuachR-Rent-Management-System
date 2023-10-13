<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.ansonika.com/foogra/admin_section/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 22 Jul 2023 07:14:43 GMT -->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Ansonika">
	<title>FOOGRA - Admin dashboard</title>
	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
		href="img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
		href="img/apple-touch-icon-144x144-precomposed.png">
	<!-- Bootstrap core CSS-->
	<link href="{{asset('admin_section/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
	<!-- Main styles -->
	<link href="{{asset('admin_section/css/admin.css')}}" rel="stylesheet">
	<!-- Icon fonts-->
	<link href="{{asset('admin_section/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
	<!-- Plugin styles -->
	<link href="{{asset('admin_section/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
	<!-- Your custom styles -->
	<link href="{{asset('admin_section/css/custom.css')}}" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer" id="page-top">
	<!-- Navigation-->
	<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
		<a class="navbar-brand" href="/dashboard"><img src="{{asset('images/logo-inverse.png')}}" width="30" height="36"></a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
			data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
					<a class="nav-link" href="/dashboard">
						<i class="fa fa-fw fa-dashboard"></i>
						<span class="nav-link-text">Dashboard</span>
					</a>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Messages">
					<a class="nav-link" href="/dashboard/users">
						<i class="fa fa-fw fa-users"></i>
						<span class="nav-link-text">Users</span>
					</a>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Authorization">
					<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#authorization">
						<i class="fa fa-fw fa-list"></i>
						<span class="nav-link-text">Authorization</span>
					</a>
					<ul class="sidenav-second-level collapse" id="authorization">
						<li>
							<a href="/dashboard/roles">Roles</a>
						</li>
						
					</ul>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Categories">
					<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#category">
						<i class="fa fa-fw fa-list"></i>
						<span class="nav-link-text">Category</span>
					</a>
					<ul class="sidenav-second-level collapse" id="category">
						<li>
							<a href="/dashboard/category">Manage Categories</a>
						</li>
				
					</ul>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="property">
					<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#property">
						<i class="fa fa-fw fa-list"></i>
						<span class="nav-link-text">Properties</span>
					</a>
					<ul class="sidenav-second-level collapse" id="property">
						<li>
							<a href="/dashboard/create-property">Create Property</a>
						</li>
						<li>
							<a href="/dashboard/manage-property">Manage Properties</a>
						</li>
				
					</ul>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Location">
					<a class="nav-link" href="/dashboard/location">
						<i class="fa fa-fw fa-users"></i>
						<span class="nav-link-text">Location</span>
					</a>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title=""
					data-original-title="Bookings">
					<a class="nav-link" href="bookings.html">
						<i class="fa fa-fw fa-calendar-check-o"></i>
						<span class="nav-link-text">Bookings <span class="badge badge-pill badge-primary">6
								New</span></span>
					</a>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
					<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMylistings">
						<i class="fa fa-fw fa-list"></i>
						<span class="nav-link-text">My listings</span>
					</a>
					<ul class="sidenav-second-level collapse" id="collapseMylistings">
						<li>
							<a href="listings.html">Pending <span class="badge badge-pill badge-primary">6</span></a>
						</li>
						<li>
							<a href="listings.html">Active <span class="badge badge-pill badge-success">6</span></a>
						</li>
						<li>
							<a href="listings.html">Expired <span class="badge badge-pill badge-danger">6</span></a>
						</li>
					</ul>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reviews">
					<a class="nav-link" href="reviews.html">
						<i class="fa fa-fw fa-star"></i>
						<span class="nav-link-text">Reviews</span>
					</a>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Bookmarks">
					<a class="nav-link" href="bookmarks.html">
						<i class="fa fa-fw fa-heart"></i>
						<span class="nav-link-text">Bookmarks</span>
					</a>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add listing">
					<a class="nav-link" href="add-listing.html">
						<i class="fa fa-fw fa-plus-circle"></i>
						<span class="nav-link-text">Add listing</span>
					</a>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add listing + Menu List">
					<a class="nav-link" href="add-listing-with-menu-list.html">
						<i class="fa fa-fw fa-plus-circle"></i>
						<span class="nav-link-text">Add listing + Menu List</span>
					</a>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Orders Page">
					<a class="nav-link" href="orders.html">
						<i class="fa fa-fw fa-shopping-basket"></i>
						<span class="nav-link-text">Orders Page</span>
					</a>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Edit Order">
					<a class="nav-link" href="orders.html">
						<i class="fa fa-fw fa-pencil"></i>
						<span class="nav-link-text">Edit Order</span>
					</a>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
					<a class="nav-link" href="user-profile.html">
						<i class="fa fa-fw fa-user"></i>
						<span class="nav-link-text">My Profile</span>
					</a>
				</li>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
					<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents">
						<i class="fa fa-fw fa-gear"></i>
						<span class="nav-link-text">Components</span>
					</a>
					<ul class="sidenav-second-level collapse" id="collapseComponents">
						<li>
							<a href="charts.html">Charts</a>
						</li>
						<li>
							<a href="tables.html">Tables</a>
						</li>
					</ul>
				</li>
			</ul>
			<ul class="navbar-nav sidenav-toggler">
				<li class="nav-item">
					<a class="nav-link text-center" id="sidenavToggler">
						<i class="fa fa-fw fa-angle-left"></i>
					</a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-fw fa-envelope"></i>
						<span class="d-lg-none">Messages
							<span class="badge badge-pill badge-primary">12 New</span>
						</span>
						<span class="indicator text-primary d-none d-lg-block">
							<i class="fa fa-fw fa-circle"></i>
						</span>
					</a>
					<div class="dropdown-menu" aria-labelledby="messagesDropdown">
						<h6 class="dropdown-header">New Messages:</h6>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">
							<strong>David Miller</strong>
							<span class="small float-right text-muted">11:21 AM</span>
							<div class="dropdown-message small">Hey there! This new version of SB Admin is pretty
								awesome! These messages clip off when they reach the end of the box so they don't
								overflow over to the sides!</div>
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">
							<strong>Jane Smith</strong>
							<span class="small float-right text-muted">11:21 AM</span>
							<div class="dropdown-message small">I was wondering if you could meet for an appointment at
								3:00 instead of 4:00. Thanks!</div>
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">
							<strong>John Doe</strong>
							<span class="small float-right text-muted">11:21 AM</span>
							<div class="dropdown-message small">I've sent the final files over to you for review. When
								you're able to sign off of them let me know and we can discuss distribution.</div>
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item small" href="#">View all messages</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-fw fa-bell"></i>
						<span class="d-lg-none">Alerts
							<span class="badge badge-pill badge-warning">6 New</span>
						</span>
						<span class="indicator text-warning d-none d-lg-block">
							<i class="fa fa-fw fa-circle"></i>
						</span>
					</a>
					<div class="dropdown-menu" aria-labelledby="alertsDropdown">
						<h6 class="dropdown-header">New Alerts:</h6>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">
							<span class="text-success">
								<strong>
									<i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
							</span>
							<span class="small float-right text-muted">11:21 AM</span>
							<div class="dropdown-message small">This is an automated server response message. All
								systems are online.</div>
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">
							<span class="text-danger">
								<strong>
									<i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
							</span>
							<span class="small float-right text-muted">11:21 AM</span>
							<div class="dropdown-message small">This is an automated server response message. All
								systems are online.</div>
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">
							<span class="text-success">
								<strong>
									<i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
							</span>
							<span class="small float-right text-muted">11:21 AM</span>
							<div class="dropdown-message small">This is an automated server response message. All
								systems are online.</div>
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item small" href="#">View all alerts</a>
					</div>
				</li>
				<li class="nav-item">
					<form class="form-inline my-2 my-lg-0 mr-lg-2">
						<div class="input-group">
							<input class="form-control search-top" type="text" placeholder="Search for...">
							<span class="input-group-btn">
								<button class="btn btn-primary" type="button">
									<i class="fa fa-search"></i>
								</button>
							</span>
						</div>
					</form>
				</li>
				<li class="nav-item">
					{{-- <a class="nav-link" data-toggle="modal" data-target="#exampleModal"><i
							class="fa fa-fw fa-sign-out"></i>Logout</a> --}}
							<form action="/logout" method="POST">
								@csrf
								<button type="submit" class="btn btn-light"><i class="fa fa-fw fa-sign-out"></i> Logout</button>
							</form>
							
				</li>
			</ul>
		</div>
	</nav>
	<!-- /Navigation-->
	@yield('content')
	<!-- /.container-wrapper-->
	<footer class="sticky-footer">
		<div class="container">
			<div class="text-center">
				<small>Copyright © FOOGRA 2021</small>
			</div>
		</div>
	</footer>
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fa fa-angle-up"></i>
	</a>

	<!-- Logout Modal-->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="#0">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="{{asset('admin_section/vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('admin_section/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<!-- Core plugin JavaScript-->
	<script src="{{asset('admin_section/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
	<!-- Page level plugin JavaScript-->
	<script src="{{asset('admin_section/vendor/chart.js/Chart.js')}}"></script>
	<script src="{{asset('admin_section/vendor/datatables/jquery.dataTables.js')}}"></script>
	<script src="{{asset('admin_section/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
	<script src="{{asset('admin_section/vendor/jquery.magnific-popup.min.js')}}"></script>
	<!-- Custom scripts for all pages-->
	<script src="{{asset('admin_section/js/admin.js')}}"></script>
	<!-- Custom scripts for this page-->
	<script src="{{asset('admin_section/js/admin-charts.js')}}"></script>
	<script src="{{asset('admin_section/js/admin-datatables.js')}}"></script>
</body>


<!-- Mirrored from www.ansonika.com/foogra/admin_section/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 22 Jul 2023 07:15:05 GMT -->

</html>