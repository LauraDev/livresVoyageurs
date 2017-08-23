// Node Server Configuration
var io      =   require('socket.io')(3000);
var mysql   =   require('mysql');
http = require('http');

var people = {};

// Send Socket.io responses to our website :
io.use(function (socket, next) {
	var options = {
		host: 'localhost',
		port: 80,
		path: '/index.php/chat',
		headers: {Cookie: 'PHPSESSID=' + socket.handshake.query.token}
	};

// Security
	http.request(options, function (response) {
		response.on('error', function () {
			next(new Error('not authorized'));
		}).on('data', function () {
			next();
		});
	}).end();
});

// Define responses depending on events
io.on('connection', function (socket) {
	console.log('connected!');

	socket.on('chat message', function(data){
        // add_bdd(data,function(res){
        //     if(res)
        //     {
		io.emit('chat message', data);
            // } else
            // {
            //     io.emit('error');
            // }
        // });
	});


    //join the server
	socket.on('join', function(name){
		people[socket.id] = name;
		console.log(people);
		io.emit('member', name);
	});

    // disconnect from the server
	socket.on('disconnect', function(){
		io.emit('memberGone', people[socket.id]);
		console.log(people[socket.id], 'disconnected!');
		delete people[socket.id];
	});

//     //initiate private message
//     socket.on('initiate private message',function(receiver){
//         var nae = receiver;
//         console.log(nae);
//         var receiverSocketId = findUserByName(nae);
//         if(receiverSocketId){
//         var receiver = people[receiverSocketId];
//         var room = getARoom(people[socket.id], receiver);

//         //join the anonymous user
//         socket.join(room);
//         //join the registered user
//         io[receiverSocketId].join(room);


//         //notify the client of this
//         socket.in(room).emit('private room created', room);

//         //
//         }
//     });

//     socket.on('send private message', function(room, message){
//     socket.in(room).emit('private chat message', message);
//     });

});

// //you could use e.g. underscore to achieve this (
//     function findUserByName(name){
//         for(socketID in people)
//         {
//             if(people[socketID].name == name)
//             {
//             return test = socketID;
//             }
//             else
//             {
//             // return false;
//             console.log('not there');
//             }
//         }
//     }

//     //generate private room name for two users
//     function getARoom(user1, user2){
//     return 'privateRooom' + user1.name + "And" + user2.name;
//     }

// var pool    =    mysql.createPool({
//     connectionLimit   :   100,
//     host              :   'localhost',
//     user              :   'root',
//     password          :   'root',
//     database          :   'livresVoyageurs',
//     debug             :   true
// });
// var add_bdd = function (data,callback) {
//     pool.getConnection(function(err,connection){
//         if (err) {
//             callback(false);
//             return;
//         }
//     connection.query("INSERT INTO chat (sender_chat, receiver_chat, message_chat) VALUES ("+data.from+", "+data.to+","+data.msg+")",function(err,rows){
//             connection.release();
//             if(!err) {
//                 callback(true);
//             }
//         });
//         connection.on('error', function(err) {
//                 callback(false);
//                 return;
//         });
//     });
// }
