<?php
include "oops.php"; 

   $search=$_POST['value'];
   $slot=$_POST['slot'];
   $page=$_POST['page'];

  $obj=new hello();
  $obj->search=$search;
  $obj->slot=$slot;
  $obj->page=$page;
  $run=$obj->search();
$records=$run->num_rows;
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
   $run=$obj->searchpage();
   while($m=mysqli_fetch_assoc($run))
    {   
      ?>
      <tr>
        <td><?php echo $m['username'];?></td>
        <td><?php echo $m['password'];?></td>
        <td><?php echo $m['gender'];?></td>
        <td><?php echo $m['status'];?></td>
        <td><button onclick="getmodaldetail(<?php echo $m['id'];?>)" class="btn btn-info">edit</button></td>
        <td><button  class="btn btn-danger" id="deleteuser" onclick="deleteuser(<?php echo $m['id'];?>)">delete</button></td>
        <td><input type="checkbox" class="checkrecords" data-id="<?php echo $m['id'];?>"></td>
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
  <a onclick="getdatasearch(<?php echo $i;
  ?>)"><?php echo "first";?></a>
 <?php }?></li>
  
   <!--<li><a  onclick="prev()">prev</a></li>-->

 <?php
  /*if($totalpage>3){
    $totalpage=3;
   }*/
 for($i=1;$i<=$totalpage;$i++){ ?>
  <li>
  <?php if($i==$page){?>
  <span  style="background-color:#778899;"><?php echo $i;?></span>
  <?php }else{?>
  <a onclick="getdatasearch(<?php echo $i;
  ?>)"><?php echo $i;?></a>
  
  <?php }?>
  </li>
  <?php 
}
  ?><li><a >----</a></li>
   <!--<li><a onclick="next()">next</a></li>-->
    <li><?php  if($page==$totalpage){?>
  <span style="background-color:#778899;"><?php echo "last";?></span>
  <?php } else{?>
  <a onclick="getdatasearch(<?php echo $totalpage;
  ?>)"><?php echo "last";?></a>
 <?php }?></li>
</ul>
</div>