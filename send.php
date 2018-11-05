<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
$connection = new AMQPStreamConnection('localhost',5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('hello', false, false, false, false);



require_once('connection.php');
require_once('login.php');
$email = $_POST['email'];
$pass = $_POST['password'];
//$hashed = sha1($pass);
//$hashed = password_hash($pass,PASSWORD_DEFAULT);
if ($_POST){
    $sql = "SELECT password FROM users WHERE email='$email'";
    $result = $con->query($sql);
    $file = "somename.txt";
    $fp=fopen($file,'a');
    $line = "\r\n";
    if ($result->fetch_array()){
        $compare = '';
        foreach($result as $ri){
            $compare = $ri['password'];
        }
        if (password_verify($pass, $compare)){
            header('Location: loggedin.php');
            $msg = new AMQPMessage($email.' Loged to the APP');
            fwrite($fp, date("Y-m-d h:i:sa").' '.$email. '  Loged to the APP'.$line);
            $channel->basic_publish($msg, '', 'hello');
        }else {
            echo "Incorrect Email or Password ";
            $msg = new AMQPMessage($email.' Error to Login to the APP');
            fwrite($fp, date("Y-m-d h:i:sa").' ' .$email. '  Error to login to the APP '.$line);
            $channel->basic_publish($msg, '', 'hello');
        }

    } else {
        echo "Incorrect Email or Password  ";
        $msg = new AMQPMessage($email.' Error to Login to the APP');
        fwrite($fp, date("Y-m-d h:i:sa").' ' .$email. '  Error to login to the APP '.$line);
        $channel->basic_publish($msg, '', 'hello');
    }
    fclose($fp);
}

$con->close();

?>
