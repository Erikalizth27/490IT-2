
<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
$connection = new AMQPStreamConnection('172.20.10.9',5672, 'erika', 'erika');
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
    //echo "hi";
    $urlContents = "http://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&appid=68bf397028ac2dffb4cdd324558c2d54";
    
    $urlContentsForecast = "http://api.openweathermap.org/data/2.5/forecast?q=".$_GET['city']."&appid=68bf397028ac2dffb4cdd324558c2d54";




    $weather_data = file_get_contents($urlContents);
    $weatherArray = json_decode($weather_data, true);
    $weather_dataForecast = file_get_contents($urlContentsForecast);
    $weatherArrayForecast = json_decode($weather_dataForecast, true);

    
    //$urlContents = curl("http://api.openweathermap.org/data/2.5/weather?id=707860&appid=68bf397028ac2dffb4cdd324558c2d54");
    
    //$weatherArray = json_decode($urlContents, true);
    $line = "\r\n";
    //echo var_dump($weatherArray);
    
    //print_r($weatherArray['list'][0][dt_txt]);
    //print_r($weatherArray['list'][1][dt_txt]);

    
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
     
    <h1>Weather Closet</h1>
     
     <form>
      <div class="form-group" method="POST" action="send.php">
        <label for="city">Enter the name of a city.</label>
        <input type="text" class="form-control" id="city" name="city" aria-describedby="city" placeholder="E.g. New York, Tokyo" value="<?php echo $_GET['city']; ?>">
        

        

      <button id="summit_time" type="submit" class="btn btn-primary">Submit</button>
      <br/>
      <br/>
      <label for="clothes" > What type of clothes do you need?  </label> 
    </form>
     
     <div id="weather">
      
      <?php 
                //require_once('connection.php');

        if($weather) {
            
            echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';


        // $temp1 = 0;
        // $temp2 = 0;
        // if ($tempInFahrenheit > 0 && $tempInFahrenheit < 20){
        //     $temp1 = 0;
        //     $temp2 = 20;
        // } else if($tempInFahrenheit > 20 && $tempInFahrenheit < 40){
        //     $temp1 = 20;
        //     $temp2 = 40;
        // } else if($tempInFahrenheit > 40 && $tempInFahrenheit < 70){
        //     $temp1 = 40;
        //     $temp2 = 70;
        // } else {
        //     $temp1 = 70;
        //     $temp2 = 500;
        // }
    
    //       $sql = "SELECT clothes FROM clothe_weather WHERE temperature between $temp1 and $temp2";
    //      $result = $con->query($sql);
    //      //$line = "\r\n";
    //      $file = "somename.txt";
    // $fp=fopen($file,'a');
    // $line = "\r\n";
    //      //while($ris=mysql_fetch_array($result)) echo $ris[0];
    
    //      if ($result->fetch_array()){
    //         $msg = new AMQPMessage($email.' New search ');
    //         fwrite($fp, date("Y-m-d h:i:sa").' '.$email. '  New search '.$line);
    //         $channel->basic_publish($msg, '', 'hello');

    //         foreach($result as $ri){
    //             //echo $ri['clothes'].$line;
                
    //             echo '<div class="alert alert-success" role="alert">'.$ri['clothes'].'</div>';
    // //var_dump($ri);
    //         }
    //      } else {
    //          echo "No";
    //      }
    //      $con->close();
            
    //     } else {
            
    //         if ($_GET['city'] !="") {
                
    //             echo '<div class="alert alert-danger" role="alert">Sorry, that city could not be found.</div>';
    //         }
       }

      ?>
  
  </div>
  
  <?php
  $showDate = "";
  echo "<table style='width:100%'>";

foreach($weatherArrayForecast as $i){
    
    echo "<tr>";
    $index = 0;
    foreach ($i as $j) {
       
        //echo ($j[weather][0][description]);  
        //echo ($line);
        //echo ($j[weather][0][icon]);
        $aux = explode(" ", strval($j[dt_txt]))[0];
        if ($aux != $showDate){
           
                if (!empty($j[weather][0][description])){
                    $index = $index + 1;
                    echo '<td id="date_'.$index.'" style="width:20%';
                    if ($index == 1) echo ';background:yellow;';
                    echo '"><div>'.$aux.'</div>';                    
                    echo '<div>'.intval($j[main][temp]* 9/5 - 459.67).'&deg;F</div>';
                    echo '<div>'.$j[weather][0][description].'</div>';
                    echo '<img  src="https://openweathermap.org/img/w/'.$j[weather][0][icon].'.png">';
                    
                    $showDate = $aux;
                    echo "</td>";  
                }
                
           }
           
     }
     echo "</tr>";  
     
    //print_r($i);
}
echo "</table>";
require_once('connection.php');
$item = 0;
$valTem = 0;
$showDate2 = "";
foreach($weatherArrayForecast as $i){
    $cont = 0;
    foreach ($i as $j) {

        $aux2 = explode(" ", strval($j[dt_txt]))[0];
        if ($aux2 != $showDate2){

                if (!empty($j[weather][0][description])){

                    $tempInFahrenheit = intval($j[main][temp]* 9/5 - 459.67);
                    // echo '<div>'.intval($j[main][temp]* 9/5 - 459.67).'&deg;F</div>';

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
                    $result2 = $con->query($sql);

//echo var_dump($result2);
               $line = "\r\n";
               $file = "somename.txt";
                $fp=fopen($file,'a');
                $line = "\r\n";
                   //$con->close();
                       
            if ($result2->fetch_array()){
            $msg = new AMQPMessage($email.' New search ');
            fwrite($fp, date("Y-m-d h:i:sa").' '.$email. '  New search '.$line);
            $channel->basic_publish($msg, '', 'hello');
            $cont = $cont + 1;
            echo '<div id="clothes_'.$cont.'" style="';
            if ($cont == 1 ) echo 'display:block;">';
            else echo 'display:none;">';
            foreach($result2 as $ri){
                //echo $ri['clothes'].$line;
                
                echo '<div class="alert alert-success" role="alert">'.$ri['clothes'].'</div>';
                
                
    //var_dump($ri);
            }
            echo '</div>';
            //echo 'B';
         } else {
             //echo "No";
         }


                    $showDate2 = $aux2;
                      

                }
                
           }
           
     }


}


  ?>

     
 </div> 
 <button id="btn_preference" type="button" class="btn btn-primary">Preference</button>
 <div id="div_Preference" class="container" style="display:none">
     
     <h1>Preference - Itenerary</h1>

         <form method="POST" action="preference.php">

<p align ="left"><b>
<label class="A">Preference Locations:  </label> <input   type="text" size="25" id="ul" name="location" required > <br><br>
<label class= "A">Preference Clothes:  </label><input type="text"size="25"id="pl" name="preference" required >
</P></b>

<br><center><input type="submit" name ="submit" value="Submit"></center></br>


 </form>
 


  

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script>

document.getElementById('btn_preference').onclick = function(){
    document.getElementById('div_Preference').style.display = "block";
}

document.getElementById('date_1').onclick = function(){
    deleteDiv();
    document.getElementById('clothes_1').style.display = "block";
    this.style.background = "yellow";
}
document.getElementById('date_2').onclick = function(){
    deleteDiv();
    document.getElementById('clothes_2').style.display = "block";
    this.style.background = "yellow";
}
document.getElementById('date_3').onclick = function(){
    deleteDiv();
    document.getElementById('clothes_3').style.display = "block";
    this.style.background = "yellow";
}
document.getElementById('date_4').onclick = function(){
    deleteDiv();
    document.getElementById('clothes_4').style.display = "block";
    this.style.background = "yellow";
}
document.getElementById('date_5').onclick = function(){
    deleteDiv();
    document.getElementById('clothes_5').style.display = "block";
    this.style.background = "yellow";
}

var deleteDiv = function(){
    document.getElementById('clothes_1').style.display = "none";
    document.getElementById('clothes_2').style.display = "none";
    document.getElementById('clothes_3').style.display = "none";
    document.getElementById('clothes_4').style.display = "none";
    document.getElementById('clothes_5').style.display = "none";

    document.getElementById('date_1').style.background = "none";
    document.getElementById('date_2').style.background = "none";
    document.getElementById('date_3').style.background = "none";
    document.getElementById('date_4').style.background = "none";
    document.getElementById('date_5').style.background = "none";
};

</script>



      
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