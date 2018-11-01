<?php
$myfile = fopen("somename.txt", "w") or die("Unable to open file3!");
if ($myfile == false){
    echo "Error3";
} else {
    echo "OK";
}
$txt = "John Doe\n";
fwrite($myfile, $txt);
$txt = "Jane Doe\n";
fwrite($myfile, $txt);
fclose($myfile);
?> 