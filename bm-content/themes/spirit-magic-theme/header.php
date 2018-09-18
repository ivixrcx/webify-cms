<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $settings->SiteTitle ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo MEDIA . $settings->Favicon ?>">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo MEDIA . $settings->Favicon ?>">
		<link rel="stylesheet" href="<?php echo BASE_URL_THEME ?>style.css" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Lobster|Lobster+Two:400,400i,700,700i|Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

		<!-- <link rel="stylesheet" href="<?php echo BASE_URL_THEME ?>aos.css" type="text/css">
		<script src="<?php echo INCLUDES ?>js/aos.js"></script>
		<script>
		  AOS.init();
		</script> -->

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="<?php echo INCLUDES ?>js/sticky.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script>
		$("#menu-icon").bind("click", function(e) {
		  var body = $("html");
		  e.preventDefault();
		  if (body.hasClass("nav-open")) {
			body.removeClass("nav-open");
			$("#mobile-nav li.menu-item-has-children > a, .sub-menu").removeClass("open");
		  } else {
			e.stopPropagation();
			body.one("click", function() {
			  body.removeClass("nav-open");
			  $("#mobile-nav, #menu-icon").removeClass("active");
			  $("#mobile-nav li.menu-item-has-children > a, #mobile-nav li.menu-item-has-children > .sub-menu").removeClass("open");
			}).addClass("nav-open");
		  }
		});
		$("#mobile-nav").bind("click", function() {
		  event.stopPropagation();
		});
		$("#menu-icon").on("click", function() {
		  $("#mobile-nav, #menu-icon").toggleClass("active");
		  event.preventDefault();
		});

		$('#mobile-nav li.menu-item-has-children > a').click(function(e){
		  e.preventDefault();
		  $(this).toggleClass('open');
		  $(this).siblings('.sub-menu').toggleClass('open');
		});

		// $('#mobile-nav li.menu-item-has-children > a').one('click', function(event) {
		//     event.preventDefault();
		//     $(this).next('.sub-menu').addClass('open');
		// });
	</script>
</head>

<header class="header" style="background-image: url(images/header-bg.jpg);">

		<div class="my-container">
			<div class="cont-logo">
				<img src="<?php echo INCLUDES ?>images/logo.png">
			</div>
			<div id="menu-icon">
					<a href="#" id="menu-icon"><hr><hr><hr></a>
			</div>
		</div>
		<div class="cont-menu">
			<div class="my-container">
				<ul>
					<?php foreach($menus as $menu): ?>
					<li class="menu-item menu-item-type-post_type menu-item-object-page">
							<a href="<?php echo isset($menu->external_link) && !empty(@$menu->external_link) ? $menu->external_link : BASE_URL . $menu->page ?>" target="<?php echo $menu->target?>">
									<span class="<?php echo $menu->icon?>" >&nbsp;&nbsp;</span><?php echo $menu->text ?>
							</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<div class="clear"></div>
</header>

<div id="mobile-nav">
	   <ul>
				<?php foreach($menus as $menu): ?>
				<li class="menu-item menu-item-type-post_type menu-item-object-page">
						<a href="<?php echo BASE_URL . $menu->page?>" target="<?php echo $menu->target?>">
								<span class="<?php echo $menu->icon?>" >&nbsp;&nbsp;</span><?php echo $menu->text ?>
						</a>
				</li>
				<?php endforeach; ?>
	   </ul>
</div>
