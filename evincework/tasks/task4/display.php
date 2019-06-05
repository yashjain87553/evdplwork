<?php
 include "opps.php";
 $empobj=new hello();
    $x=$empobj->display();
    
 ?>
<table>
    	<tr>
    	<th>name</th>
    	<th>phone no</th>
    	<th>city</th>
    	<th>state</th>
    	<th>edit</th>
    	<th>delete</th>
    	</tr>
    <?php while($r=mysqli_fetch_assoc($x)){
    	?>
    	<tr>
    	<td><?php echo $r['name'];?></td>
    	<td><?php echo $r['ph_no'];?></td>
    	<td><?php echo $r['city'];?></td>
    	<td><?php echo $r['state'];?></td>
    	<td><a href=edit.php?id=<?php echo $r['id'];?>>edit</a></td>
    	<td><a href=delete.php?id=<?php echo $r['id'];?>  onclick="return confirm('do u want to delete')">delete</a></td>
    	</tr>
         
    <?php } ?>
    </table>
    <a href="insert.php">insert new records</a>
   
