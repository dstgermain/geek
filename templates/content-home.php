<link rel="stylesheet" href="/wp-content/themes/roots-master/assets/js/flexslider/flexslider.css" type="text/css" media="screen" />
<script defer src="/wp-content/themes/roots-master/assets/js/flexslider/jquery.flexslider.js"></script>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular-sanitize.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular-animate.min.js"></script>

<script type="text/javascript" src="/wp-content/themes/roots-master/assets/js/home-init.js"></script>
<script type="text/javascript" src="/wp-content/themes/roots-master/assets/js/json-service.js"></script>
<script type="text/javascript" src="/wp-content/themes/roots-master/assets/js/controllers.js"></script>

<div ng-app="homePage" class="home-page">
	<div ng-controller="home">

		<div class="flexslider">
		    <ul class="slides">
		        <li ng-repeat="x in rotator" on-finish-render>
		            <img ng-src="{{x.url}}" />
		        </li>
		    </ul>
		</div>
		<!-- bikes -->
		<div class="container-fluid sample-show-hide" ng-show="loaded">
			<div class="row">
				<div class="col-xs-12">
					<h2 class="margin_30">{{bikesHeader}} Lineup</h2>
				</div>
			</div>
			<div class="row margin-bottom_30 sample-show-hide">
				<div class="col-sm-4 col-xs-12 margin-bottom-xs_30 bikes-col text-center" ng-repeat="bike in bikes">
					<a href="{{bike.page}}">
						<div class="img" ng-style="{ 'background-image': 'url({{bike.img}})' }"></div>
						<div class="text">
							<h4>{{bike.tit}}</h4>
							<small>{{bike.sub}}</small>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row margin-bottom_30">
				<!-- posts -->
				<div class="sample-show-hide" ng-show="loadedInsta">
					<div class="col-sm-4" data-ng-repeat="ins in insta track by $index">
						<a class="insta small margin-bottom_30" href="{{ins.link}}">
							<div class="image" ng-style="{'background-image': 'url(' + ins.images.standard_resolution.url + ')'}"></div>
							<div class="insta-like">&#9829; {{ins.likes.count}}</div>
							<div class="insta-caption">{{ins.caption.text}}</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>