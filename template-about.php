<?php
/*
Template Name: About Template
*/
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'about'); ?>
<?php endwhile; ?>
