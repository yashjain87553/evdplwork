<?php
   $order=$_POST['order'];
   $shortvalue=$_POST['shortvalue'];
include "oops.php";
$obj=new hello();
$obj->order=$order;
$obj->shortvalue=$shortvalue;
$records=$obj->shortrecords();
while($r=mysqli_fetch_assoc($records)){
?>
   
    <tr>
    <td><?php echo $r['username'];?></td>
    <td><?php echo $r['password'];?></td>
    <td><?php echo $r['gender'];?></td>
    <td><?php echo $r['status'];?></td>
     <td><button onclick="getmodaldetail(<?php echo $r['id'];?>)" class="btn btn-info">edit</button></td>
    <td><button onclick="deleteuser(<?php echo $r['id'];?>)" class="btn btn-danger">delete</button></td>
    <td><input type="checkbox"  class="checkrecords" data-id=<?php echo $r['id'];?>></td>
    </tr>
<?php
}
?>