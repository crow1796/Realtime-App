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