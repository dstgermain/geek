<?php
/*
Template Name: Team Template
*/
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'team'); ?>
<?php endwhile; ?>
