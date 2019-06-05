<?php
include "opps.php";
$empobj=new hello();
  if(isset($_GET['id']))
  {
    $empobj->id=$_GET['id'];
      $empobj->delete();
      header('location:display.php');
  }
?>