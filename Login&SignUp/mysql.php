<?php 
$hostname="localhost";
$dbuser="YOUR_USERNAME";
$dbpassword="";
$dbname="sample_login";
$conn=mysqli_connect($hostname,$dbuser,$dbpassword,$dbname);
if(!$conn){
    die("something went wrong");
}


?>
