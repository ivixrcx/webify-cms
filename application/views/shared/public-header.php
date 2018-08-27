<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<base href="<?php echo base_url() ?>"/>
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title><?php if(isset($title)) echo $title ?></title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Lato:700|Ubuntu:400,500" rel="stylesheet">

		<!-- Bootstrap -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="assets/css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>

		<!-- Header -->
		<header id="header">
			<div class="container">

				<div class="navbar-header">
					<!-- Logo -->
					<div class="navbar-brand">
						<a class="logo" href="index.html">
							<img src="<?php echo $settings[0]->Logo ?>" alt="logo">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Mobile toggle -->
					<button class="navbar-toggle">
						<span></span>
					</button>
					<!-- /Mobile toggle -->
				</div>

				<!-- Navigation -->
				<nav id="nav">
					<ul class="main-menu nav navbar-nav navbar-right">
					<?php foreach($menus as $menu){ ?>
						<li><a href="<?php echo $menu->page?>" target="<?php echo $menu->target?>"><span class="<?php echo $menu->icon?>" >&nbsp;&nbsp;</span><?php echo $menu->text?></a></li>

					<?php } ?>
					</ul>
				</nav>
				<!-- /Navigation -->

			</div>
		</header>
