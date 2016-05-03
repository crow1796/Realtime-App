'use strict';
var socket = io.connect((window.location.origin.split(':8888')[0]) + ':7876');
(function(window, document, angular, $){

	angular
		.module('rt_app', []);

})(window, document, window.angular, window.jQuery);