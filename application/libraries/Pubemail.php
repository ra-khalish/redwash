<?php

require_once("./vendor/autoload.php");
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class Pubemail
{
    
    function processSend($data)
    {  
        $connection = new AMQPStreamConnection('172.20.0.2', 5672, 'admin', 'admin');
        $channel = $connection->channel();

        $channel->exchange_declare(
            'myexchange',
            'direct',
            true,
            false
        );
        $channel->queue_declare(
            'myqueue',
            false, true, false, false, 
            // new AMQPTable(array(
            //     "x-queue-type" => "classic",
            //     "x-message-ttl" => 600)
            // )
        );
        // $data = implode(' ', array_slice($argv, 1));
        if (empty($data)) {
            $data = "Hello World!";
        }
        $msg = new AMQPMessage(
            $data,
            array('content_type' => 'application/json','delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
        );

        $channel->basic_publish($msg, 'myexchange', 'mykey');

        echo $data;

        $channel->close();
        $connection->close();

        return TRUE;
    }    
}

