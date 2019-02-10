<?php
require __DIR__ . '/vendor/autoload.php';

use ElephantIO\Client;
// use ElephantIO\Engine\SocketIO\Version1X;
use ElephantIO\Engine\SocketIO\Version2X;
$client = new Client(new Version2X('http://127.0.0.1:3000'));

$client->initialize();
// send message to connected clients
// $client->emit('chat message', "This is new message from php.");
if( count($argv) > 2){
	$message = "";
	for( $i = 1; $i < count($argv); $i++){
		$message .= $argv[$i] . " ";
	}
	$client->emit('chat message', ['type' => 'notification', 'text' => $message]);
} else{
	$client->emit('chat message', ['type' => 'notification', 'text' => 'Hello There!']);
}
$client->close();


// require( __DIR__ . '/ElephantIO/Client.php');
// use ElephantIO\Client as ElephantIOClient;

// $elephant = new ElephantIOClient('http://localhost:3000', 'socket.io', 1, false, true, true);

// $elephant->init();
// $elephant->emit('chat message', 'foo');
// $elephant->close();

?>