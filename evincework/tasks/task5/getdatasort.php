<?php
include "oops.php"; 
$slot=$_POST['slot'];
$page=$_POST['page'];
$order=$_POST['order'];
$shortvalue=$_POST['shortvalue'];
$obj=new hello();
$obj->order=$order;
$obj->shortvalue=$shortvalue;
$records=$obj->countrecords();
$totalpage=ceil($records/$slot);

?>
 <table class="table table-hover">
  <thead>
    <tr>
      <th id="username"><span class="glyphicon"></span><a  onclick="short('username')">username</a></th>
      <th  id="password"><span class="glyphicon"></span><a  onclick="short('password')">password</a></th>
      <th id="gender"><span class="glyphicon"></span><a  onclick="short('gender')">gender</a></th>
      <th  id="status"><span class="glyphicon"></span><a  onclick="short('status')">status</th>
      <th>edit</th>
      <th>delete</th>
      <th>multiple delete</th>
    </tr>
  </thead>
 <tbody class="ajax_replace">
  <?php
     $obj->page=$page;
     $obj->slot=$slot;
  $paginate=$obj->shortdatapage();
    while($r=mysqli_fetch_assoc($paginate)){
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
  </tbody>
</table>
 
  <div class="pagi">
  <ul class="pagination">
   <li><?php $i=1; if($page==1){?>
  <span style="background-color:#778899;"><?php echo "first";?></span>
  <?php } else{?>
  <a onclick="getdata(<?php echo $i;
  ?>)"><?php echo "first";?></a>
 <?php }?></li>
  
   <li><a  onclick="prev()">prev</a></li>

 <?php
 /* if($totalpage>3){
    $totalpage=3;
   }*/
 for($i=1;$i<=$totalpage;$i++){ 
  if($i>3 && $i!=$page){?>
  	  <?php continue; 
  	   }

  	   else {?>

  <li>

  <?php 

   if($i==$page){?>
  <span  style="background-color:#778899;"><?php echo $i;?></span>
  <?php }else{?>
  <a onclick="getdata(<?php echo $i;
  ?>)"><?php echo $i;?></a>
  
  <?php }?>
  </li>
  <?php }
  ?>
  <?php 
}
  ?><li><a >----</a></li>
   <li><a onclick="next()">next</a></li>
    <li><?php  if($page==$totalpage){?>
  <span style="background-color:#778899;"><?php echo "last";?></span>
  <?php } else{?>
  <a onclick="getdata(<?php echo $totalpage;
  ?>)"><?php echo "last";?></a>
 <?php }?></li>
</ul>
</div>