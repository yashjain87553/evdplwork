<?php
include "oops.php";

 
$obj=new hello();
$obj->id=$_POST['id'];
$obj->deleteuser();

?>