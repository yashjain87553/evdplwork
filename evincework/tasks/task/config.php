<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$connection = new mysqli($servername, $username, $password);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 
  if(!(mysqli_select_db($connection,"task1")))
   {
   	  die("selection error".$coonection.error);
   }
   
?>