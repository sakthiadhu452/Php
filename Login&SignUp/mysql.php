<?php 
$hostname="localhost";
$dbuser="root";
$dbpassword="7399Sakthi@@@@";
$dbname="sample_login";
$conn=mysqli_connect($hostname,$dbuser,$dbpassword,$dbname);
if(!$conn){
    die("something went wrong");
}


?>