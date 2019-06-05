<?php
include "oops.php";
$slot=@$_POST['slot'];
$obj=new hello();
  $records=$obj->countrecords();
      if($slot>0)
      $page=ceil($records/$slot);
       /* if($page>3){
          $page=3;
        }*/
    
      ?>
  <ul class="pagination">
  <li><a onclick="first()">first</a></li>
  <li><a onclick="prev()">prev</a></li>

   <?php for($i=1;$i<=$page;$i++){
    ?>
  <li><a onclick="getdata(<?php echo $i;
  ?>)"><?php echo $i;?></a></li>
  <?php 
}
  ?>
  <li><a>----</a></li>
 <li><a onclick="next()">next</a></li>
 <li><a onclick="last()">last</a></li>
</ul>
    