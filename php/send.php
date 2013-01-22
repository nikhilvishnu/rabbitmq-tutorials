<?php

//require_once(__DIR__ . '/lib/php-amqplib/amqp.inc');

//$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');

$connection = new AMQPConnection();
$connection->setLogin('username'); //Change username with your username
$connection->setPassword('password'); //Change password with your password
$connection->setVhost('vhostname'); //Change vhostname with your vhostname

$connection ->connect();

//Open Channel
$channel = new AMQPChannel($connection);

// Declare exchange
$exchange   = new AMQPExchange($channel);
$exchange->setName('exchange1');
$exchange->setType('fanout');
$exchange->declare();

// Create Queue
$queue      = new AMQPQueue($channel);
$queue->setName('queue1');
$queue->declare();

$message    = $exchange->publish('Custom Message (ts): '.time(), 'key1');
if (!$message) {
    echo 'Message not sent', PHP_EOL;
} else {
    echo 'Message sent!', PHP_EOL;
}

?>