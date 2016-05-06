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
				socket.emit('new_notification', data);
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
				socket.emit('new_notification', data);
			}

		};

		AppServices.NotificationsService = function($http, $q){
		};
		return AppServices;
	})(AppServices || {});

	angular
		.module('rt_app')
		.service('postsService', ['$http', '$q', AppServices.PostsService])
		.service('singlePostService', ['$http', '$q', AppServices.SinglePostService])
		.service('notificationsService', ['$http', '$q', AppServices.NotificationsService]);

})(window, document, window.angular, window.jQuery);