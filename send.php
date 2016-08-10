<?php require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/*
By default, the guest user is prohibited from connecting to the broker remotely;
it can only connect over a loopback interface (i.e. localhost). 
This applies both to AMQP and to any other protocols enabled via plugins. 
Any other users you create will not (by default) be restricted in this way.
This is configured via the loopback_users item in the configuration file.
*/

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

$msg = new AMQPMessage('Hello World!2');
$channel->basic_publish($msg, '', 'hello');

echo " [x] Sent 'Hello World!'\n";

$channel->close();
$connection->close();