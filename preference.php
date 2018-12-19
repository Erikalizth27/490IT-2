<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
$connection = new AMQPStreamConnection('172.20.10.9',5672, 'erika', 'erika');
$channel = $connection->channel();
$channel->queue_declare('hello', false, false, false, false);

require_once('connection.php');
//require_once('loggedin.php');


if ($_POST){
    $location = $_POST['location'];
    $preference = $_POST['preference'];

    //$hashed = sha1($pass);

    
    $sql = "INSERT INTO preference (clothe_preference,location_preference) VALUES ('$preference','$location')";

    if ($con->query($sql) === TRUE) {
        header('Location: loggedin.php');

    } else {
        echo "Please fill out all empty boxes " . $sql . "<br>" . $con->error;
        

    }

    $con->close();
}


?>
