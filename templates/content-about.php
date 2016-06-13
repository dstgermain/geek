<div class="container-fluid about margin-bottom_30 margin-top_60">
	<div class="row">
		<div class="col-sm-7">
			<img src="<?php the_cfc_field( 'about_image', 'about-image' ); ?>" class= "img-responsive margin-bottom_30" />
			<div class="video-wrapper">
				<?php the_cfc_field( 'about_video', 'about-video' ); ?>
			</div>
		</div>
		<div class="col-sm-5">
			<?php the_content(); ?>
		</div>
	</div>
</div>

