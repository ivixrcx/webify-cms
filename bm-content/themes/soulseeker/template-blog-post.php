<div id="content" class="site-content">
	<div id="about-sec1">
		<div class="my-container">
			<div class="cont-right">
				<h2>Blog</h2>
			</div>	
		</div>
	</div>
	<div class="my-container" style="padding-top: 60px;width: 90%">
		<main id="main " class="site-main" role="main">
			<article>
				<header class="entry-header">
					<h1 class="entry-title"><?php echo $blog->Title?></h1>	
				</header><!-- .entry-header -->

				<div class="post-thumbnail">
					<img src="<?php echo MEDIA . $blog->Image ?>" style="width: 100%" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" srcset="<?php echo MEDIA . $blog->Image ?> 1024w, <?php echo MEDIA . $blog->Image ?> 300w, <?php echo MEDIA . $blog->Image ?> 768w" sizes="(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 80vw, (max-width: 1362px) 62vw, 840px">	
				</div><!-- .post-thumbnail -->

				<div class="">
					<?php echo $blog->Content ?>	
				</div><!-- .entry-content -->
			</article><!-- #post-## -->
		</main>
	</div>
</div>