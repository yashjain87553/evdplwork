<?php
 /* echo $_POST['id'].$_POST['username'].$_POST['password'].$_POST['gender'].$_POST['status'];
  exit;*/

  include "oops.php";
  $obj=new hello();
  if(isset($_POST['id']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['gender'])  && isset($_POST['status']))
  {
  	$obj->id=$_POST['id'];
  	$obj->username=$_POST['username'];
  	$obj->password=$_POST['password'];
  	$obj->gender=$_POST['gender'];
  	$obj->status=$_POST['status'];
  	  $obj->update();
  	  
  }
?>