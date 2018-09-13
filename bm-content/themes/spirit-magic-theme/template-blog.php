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
				<?php foreach($blogs as $blog): ?>
				<div class="blog-wrapper" data-aos="fade-right">
					<div class="blog-ft-img">
						<a href="<?php echo BASE_URL_BLOG . $blog->Url ?>">
							<img src="<?php echo MEDIA . $blog->Image ?>"/>
						</a>
					</div>

					<div class="blog-content">
						<h2><a href="<?php echo BASE_URL_BLOG . $blog->Url ?>" title="Read more"><?php echo $blog->Title ?></a></h2>
						<p><?php echo $blog->Description ?></p>
						<a class="blog-btn" href="<?php echo BASE_URL_BLOG . $blog->Url ?>">READ MORE</a>

					</div>
					<div class="clear"></div>
				</div>
				<?php endforeach; ?>
			</article>
		</div>

		<div id="secondary">
			<h2>Featured Blogs</h2>
			<?php
			$blogs = array_slice($blogs, 0, 3);
			foreach($blogs as $blog): ?>
			<a href="<?php echo BASE_URL_BLOG . $blog->Url ?>" style="color: #000">
				<div class="col-wrap" data-aos="fade-up">
					<img src="<?php echo MEDIA . $blog->Image ?>"/>
					<span><?php echo $blog->Title ?></span>
				</div>
			</a>
			<?php endforeach; ?>

		</div>
		<div class="clear"></div>
	</div>
</div>
