<?php
include "oops.php";
$obj=new hello();
if(isset($_POST['id']))
{ 
	$obj->id=$_POST['id'];
	$records=$obj->getdetailsbyid();
	/*print_r($records);
	exit;*/
	echo json_encode($records);
}
	?>