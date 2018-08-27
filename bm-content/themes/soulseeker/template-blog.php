
<div id="about-sec1">
	<div class="my-container">
		<div class="cont-right">
			<h2>BLOG</h2>
		</div>	
	</div>
</div><!--- #hp-sec1 -->

<div id="blog-sec">
	<div class="my-container">
		<article>
			<?php foreach($blogs as $blog): ?>
			<div class="blog-wrapper">
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
</div>

<div id="hp-sec4">
	<div class="my-container">
		<h2>newsletter signup</h2>
		<div role="form" class="wpcf7" id="wpcf7-f30-o1" dir="ltr" lang="en-US">
            <div class="screen-reader-response"></div>
            <form action="http://localhost/vpsvonarron.com/jezreel/#wpcf7-f30-o1" method="post" class="wpcf7-form" novalidate="novalidate">
                <div style="display: none;">
                    <input name="_wpcf7" value="30" type="hidden">
                    <input name="_wpcf7_version" value="5.0.2" type="hidden">
                    <input name="_wpcf7_locale" value="en_US" type="hidden">
                    <input name="_wpcf7_unit_tag" value="wpcf7-f30-o1" type="hidden">
                    <input name="_wpcf7_container_post" value="0" type="hidden">
                </div>
                <div class="form-all">
                    <div class="cont-input">
                        <span class="wpcf7-form-control-wrap Enteryouremail"><input name="Enteryouremail" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-email" aria-invalid="false" placeholder="Enter your email" type="email"></span><input value="Subscribe" class="wpcf7-form-control wpcf7-submit" type="submit"><span class="ajax-loader"></span>
                    </div>
                </div>
                <div class="wpcf7-response-output wpcf7-display-none"></div>
            </form>
        </div>	
    </div>
</div>