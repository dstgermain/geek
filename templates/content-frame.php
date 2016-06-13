<?php while (have_posts()) : the_post(); ?>
  <div class="container-fluid margin-bottom_30 margin-top_60">
    <article <?php post_class(); ?>>
      <div class="row">
        <div class="col-sm-7">
          <?php 
            // grab the first image in the array
            $first_image = get_cfc_field('frame_pictures', 'image', false, 0); 
            if (!empty($first_image) && !empty($first_image['sizes']) && !empty($first_image['sizes']['large'])) {
              $image = $first_image['sizes']['large']; ?>
                <div id="main-image" class="gallery-main margin-bottom_30">
                  <img src="<?php echo $image ?>" class="img-responsive"/>
                </div>
              <?php
            }
            // print out the rest of the images
            ?>
            <div id="thumbnails" class="thumbnail-area">
              <div class="row">
              <?php
              $all_images = get_cfc_meta( 'frame_pictures' );
              if (count($all_images) > 1) {
                foreach ($all_images as $key => $value) { 
                  $curr_image = get_cfc_field('frame_pictures', 'image', false, $key);
                  $image_main = $curr_image['sizes']['large'];
                  $image_thumb = $curr_image['sizes']['thumbnail']; ?>
                  <div class="col-md-2 col-sm-3 col-xs-4"><a data-large="<?php echo $image_main; ?>"><img src="<?php echo $image_thumb; ?>" class="img-responsive"/></a></div>
                <?php }
              }
              // if ()
            ?>
            </div>
          </div>
        </div>
        <div class="col-sm-5">
          <header class="clearfix">
            <h1 class="entry-title"><?php the_title(); ?> <i class="frame-icon"><img src="<?php the_cfc_field('frame_icon', 'icon'); ?>" /></i></h1>
            <hr>
          </header>
          <div class="entry-content">
            Specs <em>(Shown Model)</em>
            <table class="table specs-table">
              <tbody>
                <tr>
                  <td><div>Geometry</div></td>
                  <td><div><?php the_cfc_field( 'frame_specs', 'geometry' ); ?></div></td>
                </tr>
                <tr>
                  <td><div>Fork</div></td>
                  <td><div><?php the_cfc_field( 'frame_specs', 'fork' ); ?></div></td>
                </tr>
                <tr>
                  <td><div>Paint</div></td>
                  <td><div><?php the_cfc_field( 'frame_specs', 'paint' ); ?></div></td>
                </tr>
                <tr>
                  <td><div>Frame Material</div></td>
                  <td><div><?php the_cfc_field( 'frame_specs', 'frame-material' ); ?></div></td>
                </tr>
              </tbody>
            </table>

            <h4 class="handbuilt">Handbuilt in Massachusetts</h4>
            
            <hr>

            <?php the_content(); ?>

            <h2>Steel Frames Starting at: <span>$<?php the_cfc_field( 'frame_price', 'price' ); ?><sup>.00</sup></span></h2>
            <?php $ti_price = get_cfc_field( 'ti_frame_price', 'ti-price' ); if ($ti_price): ?>
              <h2>Ti Frames Starting at: <span>$<?php echo $ti_price; ?><sup>.00</sup></span></h2>
            <?php endif; ?>
            <table class="table specs-table">
              <?php foreach( get_cfc_meta( 'bikes_pricing_container' ) as $key => $value ){ ?>
                <tr>
                  <td>
                    <div><?php the_cfc_field( 'bikes_pricing_container','label', false, $key ); ?></div>
                  </td>
                  <td>
                    <div><?php the_cfc_field( 'bikes_pricing_container','add-on-price', false, $key ); ?></div>
                  </td>
                </tr>
              <?php }  ?>
            </table>
          </div>
        </div>
      </div>
    </article>
  </div>
<?php endwhile; ?>
