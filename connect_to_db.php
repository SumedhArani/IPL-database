<?php

$user='root';
$pass='';
$dbname='ipl';
$con=mysqli_connect("localhost",$user,$pass,$dbname);
//if(!$con)
// print('ERROR : NOT CONNECTED!!');
//else
// print('CONNECTED :P');	
mysqli_select_db($con,$dbname);
?>




