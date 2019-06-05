<?php
include "oops.php";
$slot=$_POST['slot'];
$obj=new hello();
  $records=$obj->countrecords();
      $page=ceil($records/$slot);
      echo $page;
?>