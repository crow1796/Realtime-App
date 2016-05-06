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

		AppControllers.NotificationsController = function(notificationsService, notificationsFactory, $timeout){
			let vm = this;
			vm.showClass = false;
			notificationsFactory.getNotifications().then((response) => { vm.notifications = response; });

			socket.on('new_notification', function(){
				notificationsFactory.getNotifications().then((response) => { vm.notifications = response; });
				vm.showClass = true;
				$timeout(function(){
					vm.showClass = false;
				}, 1000);
			});
		};
		return AppControllers;
	})(AppControllers || {});

	angular
		.module('rt_app')
		.controller('newsfeedController', ['postFactory', 'postsService', AppControllers.NewsfeedController])
		.controller('singlePostController', ['singlePostService', 'postFactory', AppControllers.SinglePostController])
		.controller('notificationsController', ['notificationsService', 'notificationsFactory', '$timeout', AppControllers.NotificationsController]);

})(window, document, window.angular, window.jQuery);