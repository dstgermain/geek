<?php $thumb_id = get_post_thumbnail_id();
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
	$thumb_url = $thumb_url_array[0]; ?>
<article <?php post_class(); ?>>
	<div class="single margin-top_60">
		<header class="margin-bottom_15">
			<?php if ($thumb_url) {
				echo "<div class=\"thumb margin-bottom_15\"><img src=\"" . $thumb_url . "\" class=\"img-responsive\"/></div>";
			}?>
			<h2 class="entry-title margin_0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php get_template_part('templates/entry-meta'); ?>
		</header>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>
