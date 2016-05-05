'use strict';
var socket = io.connect((window.location.origin.split(':8888')[0]) + ':7876');
(function(window, document, angular, $){

	angular
		.module('rt_app', []);

})(window, document, window.angular, window.jQuery);
(function(window, document, angular, $){

	let AppControllers = {};
	(function(AppControllers){
		AppControllers.NewsfeedController = function(postFactory, postsService){
			let vm = this;
			vm.postContent = '';
			vm.processPost = processPost;
			vm.posts = [];
			postFactory.getPosts().then((response) => { vm.posts = response; });

			socket.on('new_post', function(){
				postFactory.getPosts().then((response) => { vm.posts = response; });
				vm.postContent = '';
			});

			socket.on('new_comment', function(){
				postFactory.getPosts().then((response) => { vm.posts = response; });
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

		AppControllers.SinglePostController = function(singlePostService, postFactory){
			let vm = this;
			vm.comment = '';
			postFactory.getPosts().then((response) => { vm.posts = response; });
			vm.sendComment = sendComment;

			function sendComment(index){
				if(event.keyCode == 13 && event.shiftKey == false){
					event.preventDefault();
					if(vm.comment != ''){
						vm.currentPost = vm.posts[index];
						vm.currentPost.comment_content = vm.comment;
						singlePostService.sendComment(vm.currentPost)
											.then((response) => {
												singlePostService.broadcastComment(response);
											});
						vm.comment = '';
					}
				}
			}
		};
		return AppControllers;
	})(AppControllers || {});

	angular
		.module('rt_app')
		.controller('newsfeedController', ['postFactory', 'postsService', AppControllers.NewsfeedController])
		.controller('singlePostController', ['singlePostService', 'postFactory', AppControllers.SinglePostController]);

})(window, document, window.angular, window.jQuery);
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
					'method': 'GET',
				})
				.then((response) => {
					return response.data;
				});
			}
		}
		return AppFactories;
	})(AppFactories || {});

	angular
		.module('rt_app')
		.factory('postFactory', ['$http', 'postsService', AppFactories.PostFactory]);

})(window, document, window.angular, window.jQuery);
(function(window, document, angular, $){

	let AppServices = {};
	(function(AppServices) {
		AppServices.PostsService = function($http, $q){
			this.sendPost = sendPost;
			this.broadcastPost = broadcastPost;

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

		};

		AppServices.SinglePostService = function($http, $q){
			this.sendComment = sendComment;
			this.broadcastComment = broadcastComment;

			function sendComment(data){
				console.log(data);
				return $http({
					'url': window.location.origin + '/api/comment',
					'method': 'POST',
					'data': data
				})
				.then((response) => {
					if(response.data == false){
						return false;
					}
					return response.data;
				});
			}

			function broadcastComment(data){
				socket.emit('new_comment', data);
			}

		};
		return AppServices;
	})(AppServices || {});

	angular
		.module('rt_app')
		.service('postsService', ['$http', '$q', AppServices.PostsService])
		.service('singlePostService', ['$http', '$q', AppServices.SinglePostService]);

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
