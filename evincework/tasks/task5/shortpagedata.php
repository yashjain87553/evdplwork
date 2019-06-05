<?php
  include "oops.php";
  $slot=$_POST['slot'];
  $page=$_POST['page'];
  $order=$_POST['order'];
  $shortvalue=$_POST['shortvalue'];
   $obj=new hello();
   $obj->page=$page;
   $obj->slot=$slot;
   $obj->shortvalue=$shortvalue; 
   $obj->order=$order; 

   $run=$obj->shortvalue();
    while($r=mysqli_fetch_assoc($run)){
      ?> 
      <tr>
        <td><?php echo $r['username'];?></td>
        <td><?php echo $r['password'];?></td>
        <td><?php echo $r['gender'];?></td>
        <td><?php echo $r['status'];?></td>
        <td><button onclick="getmodaldetail(<?php echo $r['id'];?>)" class="btn btn-info">edit</button></td>
        <td><button  class="btn btn-danger" id="deleteuser" onclick="deleteuser(<?php echo $r['id'];?>)">delete</button></td>
        <td><input type="checkbox" class="checkrecords" data-id="<?php echo $r['id'];?>"></td>
      </tr>
    <?php
    }
    ?>
 