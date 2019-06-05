<?php
include"config.php";
$id=$_GET['delete_id'];
  $query="SELECT filename FROM task1table WHERE id=$id";
      $query_run=$connection->query($query);
     $filename=mysqli_fetch_array($query_run);
       $x=$filename[0];
       unlink("images/$x");
 $query="DELETE FROM task1table WHERE id=$id";
    $connection->query($query);
    header('location:task1.php');
?>