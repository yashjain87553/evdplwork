<?php
session_start();
  if(isset($_GET['remove']))
  {    
  	     $b=$_GET['remove'];
  	     
        $x=$_SESSION['cart'];
         $y=explode(',',$x);
         unset($y[$b]);
      /*echo  implode('',$y);

        exit;*/
           
        $_SESSION['cart']=implode(',',$y);
           header('location: cart.php?status=success');
          
  }
?>