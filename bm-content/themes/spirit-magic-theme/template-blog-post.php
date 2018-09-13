<body>
<div id="inner-page-heading" class="about-sec">
	<div class="my-container">
		<h2 data-aos="fade-right">Blog</h2>
	</div>
</div>

<div id="blog-sec" class="row-sec">
	<div class="my-container">
		<div id="pramary">
			<article>
				<div class="blog-wrapper single" data-aos="fade-up">
					<h2><?php echo $blog->Title ?></h2>
					<div class="blog-ft-img">
						<a href="#">
							<img src="<?php echo MEDIA . $blog->Image ?>"/>
						</a>
					</div>

					<div class="blog-content">
						<p><?php echo $blog->Content ?></p>
					</div>
					<div class="clear"></div>
				</div>
			</article>
		</div>

		<div id="secondary">
			<h2>Featured Blogs</h2>
			<?php
			$blogs = array_slice($blogs, 0, 3);
			foreach($blogs as $blog): ?>
				<a href="<?php echo BASE_URL_BLOG . $blog->Url ?>" style="color: #000">
					<div class="col-wrap" data-aos="fade-left">
						<img src="<?php echo MEDIA . $blog->Image ?>"/>
						<span><?php echo $blog->Title ?></span>
					</div>
				</a>
			<?php endforeach; ?>
		</div>

		<div class="clear"></div>
	</div>
</div>
