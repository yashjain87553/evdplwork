<?php
  

 include "oops.php";
 $obj=new hello();
 $obj->username=$_POST['username'];
 $obj->id=$_POST['id'];
  $m=$obj->updatecheckrecords();
  echo $m;
?>