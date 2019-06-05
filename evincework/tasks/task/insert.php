<!doctype html>
<html>
<head>
<script>
function myfunctionhello()
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
include "config.php";
if(isset($_POST['submit']))
{   
	$errors= array();
      $file_name = $_FILES['image']['name'];
      $array1=explode('.',$file_name);
      $fileName=$array1[0];
      $fileExt=$array1[1];
      $newfile=time().".".$fileExt;
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png","txt","php");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$newfile);
         echo "Success";
      }else{
         print_r($errors);
      }
	$name=$_POST['name'];
	$gender=$_POST['gender'];
	$email=$_POST['email'];
	$mobile_num=$_POST['mobile_num'];
	$query="INSERT INTO task1table(name,gender,email,mobile_num,filename)
	VALUES('$name','$gender','$email','$mobile_num','$newfile')";
	$run=$connection->query($query);

	header('location:task1.php');
}

?>
<form action="insert.php" onsubmit="return myfunctionhello()" method="POST" enctype="multipart/form-data">
<table>
<tr>
<td><B>NAME</B></td>
<td><input type="text" name="name" id="name"/></td>
<tr>

<td><B>gender</B></td>
<td><span id="gender" name="gender">
<input type="radio" id="gender" name="gender" value="m">male</td>
<td><input type="radio" id="gender" name="gender" value="f">female
</span></td>
</tr>
<tr>
<td><B>email</B></td>
<td><input type="text" name="email" id="email"/></td>
</tr>
<tr>
<td><B>mobile_num</B></td> 
<td><input type="text" name="mobile_num" id="mobile_num"/></td>
</tr>
<tr>
<td><b>FILE</b></td>
<td><input type="file" name="image" /></td>
</tr>
 </table>
<input type="submit" name="submit" value="submit" id="submit">

</form>
</body>
</html>