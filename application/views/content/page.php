
<?php if($page[0]->Image){ ?>
<div id="home" class="hero-area">
	<!-- Backgound Image -->
	<div class="bg-image bg-parallax overlay" style="background-image:url('<?php echo $page[0]->Image?>')" style="background-size: 100%"></div>
	<!-- /Backgound Image -->
</div>
<?php } ?>

<!-- Page -->
<div id="page" class="section">

	<!-- container -->
	<div class="container">

		<!-- row -->
		<div class="row">

			<!-- main blog -->
			<div id="main" class="col-md-10 col-md-push-1">
				<!-- <h1><?php echo $page[0]->Title ?></h1> -->
				<!-- <div class="row blog-image">
					<div class="col-md-12">
						<img src="<?php echo $page[0]->Image?>" class="img-responsive">
					</div>
				</div> -->
				<!-- article -->
				<article>
					<?php echo $page[0]->Content ?>
				</article>
				<!-- /article -->
			</div>
			<!-- /main blog -->

		</div>
		<!-- row -->

	</div>
	<!-- container -->

</div>
<!-- /Page -->