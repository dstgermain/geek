/*
Author: Daniel St. Germain
Last Edited: 9/13/14
Do not copy without permission
*/

geek.controller("home", function($scope, $sce, getJSON){
	//init controller scope

	//image slider
	$scope.currentIndex = 0;

    $scope.setCurrentSlideIndex = function (index) {
        $scope.currentIndex = index;
    };

    $scope.isCurrentSlideIndex = function (index) {
        return $scope.currentIndex === index;
    };

    $scope.prevSlide = function () {
        $scope.currentIndex = ($scope.currentIndex < $scope.slides.length - 1) ? ++$scope.currentIndex : 0;
    };

    $scope.nextSlide = function () {
        $scope.currentIndex = ($scope.currentIndex > 0) ? --$scope.currentIndex : $scope.slides.length - 1;
    };

	//big cartel
	$scope.loadedCartel = false;
	$scope.loaded = false;
//	getJSON.getCartel().then(function(data){
//		var left = {};
//		var right = {};
//		if (data.length > 3) {
//			var groups = 0;
//			for (var i = 0; i < 3; i++) {
//				var j = i++;
//				right[groups] = {
//					0: data[i],
//				};
//				left[groups] = {
//					1: data[j]
//				};
//				groups++;
//			}
//			$scope.left = left;
//			$scope.right = right;
//			$scope.loadedCartel = true;
//		}
//	});

	//instagram
	$scope.loadedInsta = false;
	$scope.loaded = false;
	$scope.insta = {};
	getJSON.getInstagram().then(function(data){
		function toObject(arr) {
			var rv = {};
			for (var i = 0; i < 3; ++i) {
				rv[i] = arr[i];
			}
			return rv;
		}
		$scope.insta = toObject(data);
		$scope.loadedInsta = Boolean(data.length);
	});

	//home page
	getJSON.getHome().then(function(data){

		//rotator
		$scope.rotator = data.rotator;

		//video
		$scope.video = $sce.trustAsHtml(data.video);

		//bikes
		$scope.bikes = data.bikes;
		$scope.bikesHeader = data.bikesHeader;

		$scope.loaded = true;

		$('.flexslider').flexslider({
			animation: "slide",
			animationLoop: false,
			pausePlay: true,
			start: function(slider){
				$('body').removeClass('loading');
			}
		});
	});

	//scope function
	$scope.html = function(html){
		return $sce.trustAsHtml(html);
	};
	$scope.relUrl = function rel(url) {
		return url.substr(url.indexOf(".com") + 4);
	};
	$scope.makeShort = function(html) {
		"use strict";
		var length = 75,
		append = "... <a href=\"http://www.geekhousebikes.bigcartel.com/product/{{item.permalink}}\">read more&raquo;</a>";

		var StrippedString = string.replace(/(<([^>]+)>)/ig, "");
		if (StrippedString.length > length) {
			StrippedString = StrippedString.substring(0, length) + append;
		} else {
			StrippedString = StrippedString;
		}
		return StrippedString;
    };
});

geek.directive("onFinishRender", function ($timeout) {
    return {
        restrict: "A",
        link: function (scope, element, attr) {
            if (scope.$last === true) {
                $timeout(function () {
                    $(".flexslider").flexslider();
                });
            }
        }
    };
});