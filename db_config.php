<?php 

$host = "localhost";
$username = "root";
$pass = "";
$db_name = "recovery";
$conn = mysqli_connect($host, $username, $pass, $db_name);
if($conn){
     "database is connected";
}else{
     "Connection Error!";
}


?>