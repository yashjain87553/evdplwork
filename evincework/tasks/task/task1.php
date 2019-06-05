<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="task1.css">
</head>
<button><a href="insert.php">new user</a></button>
<body>
<?php
include "config.php";
?>
         <table>
         <tr>
         <th>id</th>
         <th>name</th>
         <th>gender</th>
         <th>email</th>
         <th>mobile_num</th>
         <th>image</th>
         <th>action</th>
         </tr>
  
   <?php  $query="SELECT * FROM task1table";
    if($x=$connection->query($query))
    { 
     while($row=mysqli_fetch_assoc($x)){

        ?>      
         <tr>
         <td><?php echo $row['id'];?></td>
         <td><?php echo $row['name'];?></td>
         <td><?php echo $row['gender'];?></td>
         <td><?php echo $row['email']?></td>
         <td><?php echo $row['mobile_num'];?></td>
         <td><img src="images/<?php echo $row['filename'];?>" alt="image not found" width="50px" height="50px"></td>
         <td><button><a href="edit.php?edit_id=<?php echo $row['id'];?>">edit</a></button>
         <button><a href="delete.php?delete_id=<?php echo $row['id'];?>" onclick="return confirm('ARE U SURE TO DELETE?')">delete</a></button></td>
         </tr>
         <br>
        
         <?php
         
     }
    }
?> </table>
         
</body>
</html>