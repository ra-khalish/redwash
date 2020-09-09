<?php

require_once("./vendor/autoload.php");
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Pubemail
{
    
    function processSend($data)
    {  
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare('task_queue', false, true, false, false);

        // $data = implode(' ', array_slice($argv, 1));
        if (empty($data)) {
            $data = "Hello World!";
        }
        $msg = new AMQPMessage(
            $data,
            array('content_type' => 'application/json','delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
        );

        $channel->basic_publish($msg, '', 'task_queue');

        echo $data;

        $channel->close();
        $connection->close();

        return TRUE;
    }    
}

