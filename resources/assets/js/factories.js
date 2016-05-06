(function(window, document, angular, $){

	let AppFactories = {};
	(function(AppFactories) {
		AppFactories.PostFactory = function($http){
			let factory = {
				getPosts: getPosts
			};

			return factory;

			function getPosts(){
				return $http({
					'url': window.location.origin + '/api/posts',
					'method': 'GET'
				})
				.then((response) => {
					return response.data;
				});
			}
		};

		AppFactories.NotificationsFactory = function($http, notificationsService){
			let factory = {
				getNotifications: getNotifications
			};
			return factory;

			function getNotifications(){
				return $http({
					'url': window.location.origin + '/api/notifications',
					'method': 'GET'
				})
				.then((response) => {
					return response.data;
				});
			}
		};
		return AppFactories;
	})(AppFactories || {});

	angular
		.module('rt_app')
		.factory('postFactory', ['$http', 'postsService', AppFactories.PostFactory])
		.factory('notificationsFactory', ['$http', 'notificationsService', AppFactories.NotificationsFactory]);

})(window, document, window.angular, window.jQuery);