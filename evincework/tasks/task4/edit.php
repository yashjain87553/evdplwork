<?php   
      include "opps.php";
       $empobj=new hello();
        $id="";
     if(isset($_GET['id']))
     { 
     	$id=$_GET['id'];
     }
           $empobj->id=$id; $x=$empobj->getbyid();
     ?>
     
     <form action="edit.php" method="POST">
     name: <input type="text" value="<?php echo $x['name'];?>" name="name">
     phone_num:<input type="text" value="<?php echo $x['ph_no'];?>" name="ph_no">
     city :<input type="text" value="<?php echo $x['city'];?>" name="city">
      state: <input type="text" value="<?php echo $x['state'];?>" name="state">
      <input type="hidden" value="<?php echo $id;?>" name="hiddenid">
      <input type="submit" name="submit" value="update">
      <a href="display.php">back</a>
      <?php
     if(isset($_POST['submit']))
     {
     	  
     	$empobj->name=$_POST['name'];
     	$empobj->ph_no=$_POST['ph_no'];
     	$empobj->city=$_POST['city'];
     	$empobj->state=$_POST['state'];
     
     	$empobj->id=$_POST['hiddenid']; 
     	 
     	  $empobj->update();
     }
     
?>