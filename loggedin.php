
<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
$connection = new AMQPStreamConnection('localhost',5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('hello', false, false, false, false);


function curl($url) {
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    } 
//echo "aqui";
if ($_GET['city']) {
    echo "hi";
    $urlContents = "http://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&appid=68bf397028ac2dffb4cdd324558c2d54";

    $weather_data = file_get_contents($urlContents);
    $weatherArray = json_decode($weather_data, true);

    
    //$urlContents = curl("http://api.openweathermap.org/data/2.5/weather?id=707860&appid=68bf397028ac2dffb4cdd324558c2d54");
    
    //$weatherArray = json_decode($urlContents, true);
    
    $weather = "The weather in ".$_GET['city']." is currently ".$weatherArray['weather'][0]['description'].".";
    
    $tempInFahrenheit = intval($weatherArray['main']['temp']* 9/5 - 459.67);
    
    $speedInMPH = intval($weatherArray['wind']['speed']*2.24);
    
    $weather .=" The temperature is ".$tempInFahrenheit."&deg; F with a wind speed of ".$speedInMPH." MPH.";


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  
<style type="text/css">
  
  html { 
      background: url(background4.jpg) no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
  
  body {
      
      background: none;
      
  }
  
  @media (min-width: 768px) {
        
        .container{
            
            max-width: 576px;
            
        }
      
      }

    @media (min-width: 992px) {
        
        .container{
            
            max-width: 576px;
            
        }
      
      }

    @media (min-width: 1200px) {
        
        .container{
            
            max-width: 576px;
            
        }
      
      }
  
  .container {
      
      text-align: center;
      margin-top: 100px;
      
  }
  
  input {
      
      
      margin: 20px 0;
  }
  
  #weather {
      
      margin-top: 20px;
  }





</style>
  
</head>
<body>
  
 <div class="container">
     
    <h1>What's the Weather?</h1>
     
     <form>
      <div class="form-group">
        <label for="city">Enter the name of a city.</label>
        <input type="text" class="form-control" id="city" name="city" aria-describedby="city" placeholder="E.g. New York, Tokyo" value="<?php echo $_GET['city']; ?>">
        <label for="clothes" > What type of clothes do you need  </label>

        
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
         
    </form>
     
     <div id="weather">
      
      <?php 
                require_once('connection.php');

        if($weather) {
            
            echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';


        $temp1 = 0;
        $temp2 = 0;
        if ($tempInFahrenheit > 0 && $tempInFahrenheit < 20){
            $temp1 = 0;
            $temp2 = 20;
        } else if($tempInFahrenheit > 20 && $tempInFahrenheit < 40){
            $temp1 = 20;
            $temp2 = 40;
        } else if($tempInFahrenheit > 40 && $tempInFahrenheit < 70){
            $temp1 = 40;
            $temp2 = 70;
        } else {
            $temp1 = 70;
            $temp2 = 500;
        }
    
          $sql = "SELECT clothes FROM clothe_weather WHERE temperature between $temp1 and $temp2";
         $result = $con->query($sql);
         //$line = "\r\n";
         $file = "somename.txt";
    $fp=fopen($file,'a');
    $line = "\r\n";
         //while($ris=mysql_fetch_array($result)) echo $ris[0];
    
         if ($result->fetch_array()){
            $msg = new AMQPMessage($email.' New search ');
            fwrite($fp, date("Y-m-d h:i:sa").' '.$email. '  New search '.$line);
            $channel->basic_publish($msg, '', 'hello');

            foreach($result as $ri){
                //echo $ri['clothes'].$line;
                
                echo '<div class="alert alert-success" role="alert">'.$ri['clothes'].'</div>';
    //var_dump($ri);
            }
         } else {
             echo "No";
         }
         $con->close();
            
        } else {
            
            if ($_GET['city'] !="") {
                
                echo '<div class="alert alert-danger" role="alert">Sorry, that city could not be found.</div>';
            }
        }

      ?>
  
  </div>
     
 </div> 
  
  
  

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>









<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1> Welcome to the Weather App</h1>
    <a href="login.php">Back to login</a>
</body>
</html> -->