
//This file is watching our server
var WebSServer =  require("websocket").server;
var http = require("http");
var htmlE = require("html-entities");
var PORT = 3280;

//List of our connected users;
var clients = [];

//create the http server
var server = http.createServer();

server.listen(PORT, function(){

    console.log("server up on port:" + PORT);
    console.log("working!");
});


//Create the websocket server
wsServer = new WebSServer({httpServer: server});

//websocket server
wsServer.on("request", function (request) {
    var connection = request.accept('null', request.origin);

    var index = clients.push(connection) - 1;
    console.log('Client', index, "connected");

    /**
     * Send the message to all the clients connected
     */
    connection.on("message", function(){
        console.log("message");
    });


    /**
     * Show disconnected when the client leave the server
     */
    connection.on("close", function(connection){
        clients.splice(index, 1);
        console.log("Client", index, "was disconnected");
    });
});
