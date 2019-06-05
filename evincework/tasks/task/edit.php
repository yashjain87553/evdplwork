<!doctype html>
<html>
<head>
<script>
function hello()
{ 
     var letters = /^[A-Za-z]+$/; 
  var emailvalidation= /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  var a=document.getElementById("name").value;
    var b=document.getElementById("gender").value;
    var c=document.getElementById("email").value;
    var d=document.getElementById("mobile_num").value;

    if(a=="")
{
  alert("name must be filled");
  document.getElementById("name").focus();
  return false;
}
if(!(a.match(letters)))
{
  alert("invalid  name");
  document.getElementById("name").focus();
  return false;
}
   if(b=="")
{
  alert("gender must be filled");
  document.getElementById("gender").focus();
  return false;
}

if(c=="")
{
  alert("email must be filled");
  document.getElementById("email").focus();
  return false;
}
if(!(emailvalidation.test(c)))
{
  alert("invalid email");
  document.getElementById("email").focus();
  return false;
}
if(isNaN(d) || (d.length)!=10)
{
  alert("not a valid mobile no");
  document.getElementById("mobile_num").focus();
  return false;
}
}
</script>
</head>
<body>
<?php
  include"config.php";
    $id="";
  if(isset($_POST['submit']))
  {
    
      $errors= array();
     if($_FILES['image']['name']){
     
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$file_name);
         unlink("images/".$_POST['existingimage']);
      
      }else{
         print_r($errors);
      }
     }else{
      $file_name=$_POST['existingimage'];
     }
    // echo "name---". $file_name."</br>";exit;
    $name=$_POST['name'];
    $gender=$_POST['gender'];
    $email=$_POST['email'];
    $mobile_num=$_POST['mobile_num'];
    $query12="UPDATE task1table SET name='$name',gender='$gender',email='$email',mobile_num='$mobile_num',filename='$file_name' WHERE id='".$_POST['id']."'";
  //  echo "test---".$id;
    //print_r($query12);exit;
      if($connection->query($query12))
      { 

        header('location:task1.php');
      }
             
  }
  include "config.php";
  if(isset($_GET['edit_id'])){
    $id=$_GET['edit_id'];
    $query="SELECT * FROM task1table WHERE id=$id";
    $queryrun=$connection->query($query);
    $queryfetch=mysqli_fetch_array($queryrun);   
    if ($queryfetch['gender'] == 'm') {

$male_status = 'checked';
$female_status='';
}
else if ($queryfetch['gender'] == 'f') {
$male_status='';
$female_status = 'checked';

}
  
}
  
?>
<form action="edit.php" method="post" name="yash"  onsubmit= "return hello()" enctype="multipart/form-data">
<table>
<tr>
<td><B>NAME</B></td>
<td><input type="text" name="name" id="name" value="<?php echo $queryfetch['name'];?>"/></td>
</tr>
<tr>
<td><B>gender</B></td> 
<td><span id="gender" name="gender">
<input type="radio" id="gender" <?php echo $male_status;?> name="gender" value="m">male</td>
<td><input type="radio" id="gender" name="gender" <?php echo $female_status;?> value="f">female
</span></td>
</tr>
<!--<B>gender-></B>  <input type="text" name="gender" value="<?php echo $queryfetch['gender'];?>"/><br>-->
<tr>
<td><B>email</B></td> 
<td><input type="text" name="email" id="email" value="<?php echo $queryfetch['email'];?>"/></td>
</tr>
<tr>
<td><B>mobile_num</B></td>
<td><input type="text" name="mobile_num" id="mobile_num" value="<?php echo $queryfetch['mobile_num'];?>"/></td>
</tr>
 <input type="hidden" name="id" value="<?php echo $queryfetch['id'];?>"/>
 <input type="hidden" name="existingimage" value="<?php echo $queryfetch['filename'];?>"/>
<tr> 
<td><b>change image</b></td>
<td><input type="file" name="image"/><!--<?php  if($queryfetch['filename']) {
  echo $queryfetch['filename']; 
 
 } ?>--></td>
 </table>
<input type="submit" name="submit" id="submit" value="update"><br>
</form>
</body>
</html>

