<?php
include "oops.php";
$obj=new hello();
 $x=$_POST['allvals'];
 
   $i=0;
   while($i<sizeof($x))
   {
$obj->id=$x[$i];
$obj->deleteselectedrecords();
$i++;
}
?>