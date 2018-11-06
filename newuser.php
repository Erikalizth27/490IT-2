<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
$connection = new AMQPStreamConnection('localhost',5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('hello', false, false, false, false);

require_once('connection.php');




if ($_POST){
    $user = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    //$hashed = sha1($pass);
    $hashed = password_hash($pass,PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (username,name, email, password) VALUES ('$user','$name','$email','$hashed')";

    $file = "somename.txt";
    $fp=fopen($file,'a');
    $line = "\r\n";


    if ($con->query($sql) === TRUE) {
        header('Location: loggedin.php');
        $msg = new AMQPMessage($email.' New user and login to the APP');
        fwrite($fp, date("Y-m-d h:i:sa").' '.$email. '  New user and login to the APP '.$line);
        $channel->basic_publish($msg, '', 'hello');

    } else {
        echo "Please fill out all empty boxes " . $sql . "<br>" . $con->error;
        $msg = new AMQPMessage($email.' Error to register to the APP');
        fwrite($fp, date("Y-m-d h:i:sa").' ' .$email. '  Error to register to the APP'.$line);
        $channel->basic_publish($msg, '', 'hello');

    }
    $con->close();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather APP</title>
</head>

<style>
body {
    margin-right: 150px;
    margin-left: 150px;
    padding: 0;
    height:500px;
    width: 800px;

}
ul {

    list-style-type:none;
    height: 200px;
    padding: 15px 15px 15px 15px ;
    background-color: gray;
    text-align:center;
}
h1 {
    text-align:center;
    color: black;
}

a {
    text-align: center;
}

</style>



<body>
<h1>User Login</h1>




<ul>
    
<form method="post" align ="left"><b>

	<label for="username">username</label>
    <input type="text" name="username" id="username" required>
    <br>
    <br>
	<label for="name">Name</label>
    <input type="text" name="name" id="name" required>
    <br>
    <br>
	<label for="email">Email Address</label>
    <input type="email" name="email" id="email" required>
    <br>
    <br>
	<label for="password">Password</label>
    <input type="password" name="password" id="password" required>
    <br>
    <br>
    <br>
    <br>
	
    <input type="submit" name="submit" value="Create a New User">
    <br>
</form>
<br>
<a href="login.php">Back to login</a>
    
</ul> 
</body>
</html>