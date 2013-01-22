<?php

//require_once(__DIR__ . '/lib/php-amqplib/amqp.inc');

$connection = new AMQPConnection();
$connection->setLogin('mob_apper_admin');
$connection->setPassword('dian_alley');
$connection->setVhost('dian_alley');

$connection->connect();

// Open channel
$channel    = new AMQPChannel($connection);

// Open Queue and bind to exchange
$queue      = new AMQPQueue($channel);
$queue->setName('queue1');
$queue->bind('exchange1', 'key1');
$queue->declare();

// Prevent message redelivery with AMQP_AUTOACK param
while ($envelope = $queue->get(AMQP_AUTOACK)) {
    echo ($envelope->isRedelivery()) ? 'Redelivery' : 'New Message';
    echo PHP_EOL;
    echo $envelope->getBody(), PHP_EOL;
}


?>