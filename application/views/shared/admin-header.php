<!doctype html>
<html lang="en">

<head>
	<title>Dashboard</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<base href="<?php echo base_url() ?>">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="filemanager/files/<?php echo $settings->Favicon ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="filemanager/files/<?php echo $settings->Favicon ?>">

	<!-- JQUERY 2.2.4 -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>

	<!-- SWEET ALERT -->
	<link rel="stylesheet" href="assets/vendor/sweet-alert/sweetalert.css">
	<script type="text/javascript" src="assets/vendor/sweet-alert/sweetalert.min.js"></script>

	<!-- NOTIFY -->
	<link rel="stylesheet" href="assets/vendor/noty/noty.css">
	<script type="text/javascript" src="assets/vendor/noty/noty.min.js"></script>

	<!-- TINYMCE -->
  	<script src="assets/vendor/tinymce/tinymce.min.js"></script>

  	<!-- TAGGING JS -->
	<script src="assets/vendor/tagging.js"></script>

	<!-- ICON PICKER -->
	<link rel="stylesheet" type="text/css" href="assets/vendor/icon-picker/css/bootstrap-iconpicker.css">


</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="navbar-brand">
				<div class="logo" style="background-image: url(filemanager/files/<?php echo $settings->Logo ?>)">
					<!-- <img src="<?php echo $settings->Logo ?>" alt="logo" style="margin-top: -3px;max-width: 185px;"> -->
				</div>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<div class="navbar-form navbar-left">
					<span class="col-md-12" style="font-size: 1.3em"><?php echo isset($action) ? $action : ''?>&nbsp;&nbsp;<?php echo isset($button) ? $button : ''?><span id="status"></span></span>
				</div>
				<div class="navbar-btn navbar-right">
					<a href="<?php echo base_url()?>" style="padding:0 20px">View Site</a>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="my/blog" data-name="blogs" class="nav-menu"><i class="lnr lnr-layers"></i> <span>Blogs</span></a></li>
						<li><a href="my/page" data-name="pages" class="nav-menu"><i class="lnr lnr-file-empty"></i> <span>Pages</span></a></li>
						<li><a href="my/menu" data-name="menu" class="nav-menu"><i class="lnr lnr-menu"></i> <span>Menu</span></a></li>
						<li><a href="my/filemanager" data-name="filemanager" class="nav-menu"><i class="lnr lnr-inbox"></i> <span>File Manager</span></a></li>
						<!-- <li><a href="my/profile" data-name="profile" class="nav-menu"><i class="lnr lnr-user"></i> <span>Profile</span></a></li> -->
						<li><a href="my/themes" data-name="theme" class="nav-menu"><i class="lnr lnr-license"></i> <span>Themes</span></a></li>
						<li><a href="my/settings" data-name="settings" class="nav-menu"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
						<li><a href="logout" class=""><i class="lnr lnr-power-switch"></i> <span>Logout</span></a></li>

						<script type="text/javascript">
							$('.nav-menu').removeClass('active')
							$('.nav-menu').each(function(){
								if($(this).data('name') === '<?php echo $navigation?>'){
									$(this).addClass('active')
								}
							})

							$('.nav-menu').click(function(){
								$('.nav-menu').removeClass('active')
								$(this).addClass('active')
							})
						</script>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
