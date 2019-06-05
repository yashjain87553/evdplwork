<!doctype html>
<html>
<head>
<script>
function hello(){
	var letters = /^[A-Za-z]+$/; 
	var emailvalidation= /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var a=document.getElementById("firstname").value;
var b=document.getElementById("lastname").value;
var c=document.getElementById("password").value;
var d=document.getElementById("retypepassword").value;
var e=document.getElementById("mobile").value;
var f=document.getElementById("email").value;
var g=document.getElementById("selectoption").value;
var array=document.getElementsByName("gender");
 var formValid = false;
  var i = 0;
    while (!formValid && i < array.length) {
        if (array[i].checked) formValid = true;
        i++;        
    }
if(!formValid)
{
	alert("gender option must be selected");
	return false;
}

if(a=="")
{
	alert("firstname must be filled");
	document.getElementById("firstname").focus();
	return false;
}
if(!(a.match(letters)))
{
	alert("invalid frst name");
	document.getElementById("firstname").focus();
	return false;
}

if(b=="")
{
	alert("lastname must be filled");
	document.getElementById("lastname").focus();
	return false;
}
if(!(b.match(letters)))
{
	alert("invalid last name");
	document.getElementById("lastname").focus();
	return false;
}
if(e=="")
{
	alert("mobile no must be filled");
	document.getElementById("mobile").focus();
	return false;
}
if(isNaN(e) || (e.length)!=10)
{
	alert("not a valid mobile no");
	document.getElementById("mobile").focus();
	return false;
}
if(c=="")
{
	alert("password must be filled");
	document.getElementById("password").focus();
	return false;
}
 if((c.length)<6)
  {
  	alert("password is too short");
  	document.getElementById("password").focus();
  	return false;
  }
if(d=="")
{
	alert("retype-password must be filled");
	document.getElementById("retypepassword").focus();
	return false;
}
 if(c!=d){
 	 alert("password don't match");
 	 document.getElementById("retypepassword").focus();
 	 return false;
 }

 
if(f=="")
{
	alert("email must be filled");
	document.getElementById("email").focus();
	return false;
}
if(!(emailvalidation.test(f)))
{
	alert("invalid email");
	document.getElementById("email").focus();
	return false;
}
if(g=="")
{
	alert("select option must be selected");
	document.getElementById("selectoption").focus();
	return false;
}

}
</script>
</head>
<body>

<?php

$servername="localhost";
$user="root";
$password="";
$connection=new mysqli($servername,$user,$password);
if($connection->connect_error)
{
	die("wrong".$connection->connect_error);
}
$selectname="";

if(isset($_POST['submit'])){
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$mobile=$_POST['mobile'];
	$password=$_POST['password'];
	$email=$_POST['email'];
	$gender=$_POST['gender'];
	foreach($_POST['selectoption'] as $x)
	{
	     $selectname .=",".$x;
	}
	 
 if(!(mysqli_select_db($connection,"registerfirst")))
  {
  	echo "error".$connection->error;
  } 
    $sql="INSERT INTO registraion(firstname,lastname,mobile_num,password,email,car,gender)
          VALUES ('$firstname','$lastname','$mobile','$password','$email','$selectname','$gender')";
          if(!($query=$connection->query($sql)))
          {
         echo "not inserted".$connection->error;
      }
     $connection->close();
     }
     echo "done";
?>

<h1>REGISTRATION PAGE</h1>
<form name="test1" action="validateform.php" onsubmit= "return hello()" method="POST">
first name<input type="text" id="firstname" name="firstname">
<br>
<br>
last name<input type="text" id="lastname" name="lastname">
<br>
<br>
 10 digit mobile:no<input type="text" id="mobile" name="mobile">
<br>
<br>
password<input type="password" id="password"  name="password">
<br>
<br>
retype-password<input type="password" id="retypepassword" name="retypepassword">
<br>
<br>
email<input type="text" id="email" name="email">
<br><br>
<b>SELECT CAR</b><br>
<select id="selectoption" name="selectoption[]" multiple>
<option value="">CHOOSE AN OPTION</option>
<option value="swift">swift</option>
<option value="santro">santro</option>
<option value="audi">audi</option>
</select>
<br>
<br>
<b>SELECT GENDER</b><br>
<input type="radio"  name="gender" value="men">men<br>
<input type="radio"  name="gender" value="women">women<br>
<input type="radio"  name="gender" value="others">others<br>
<br>
<br>
<input type="submit" value="submit" id="submit"  name="submit">
</form>
</body>
</html>