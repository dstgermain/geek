<div class="container-fluid">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 about margin-bottom_30 margin-top_60">
			<h2 class="margin_0"><?php echo get_the_title(); ?></h2><hr>
			<div class="row margin-top_30">
				<?php foreach( get_cfc_meta( 'team_member' ) as $key => $value ) : ?>
				<div class="col-md-4 col-xs-6 text-center">
					<img src="<?php the_cfc_field( 'team_member','img', false, $key ); ?>" class="img-responsive img-circle margin-bottom_15" />
					<h4><?php the_cfc_field( 'team_member','name', false, $key ); ?></h4>
				</div>
				<?php endforeach; ?>
			</div>
			<div class="row margin-top_30">
				<div class="col-sm-12">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
