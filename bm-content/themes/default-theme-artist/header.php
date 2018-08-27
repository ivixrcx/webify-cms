
<!DOCTYPE html>
<html class="js" lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>
	<title>Artist</title>
	<link rel="dns-prefetch" href="//fonts.googleapis.com">
	<link rel="dns-prefetch" href="//s.w.org">
	<script src="<?php echo INCLUDES ?>js/wp-emoji-release.min.js?ver=4.9.6" type="text/javascript" defer=""></script>
	<style type="text/css">
		img.wp-smiley,
		img.emoji {
			display: inline !important;
			border: none !important;
			box-shadow: none !important;
			height: 1em !important;
			width: 1em !important;
			margin: 0 .07em !important;
			vertical-align: -0.1em !important;
			background: none !important;
			padding: 0 !important;
		}
	</style>
    <link rel="stylesheet" id="parent-style-css" href="<?php echo BASE_URL_THEME ?>style.css?ver=4.9.6" type="text/css" media="all">
	<link rel="stylesheet" id="parent-style-css" href="<?php echo INCLUDES ?>css/twentysixteen-style.css?ver=4.9.6" type="text/css" media="all">
	<link rel="stylesheet" id="twentysixteen-fonts-css" href="https://fonts.googleapis.com/css?family=Merriweather%3A400%2C700%2C900%2C400italic%2C700italic%2C900italic%7CMontserrat%3A400%2C700%7CInconsolata%3A400&amp;subset=latin%2Clatin-ext" type="text/css" media="all">
	<link rel="stylesheet" id="genericons-css" href="<?php echo INCLUDES ?>genericons/genericons.css?ver=3.4.1" type="text/css" media="all">
	<link rel="stylesheet" id="twentysixteen-style-css" href="<?php echo INCLUDES ?>css/2016-child-simple-clean-design-style.css?ver=4.9.6" type="text/css" media="all">
	<!--[if lt IE 10]>
	<link rel='stylesheet' id='twentysixteen-ie-css'  href='<?php echo INCLUDES ?>css/twentysixteen-ie.css?ver=20160816' type='text/css' media='all' />
	<![endif]-->
	<!--[if lt IE 9]>
	<link rel='stylesheet' id='twentysixteen-ie8-css'  href='<?php echo INCLUDES ?>css/twentysixteen-ie8.css?ver=20160816' type='text/css' media='all' />
	<![endif]-->
	<!--[if lt IE 8]>
	<link rel='stylesheet' id='twentysixteen-ie7-css'  href='<?php echo INCLUDES ?>css/twentysixteen-ie7.css?ver=20160816' type='text/css' media='all' />
	<![endif]-->
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
	<!--[if lt IE 9]>
	<script type='text/javascript' src='<?php echo INCLUDES ?>js/twentysixteen-html5.js?ver=3.7.3'></script>
	<![endif]-->
	<link rel="canonical" href="https://heidilulu.com/">
	<link rel="shortlink" href="https://heidilulu.com/">
	<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
	<link rel="icon" href="<?php echo INCLUDES ?>images/cropped-favicon-32x32.png" sizes="32x32">
	<link rel="icon" href="<?php echo INCLUDES ?>images/cropped-favicon-192x192.png" sizes="192x192">
	<link rel="apple-touch-icon-precomposed" href="<?php echo INCLUDES ?>images/cropped-favicon-180x180.png">
	<meta name="msapplication-TileImage" content="<?php echo INCLUDES ?>images/cropped-favicon-270x270.png">
	<script>
		jQuery(document).ready(function($) {
		    var ResponsiveMenu = {
		        trigger: '#responsive-menu-button',
		        animationSpeed: 500,
		        breakpoint: 767,
		        pushButton: 'off',
		        animationType: 'slide',
		        animationSide: 'left',
		        pageWrapper: '',
		        isOpen: false,
		        triggerTypes: 'click',
		        activeClass: 'is-active',
		        container: '#responsive-menu-container',
		        openClass: 'responsive-menu-open',
		        accordion: 'off',
		        activeArrow: '▲',
		        inactiveArrow: '▼',
		        wrapper: '#responsive-menu-wrapper',
		        closeOnBodyClick: 'off',
		        closeOnLinkClick: 'off',
		        itemTriggerSubMenu: 'off',
		        linkElement: '.responsive-menu-item-link',
		        subMenuTransitionTime: 200,
		        openMenu: function() {
		            $(this.trigger).addClass(this.activeClass);
		            $('html').addClass(this.openClass);
		            $('.responsive-menu-button-icon-active').hide();
		            $('.responsive-menu-button-icon-inactive').show();
		            this.setButtonTextOpen();
		            this.setWrapperTranslate();
		            this.isOpen = true;
		        },
		        closeMenu: function() {
		            $(this.trigger).removeClass(this.activeClass);
		            $('html').removeClass(this.openClass);
		            $('.responsive-menu-button-icon-inactive').hide();
		            $('.responsive-menu-button-icon-active').show();
		            this.setButtonText();
		            this.clearWrapperTranslate();
		            this.isOpen = false;
		        },
		        setButtonText: function() {
		            if($('.responsive-menu-button-text-open').length > 0 && $('.responsive-menu-button-text').length > 0) {
		                $('.responsive-menu-button-text-open').hide();
		                $('.responsive-menu-button-text').show();
		            }
		        },
		        setButtonTextOpen: function() {
		            if($('.responsive-menu-button-text').length > 0 && $('.responsive-menu-button-text-open').length > 0) {
		                $('.responsive-menu-button-text').hide();
		                $('.responsive-menu-button-text-open').show();
		            }
		        },
		        triggerMenu: function() {
		            this.isOpen ? this.closeMenu() : this.openMenu();
		        },
		        triggerSubArrow: function(subarrow) {
		            var sub_menu = $(subarrow).parent().siblings('.responsive-menu-submenu');
		            var self = this;
		            if(this.accordion == 'on') {
		                /* Get Top Most Parent and the siblings */
		                var top_siblings = sub_menu.parents('.responsive-menu-item-has-children').last().siblings('.responsive-menu-item-has-children');
		                var first_siblings = sub_menu.parents('.responsive-menu-item-has-children').first().siblings('.responsive-menu-item-has-children');
		                /* Close up just the top level parents to key the rest as it was */
		                top_siblings.children('.responsive-menu-submenu').slideUp(self.subMenuTransitionTime, 'linear').removeClass('responsive-menu-submenu-open');
		                /* Set each parent arrow to inactive */
		                top_siblings.each(function() {
		                    $(this).find('.responsive-menu-subarrow').first().html(self.inactiveArrow);
		                    $(this).find('.responsive-menu-subarrow').first().removeClass('responsive-menu-subarrow-active');
		                });
		                /* Now Repeat for the current item siblings */
		                first_siblings.children('.responsive-menu-submenu').slideUp(self.subMenuTransitionTime, 'linear').removeClass('responsive-menu-submenu-open');
		                first_siblings.each(function() {
		                    $(this).find('.responsive-menu-subarrow').first().html(self.inactiveArrow);
		                    $(this).find('.responsive-menu-subarrow').first().removeClass('responsive-menu-subarrow-active');
		                });
		            }
		            if(sub_menu.hasClass('responsive-menu-submenu-open')) {
		                sub_menu.slideUp(self.subMenuTransitionTime, 'linear').removeClass('responsive-menu-submenu-open');
		                $(subarrow).html(this.inactiveArrow);
		                $(subarrow).removeClass('responsive-menu-subarrow-active');
		            } else {
		                sub_menu.slideDown(self.subMenuTransitionTime, 'linear').addClass('responsive-menu-submenu-open');
		                $(subarrow).html(this.activeArrow);
		                $(subarrow).addClass('responsive-menu-subarrow-active');
		            }
		        },
		        menuHeight: function() {
		            return $(this.container).height();
		        },
		        menuWidth: function() {
		            return $(this.container).width();
		        },
		        wrapperHeight: function() {
		            return $(this.wrapper).height();
		        },
		        setWrapperTranslate: function() {
		            switch(this.animationSide) {
		                case 'left':
		                    translate = 'translateX(' + this.menuWidth() + 'px)'; break;
		                case 'right':
		                    translate = 'translateX(-' + this.menuWidth() + 'px)'; break;
		                case 'top':
		                    translate = 'translateY(' + this.wrapperHeight() + 'px)'; break;
		                case 'bottom':
		                    translate = 'translateY(-' + this.menuHeight() + 'px)'; break;
		            }
		            if(this.animationType == 'push') {
		                $(this.pageWrapper).css({'transform':translate});
		                $('html, body').css('overflow-x', 'hidden');
		            }
		            if(this.pushButton == 'on') {
		                $('#responsive-menu-button').css({'transform':translate});
		            }
		        },
		        clearWrapperTranslate: function() {
		            var self = this;
		            if(this.animationType == 'push') {
		                $(this.pageWrapper).css({'transform':''});
		                setTimeout(function() {
		                    $('html, body').css('overflow-x', '');
		                }, self.animationSpeed);
		            }
		            if(this.pushButton == 'on') {
		                $('#responsive-menu-button').css({'transform':''});
		            }
		        },
		        init: function() {
		            var self = this;
		            $(this.trigger).on(this.triggerTypes, function(e){
		                e.stopPropagation();
		                self.triggerMenu();
		            });
		            $(this.trigger).mouseup(function(){
		                $(self.trigger).blur();
		            });
		            $('.responsive-menu-subarrow').on('click', function(e) {
		                e.preventDefault();
		                e.stopPropagation();
		                self.triggerSubArrow(this);
		            });
		            $(window).resize(function() {
		                if($(window).width() > self.breakpoint) {
		                    if(self.isOpen){
		                        self.closeMenu();
		                    }
		                } else {
		                    if($('.responsive-menu-open').length>0){
		                        self.setWrapperTranslate();
		                    }
		                }
		            });
		            if(this.closeOnLinkClick == 'on') {
		                $(this.linkElement).on('click', function(e) {
		                    e.preventDefault();
		                    /* Fix for when close menu on parent clicks is on */
		                    if(self.itemTriggerSubMenu == 'on' && $(this).is('.responsive-menu-item-has-children > ' + self.linkElement)) {
		                        return;
		                    }
		                    old_href = $(this).attr('href');
		                    old_target = typeof $(this).attr('target') == 'undefined' ? '_self' : $(this).attr('target');
		                    if(self.isOpen) {
		                        if($(e.target).closest('.responsive-menu-subarrow').length) {
		                            return;
		                        }
		                        self.closeMenu();
		                        setTimeout(function() {
		                            window.open(old_href, old_target);
		                        }, self.animationSpeed);
		                    }
		                });
		            }
		            if(this.closeOnBodyClick == 'on') {
		                $(document).on('click', 'body', function(e) {
		                    if(self.isOpen) {
		                        if($(e.target).closest('#responsive-menu-container').length || $(e.target).closest('#responsive-menu-button').length) {
		                            return;
		                        }
		                    }
		                    self.closeMenu();
		                });
		            }
		            if(this.itemTriggerSubMenu == 'on') {
		                $('.responsive-menu-item-has-children > ' + this.linkElement).on('click', function(e) {
		                    e.preventDefault();
		                    self.triggerSubArrow($(this).children('.responsive-menu-subarrow').first());
		                });
		            }
		        }
		    };
		    ResponsiveMenu.init();
		});
	</script>	
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

	<script>
		function openCity(evt, cityName) {
			var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");
			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}
			tablinks = document.getElementsByClassName("tablinks");
			for (i = 0; i < tablinks.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" active", "");
			}
			document.getElementById(cityName).style.display = "block";
			evt.currentTarget.className += " active";
		}
	</script>
</head>

<body class="home page-template page-template-template-home page-template-template-home-php page page-id-2 responsive-menu-slide-left">
	<div id="my-header">
		<div class="my-container">
			<div class="logo-cont">
				<a href="#"><img src="<?php echo INCLUDES ?>images/artist-logo.png"></a>
			</div>
			<div class="menu-cont">
				<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Primary Menu">
					<div class="menu-primay-menu-container">
					<ul id="menu-primary-menu" class="primary-menu">
					    <?php foreach($menus as $menu): ?>
					    <li class="menu-item menu-item-type-post_type menu-item-object-page">
					        <a href="<?php echo BASE_URL . $menu->page?>" target="<?php echo $menu->target?>">
					            <span class="<?php echo $menu->icon?>" >&nbsp;&nbsp;</span><?php echo $menu->text ?>
					        </a>
					    </li>
					    <?php endforeach; ?>
					</ul>
					</div>
				</nav>
			</div>
			<div class="clear"></div>
		</div>
	</div>		
	
	<div id="content" class="site-content">

