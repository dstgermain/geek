<div class="container-fluid about margin-bottom_30 margin-top_60">
	<div class="row">
		<div class="col-sm-4">
			<h3>Contact Information</h3>
			<?php the_cfc_field( 'contact_info', 'info' ); ?>
			<hr>
			<?php foreach( get_cfc_meta( 'int_dist' ) as $key => $value ) : ?>
				<h3>International Distributors</h3>
				<strong>
					<?php the_cfc_field( 'int_dist', 'name', false, $key ); ?>
				</strong><br>
				<address class="margin_0">
					<?php the_cfc_field( 'int_dist', 'location', false, $key ); ?>
				</address>
				email: <a href="mailto:<?php the_cfc_field( 'int_dist', 'email', false, $key );?>"><?php the_cfc_field( 'int_dist', 'email', false, $key );?></a><br>
				telephone: <a href="tel:<?php the_cfc_field( 'int_dist', 'telephone', false, $key );?>"><?php the_cfc_field( 'int_dist', 'telephone', false, $key );?></a>
			<?php endforeach; ?>
		</div>
		<div class="col-sm-8">
			<h3>Order Process</h3>
			<?php the_content(); ?>
		</div>
	</div>
</div>

