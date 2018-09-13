<body>
<div id="hp-sec1" class="about-sec">
	<div class="my-container">
		<h1 data-aos="fade-right">Spirit Magic - Crystal Academy</h2>
		<span data-aos="fade-left">Lorem Ipsum Dolor</span>
		<a data-aos="fade-up" href="/about/">About Us</a>
	</div>
</div>

<div id="hp-sec2" class="row-sec">
	<div class="my-container">
		<div class="cont-left" data-aos="fade-right">
			<form>
				<input type="text" value="Name">
				<input type="email" value="Email">
				<button>Send</button>
			</form>
		</div>
		<div class="cont-right" data-aos="fade-left">
			<h2>Get it touch now!</h2>
		</div>
		<div class="clear"></div>
	</div>
</div>


<div id="hp-sec3" class="row-sec services">
	<div class="my-container">
		<h2 class="heading-title" data-aos="zoom-in">Our Services</h2>

		<ul class="services-list">
			<li data-aos="fade-up">
				<i class="fas fa-laptop"></i>
				<h2>Computing</h2>
				<p>Morbi vehicula sit amet elit at convallis. Duis ante lorem, dictum vitae nibh sit amet, gravida sagittis erat. Curabitur quis blandit ipsum. Pellentesque purus orci</p>
			</li>

			<li data-aos="fade-up">
				<i class="fas fa-music"></i>
				<h2>Arts & humanities</h2>
				<p>Morbi vehicula sit amet elit at convallis. Duis ante lorem, dictum vitae nibh sit amet, gravida sagittis erat. Curabitur quis blandit ipsum. Pellentesque purus orci</p>
			</li>

			<li data-aos="fade-up">
				<i class="fa fa-money"></i>
				<h2>Economics & finance</h2>
				<p>Morbi vehicula sit amet elit at convallis. Duis ante lorem, dictum vitae nibh sit amet, gravida sagittis erat. Curabitur quis blandit ipsum. Pellentesque purus orci</p>
			</li>
		</ul>
	</div>
</div>

<div id="hp-sec4">
	<div class="my-container">
		<div class="cont-left" data-aos="fade-right">
			<img src="<?php echo INCLUDES?>images/ft-img.jpg">
		</div>
		<div class="cont-right" data-aos="fade-left">
			<h2>About Us</h2>
			<p>Vivamus ultrices, quam quis lacinia consectetur, ipsum mauris cursus mi, in feugiat eros mauris non arcu. Phasellus fringilla, orci et feugiat luctus, ex nisl volutpat libero, ac posuere magna ligula non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus id orci elit. Aenean hendrerit finibus metus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus ultrices tincidunt quam, in laoreet dui ultrices id. Suspendisse potenti. </p>
		</div>
		<div class="clear"></div>
	</div>
</div>

<div id="hp-sec5" class="row-sec blog">
	<div class="my-container">
		<h2 class="heading-title" data-aos="zoom-in">Awesome Articles</h2>
		<ul>
			<?php
			$blogs = array_slice($blogs, 0, 3);
			foreach($blogs as $blog): ?>
			<li data-aos="fade-up">
				<div class="ft-img">
						<a href="<?php echo BASE_URL_BLOG . $blog->Url ?>">
							<img src="<?php echo MEDIA . $blog->Image ?>"/>
						</a>
				</div>
				<div class="blog-content">
					<h2><a href="<?php echo BASE_URL_BLOG . $blog->Url ?>" title="Read more"><?php echo $blog->Title ?></a></h2>
					<!-- <p><?php echo $blog->Description ?></p> -->
					<a class="blog-btn" href="<?php echo BASE_URL_BLOG . $blog->Url ?>">READ MORE</a>

				</div>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
</body>
