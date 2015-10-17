<!DOCTYPE html>
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>
	<meta name="description" content="Aplikasi untuk memetakan cagar budaya yang ada di provinsi Yogyakarta">
	<meta name="author" content="Rais Rahman Ardian">
	<meta name="keyword" content="Cagar Budaya, Warisan Sejarah, Sejarah, Pemetaan, Yogyakarta, Aplikasi">
	<link rel="shortcut icon" href="img/favicon.png">
	<title>Historia | Aplikasi Pemetaan Cagar Budaya Yogyakarta</title>
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet" type="text/css">
	@yield('css-content')
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
</head>
<body class="skin-blue fixed">
	<div class="wrapper">
		<header class="main-header">
			<a href="index2.html" class="logo">
				<span class="logo-mini"><b>Adm</b></span>
				<span class="logo-lg"><b>Administrator</b>Page</span>
			</a>
			<nav class="navbar navbar-static-top" role="navigation">
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">

						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="{{ asset('/assets/img/avatar.png') }}" class="user-image" alt="User Image"/>
								<span class="hidden-xs">
									Rais Rahman Ardian
								</span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header">
									<img src="{{ asset('/assets/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" />
									<p>
										Rais Rahman Ardian
										<small>Administrator</small>
									</p>
								</li>
								<li class="user-footer">
									<div class="pull-left">
										<a href="{{ url('/admin/account') }}" class="btn btn-default btn-flat">Account</a>
									</div>
									<div class="pull-right">
										<a href="{{ url('/auth/logout') }}" class="btn btn-default btn-flat">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<img src="{{ asset('assets/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" />
					</div>
					<div class="pull-left info">
						<p>Rais Rahman Ardian</p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>
				<ul class="sidebar-menu">
					<li class="header">MAIN NAVIGATION</li>
					<li class="active">
						<a href="{{ url('admin/home') }}">
							<i class="fa fa-dashboard"></i> <span>Dashboard</span>
						</a>
					</li>
					<li>
						<a href="{{ url('admin/foto') }}">
							<i class="fa fa-camera"></i> <span>Foto</span>
						</a>
					</li>
					<li>
						<a href="{{ url('admin/video') }}">
							<i class="fa fa-video-camera"></i> <span>Video</span>
						</a>
					</li>
					<li>
						<a href="{{ url('admin/kategori') }}">
							<i class="fa fa-tags"></i> <span>Kategori</span>
						</a>
					</li>
					<li>
						<a href="{{ url('/admin/lokasi') }}">
							<i class="fa fa-map-marker"></i> <span>Data Lokasi</span>
						</a>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-map"></i>
							<span>Peta</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li><a href="{{ url('/admin/peta') }}"><i class="fa fa-angle-double-right"></i> Indeks Data Peta</a></li>
							<li><a href="{{ url('/admin/peta/tambah') }}"><i class="fa fa-angle-double-right"></i> Tambah Data Peta</a></li>
						</ul>
					</li>
				</ul>
			</section>
		</aside>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					@yield('title')
				</h1>
				<ol class="breadcrumb">
					@yield('url-breadcrumb')
				</ol>
			</section>
			<section class="content">
				@yield('content')
			</section>
		</div>
	</div>

	<script src="{{ asset('assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/app.min.js') }}"></script>
	<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootbox.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
	@yield('js-content')
</body>
</html>