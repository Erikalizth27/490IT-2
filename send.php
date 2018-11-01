<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
$connection = new AMQPStreamConnection('192.168.0.16',5672, 'erika', 'erika');
$channel = $connection->channel();
$channel->queue_declare('hello', false, false, false, false);



//echo " [x] Sent 'Somebody Login to the APP'\n";
//$channel->close();
//$connection->close();
// $file = "somename.txt";
// $fp=fopen($file,'a');
// if ($fp == false){
//     echo "Errorotro";
// } else {
//     echo "OK";
// }
// fwrite($fp,'this is sample text to be written2');
// fclose($fp);
// echo "file write complete.";

require_once('connection.php');
require_once('login.php');
$email = $_POST['email'];
$pass = $_POST['password'];
$hashed = sha1($pass);
if ($_POST){
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$hashed'";
    $result = $con->query($sql);
    $file = "somename.txt";
    $fp=fopen($file,'a');
    $salto = "\r\n";
    if ($result->fetch_array()){
        echo "ok";
        header('Location: loggedin.php');
        $msg = new AMQPMessage($email.' Login to the APP');
        fwrite($fp, date("Y-m-d h:i:sa").' '.$email. '  Login'.$salto);
        $channel->basic_publish($msg, '', 'hello');
    } else {
        //header('Location: login.php?sent=true');
        echo "Incorrect Email or Password ";
        $msg = new AMQPMessage($email.' Error to Login to the APP');
        fwrite($fp, date("Y-m-d h:i:sa").' ' .$email. '  Error'.$salto);
        $channel->basic_publish($msg, '', 'hello');
    }
    fclose($fp);
}

$con->close();

?>
