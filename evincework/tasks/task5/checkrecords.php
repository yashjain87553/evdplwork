<?php
  

 include "oops.php";
 $obj=new hello();
 $obj->username=$_POST['username'];
  $m=$obj->checkrecords();
  echo $m;
?>