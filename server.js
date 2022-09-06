// var app = require('express')();
// var server = require('http').Server(app);
// var io = require('socket.io')(server, {
//     cors: { origin: "*" }
// });
// var redis = require('redis');

// server.listen(8890);
// io.on('connection', function(socket) {

//     console.log("client connected");
//     var redisClient = redis.createClient();
//     redisClient.subscribe('message');

//     redisClient.on("message", function(channel, data) {
//         console.log("mew message add in queue " + data['message'] + " channel");
//         socket.emit(channel, data);
//     });

//     socket.on('disconnect', function() {
//         redisClient.quit();
//     });

// });

const express = require('express');

const app = express();


const server = require('http').createServer(app);


const io = require('socket.io')(server, {
    cors: { origin: "*" }
});


io.on('connection', (socket) => {
    console.log('connection');

    socket.on('receivedSignalData', (message) => {
        console.log(message);

        // io.sockets.emit('sendChatToClient', message);
        socket.broadcast.emit('receivedSignalData', message);
    });


    socket.on('disconnect', (socket) => {
        console.log('Disconnect');
    });
});

server.listen(3004, () => {
    console.log('Server is running');
});