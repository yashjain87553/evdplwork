<?php
include "opps.php";
  $empobj=new hello();
    if(isset($_POST['submit']))
    {
    	
    	  $empobj->name=$_POST['name'];
    	 $empobj->ph_no=$_POST['ph_no'];
    	 $empobj->city=$_POST['city'];
    	 $empobj->state=$_POST['state'];
            
            $empobj->insert();
           header('location:display.php');
    }

?>
<form action="insert.php" method="POST">
NAME:<input type="text" placeholder="enter name" name="name">
phone_nnum:<input type="text" placeholder="enter no" name="ph_no">
city:<input type="text" placeholder="enter city" name="city">
state:<input type="text" placeholder="enter state" name="state">
<input type="submit" value="insert" name="submit">
</form>