'use strict';
var socket = io.connect((window.location.origin.split(':8888')[0]) + ':7876');
(function(window, document, angular, $){

	angular
		.module('rt_app', []);

})(window, document, window.angular, window.jQuery);
(function(window, document, angular, $){

	let AppControllers = {};
	(function(AppControllers){
		AppControllers.NewsfeedController = function(postsService){
			let vm = this;
			vm.postContent = '';
			vm.processPost = processPost;
			vm.posts = [];
			postsService.getAllPosts().then((response) => { vm.posts = response; });

			socket.on('new_post', function(){
				postsService.getAllPosts().then((response) => { vm.posts = response; });
				vm.postContent = '';
			});

			function processPost(){
				event.preventDefault();
				postsService.sendPost(vm.postContent)
							.then((response) => {
								postsService.broadcastPost(response);
							});
				return false;
			}
		}
		return AppControllers;
	})(AppControllers || {});

	angular
		.module('rt_app')
		.controller('newsfeedController', ['postsService', AppControllers.NewsfeedController]);

})(window, document, window.angular, window.jQuery);
(function(window, document, angular, $, socket){

	let AppFactories = {};
	(function(AppFactories) {
		return AppFactories;
	})(AppFactories || {});

	angular
		.module('rt_app');

})(window, document, window.angular, window.jQuery, socket);
(function(window, document, angular, $){

	let AppServices = {};
	(function(AppServices) {
		AppServices.PostsService = function($http, $q){
			this.sendPost = sendPost;
			this.broadcastPost = broadcastPost;
			this.getAllPosts = getAllPosts;

			function sendPost(data){
				let requestData = {
					'post_content': data
				};
				return $http({
					'url': window.location.origin + '/api/post',
					'method': 'POST',
					'data': requestData
				})
				.then((response) => {
					if(response.data == false){
						return false;
					}
					return response.data;
				});
			}

			function broadcastPost(data){
				socket.emit('new_post', data);
			}

			function getAllPosts(){
				return $http({
					'url': window.location.origin + '/api/posts',
					'method': 'GET',
				})
				.then((response) => {
					return response.data;
				});
			}

		};
		return AppServices;
	})(AppServices || {});

	angular
		.module('rt_app')
		.service('postsService', ['$http', '$q', AppServices.PostsService]);

})(window, document, window.angular, window.jQuery);
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
//# sourceMappingURL=app.js.map
