<?php
  // this is for manually placing posts in the correct order :: now using the ajax loader below

  // $all_posts = array();
  
  //   while (have_posts()) { 
  //     the_post();
  //     ob_start();
  //       get_template_part('templates/content', get_post_format());
  //       $all_posts[] = ob_get_contents();
  //     ob_end_clean();
  //   }
?>
<div id="posts-content" class="margin-bottom_30">
  <?php if (!have_posts()) : ?>
    <div class="alert alert-warning">
      <?php _e('Sorry, no results were found.', 'roots'); ?>
    </div>
    <?php get_search_form(); ?>
  <?php endif; ?>
  <div id="grid" class="clearfix" data-columns>
    <div data-column-id="1" class="column size-1of3"></div>
    <div data-column-id="2" class="column size-1of3"></div>
    <div data-column-id="3" class="column size-1of3"></div>
  </div>
</div>
<div id="loadMore"></div>
<script>
// Author: Daniel St. Germain
// Email: info@danstgermain.com
// Last Edited: 10/15/14
// Description: infinte scroll using JSON API Plugin
// !!! Please do not copy !!! - if you want info contact me.

(function iify(){
  'use strict';
  var loading = false;
  var content_loaded = false;
  var page = 1;
  function runAjax() {
    $('#grid').addClass('loading');
    loading = true;
    $.ajax({
        url: '/api/get_posts?page=' + page,
        cache: false
      }).done(function(data) {
        data.posts.forEach(function(post){
          console.log(post);
          var grid = document.querySelector('#grid');
          var item = document.createElement('article');
          var a = document.createElement('a');
          a.setAttribute("href", post.url);

          salvattore['append_elements'](grid, [item]);
          var html = '';
          html += '<div class="single">';
          html += '<header class="margin-bottom_15">';
          if (post.thumbnail_images && post.thumbnail_images.medium) {
            html += '<div class="thumb margin-bottom_15"><img src="' + post.thumbnail_images.medium.url + '" class="img-responsive"/></div>';
          }

          html += '<h2 class="entry-title margin_0"><a href="' + post.slug + '">' + post.title + '</a></h2>';
          html += '</header>';
          html += '<div class="entry-summary">';
          html += post.excerpt;
          html += '</div>';
          html += '</div>';
          a.innerHTML = html;
          item.appendChild(a);
        });
      if (page === data.pages) {
        content_loaded = true;
        $('#grid').addClass('end-of-the-rad');
      }
      page++;
      $('#grid').removeClass('loading');
      loading = false;
    }).error(function(){
      $('#grid').removeClass('loading');
      loading = false;
    });
  }
  runAjax();
  $(window).scroll(function(){
    if (!loading && $('#loadMore').visible()) {
      if (!content_loaded) {
      runAjax();
    }
  }
  });
})();
</script>
