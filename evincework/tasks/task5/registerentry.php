<?php
include "oops.php";
$obj=new hello();
	$obj->username=@$_POST['username'];
	$obj->password=@$_POST['password'];
	$obj->gender=@$_POST['gender'];
	$obj->status=@$_POST['selectedval'];
	$obj->registerentry();
if(isset($_POST['id']))
{ 
	$obj->id=$_POST['id'];
	$records=$obj->getdetailsbyid();
	/*print_r($records);
	exit;*/
	echo json_encode($records);
}
	?>

