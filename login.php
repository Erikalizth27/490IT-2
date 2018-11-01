<?php
if(!empty($_GET['sent'])){
?>
<div>
    Your message was sent!
</div>
<?php
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
p {
    list-style-type:none;
    height: 100px;
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
<?php

// require_once('connection.php');
// $email = $_POST['email'];
// $pass = $_POST['password'];
// $hashed = sha1($pass);
// if ($_POST){
//     $sql = "SELECT * FROM users WHERE email='$email' AND password='$hashed'";
//     $result = $con->query($sql);
//     if ($result->fetch_array()){
//         echo "ok";
//         header('Location: loggedin.php');
//     } else {
//         echo "Incorrect Email or Password ";
//     }
// }
// $con->close();
?>



<h1>User Login</h1>

    <form method="POST" action="send.php">

    <p align ="left"><b>
    <label class="A">Email:  </label> <input type="text" size="25" id="ul" name="email" required > <br><br>
    <label class= "A">Password:  </label><input type="text"size="25"id="pl" name="password" required >
    </P></b>

    <br><center><input type="submit" name ="submit" value="Submit"></center></br>

    <b><center>Need to register?<br>
    <a href="newuser.php">Register here.</a> </center></b>
    </form>

    
</body>
</html>