<div class="container-fluid about margin-bottom_30 margin-top_60">
	<div class="row">
		<div class="col-sm-12">
			<?php $model = 'a'; $lastModel = 'b'; ?>
			<?php foreach( get_cfc_meta( 'bike_pricing' ) as $key => $value ){ ?>
			    <?php $model = the_cfc_field( 'bike_pricing','model', false, $key, false ); 
				    if ($model !== $lastModel) :
				    	?>
					    	<div>
						    	<?php echo $model; ?>
						    </div>
					    <?php
				    endif;

				    $lastModel = $model;
			    ?>
			<?php }  ?>
		</div>
	</div>
</div>

