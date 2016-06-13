<footer class="content-info" role="contentinfo">
  <div class="container-fluid">
	<div class="row">
		<div class="col-sm-3">
			<h5>Social</h5>
			<hr/>
			<div class="social-navigation">
				<ul class="list-inline footer-menu">
					<li><a href="http://instagram.com/geekhousebikes" class="social-instagram">
		                <svg width="25" height="25">
		                    <image xlink:href="/wp-content/themes/roots-master/assets/img/instagram-white.svg" src="/wp-content/themes/roots-master/assets/img/instagram.png" width="25" height="25" />
		                </svg>
		            </a></li>
		            <li><a href="https://www.facebook.com/pages/Geekhouse-Bikes/203004756442083" class="social-facebook">
		                <svg width="25" height="25">
		                    <image xlink:href="/wp-content/themes/roots-master/assets/img/facebook-white.svg" src="/wp-content/themes/roots-master/assets/img/facebook.png" width="25" height="25" />
		                </svg>
		            </a></li>
		            <li><a href="https://twitter.com/geekhousebikes" class="social-twitter">
		                <svg width="25" height="25">
		                    <image xlink:href="/wp-content/themes/roots-master/assets/img/twitter-white.svg" src="/wp-content/themes/roots-master/assets/img/twitter.png" width="25" height="25" />
		                </svg>
		            </a></li>
		            <li><a href="mailto:info@geekhousebikes.com" class="social-mail">
		                <svg width="25" height="25">
		                    <image xlink:href="/wp-content/themes/roots-master/assets/img/email-white.svg" src="/wp-content/themes/roots-master/assets/img/email.png" width="25" height="25" />
		                </svg>
		            </a></li>
				</ul>
			</div>
		</div>
		<div class="col-sm-3">
			<h5>Pages</h5>
			<hr/>
			<?php
				if (has_nav_menu('footer_page_navigation')) :
					wp_nav_menu(array('theme_location' => 'footer_page_navigation', 'menu_class' => 'list-unstyled footer-menu'));
				endif;
			?>
		</div>
		<div class="col-sm-3">
			<h5>Bikes</h5>
			<hr/>
			<?php
				if (has_nav_menu('footer_bikes_navigation')) :
					wp_nav_menu(array('theme_location' => 'footer_bikes_navigation', 'menu_class' => 'list-unstyled footer-menu'));
				endif;
			?>
		</div>
		<div class="col-sm-3">
			<h5>Mailing List</h5>
			<hr/>
			<?php echo smlsubform(); ?>
		</div>
	</div>
  </div>
</footer>
<section class="copy-right">
  <div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 text-center">
			<small>&copy;<?php echo date("Y"); ?></small>
		</div>
	</div>
  </div>
</section>
</footer>
</div><!-- end mobile-container -->
<?php wp_footer(); ?>
