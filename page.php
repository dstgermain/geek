<?php while (have_posts()) : the_post(); ?>
	<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 single-post margin-bottom_30">
		<?php get_template_part('templates/page', 'header'); ?>
		<?php get_template_part('templates/content', 'page'); ?>
	</div>
<?php endwhile; ?>
