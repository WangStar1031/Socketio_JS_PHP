<?php
require __DIR__ . '/vendor/autoload.php';

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;
$client = new Client(new Version2X('http://127.0.0.1:3000'));

$client->initialize();
if( count($argv) > 2){
	$message = "";
	$userId = $argv[1];
	for( $i = 2; $i < count($argv); $i++){
		$message .= $argv[$i] . " ";
	}
	$client->emit('chat message', ['type' => 'notification', 'userId' => $userId, 'text' => $message]);
}
$client->close();

?>