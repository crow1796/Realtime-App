var http = require('http');
var io = require('socket.io')(http);
var clients = io.listen(7876).sockets;

console.log('Server is running...');

clients.on('connection', function(socket){
	console.log('Someone has connected...');

	socket.on('new_post', function(data){
		clients.emit('new_post', data);
	});

	socket.on('new_comment', function(data){
		clients.emit('new_comment', data);
	});

	socket.on('disconnect', function(){

	});
});