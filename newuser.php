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


<?php

require_once('connection.php');


if ($_POST){
    $user = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $hashed = sha1($pass);
    
    $sql = "INSERT INTO users (username,name, email, password) VALUES ('$user','$name','$email','$hashed')";

    if ($con->query($sql) === TRUE) {
        //echo "New record created successfully";
        header('Location: loggedin.php');
    } else {
        echo "Please fill out all empty boxes " . $sql . "<br>" . $con->error;
    }
    $con->close();
}


?>

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