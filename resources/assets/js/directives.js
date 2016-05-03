(function(window, document, angular, $){

	let AppDirectives = {};
	(function(AppDirectives) {
		AppDirectives.DiffForHumans = function(){
			let directive = {
				restrict: 'E',
				scope: {
					date: '@'
				},
				link: linkFn
			};

			return directive;

			function linkFn(scope, element, attrs){
				element.innerHtml = attrs.date;
			};
		};

		return AppDirectives;
	})(AppDirectives || {});

	angular
		.module('rt_app')
		.directive('diffForHumans', AppDirectives.DiffForHumans);

})(window, document, window.angular, window.jQuery);