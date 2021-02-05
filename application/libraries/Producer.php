<?php

// require_once("./vendor/autoload.php");
// use PhpAmqpLib\Connection\AMQPStreamConnection;
// use PhpAmqpLib\Message\AMQPMessage;
// use PhpAmqpLib\Wire\AMQPTable;

// class Pubemail
// {
    
//     function processSend($data)
//     {  
//         $connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');
//         $channel = $connection->channel();

//         $channel->exchange_declare(
//             'myexchange',
//             'direct',
//             true,
//             false
//         );
//         $channel->queue_declare(
//             'myqueue',
//             false, true, false, false, 
//             // new AMQPTable(array(
//             //     "x-queue-type" => "classic",
//             //     "x-message-ttl" => 600)
//             // )
//         );
//         $data = implode(' ', array_slice($argv, 1));
//         if (empty($data)) {
//             $data = "Hello World!";
//         }
//         $msg = new AMQPMessage(
//             $data,
//             array('content_type' => 'application/json','delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
//         );

//         $channel->basic_publish($msg, 'myexchange', 'mykey');

//         echo $data;

//         $channel->close();
//         $connection->close();

//         return TRUE;
//     }    
// }

require_once("./vendor/autoload.php");
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;

class Producer
{
    
    function publish($data)
    {  
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        # Mutate data
        $data = json_decode($data, TRUE);


        # Initialize Broker
        $exchange_name = 'myexchange';
        $queue_name = 'myqueue';
        $key = 'mykey';

        $channel->queue_declare($queue_name, false, true, false, false);
        $channel->exchange_declare($exchange_name, AMQPExchangeType::DIRECT, false, true, false);
        $channel->queue_bind($queue_name, $exchange_name, $key);
        // $data = implode(' ', array_slice($argv, 1));
        if (empty($data)) {
            $data = "Hello World!";
        }
        $msg = new AMQPMessage(
            $data,
            array('content_type' => 'application/json','delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
        );

        $channel->basic_publish($msg, $exchange_name, $key);

        echo $data;

        $channel->close();
        $connection->close();

        return TRUE;
    }    
}

