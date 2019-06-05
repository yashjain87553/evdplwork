<!doctype html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	var str=$("select option:selected").text();
	$("#"+str).css("display","block");
	$("select").change(function(){
		$("#text").css("display","none");
		$("#textarea").css("display","none");
		$("#radio").css("display","none");
		$("#checkbox").css("display","none");
		var str=$("select option:selected").text();
	
		//$(str).css("display:block");
		//$("#"+str).css("display:block");
		$("#"+str).css("display","block");
		
    

	});
});

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
if(!($sql=mysqli_select_db($connection,"jqueryvalue"))){
	die("not selected");
}
 $query="SELECT * FROM selectvalue WHERE `id`=1";
 $x=$connection->query($query);
 	while($row=mysqli_fetch_assoc($x))
 	{
 		$selectedval=$row[@select_name];
 		$selectid=$row[@id];
 	}
if($_POST){
	$tetet='tetet';
	//INSERT INTO `selectvalue`(`select_name`) VALUES ('test')
	$query = " UPDATE `selectvalue` SET `select_name`='".$_POST['select_name']."' WHERE `id`=1";
	$connection->query($query);
	//echo $query;exit;

$connection->query($query);

}
/*//echo "<pre>";
//print_r($_POST)	;
if($_POST){
echo "<pre>";
print_r($_POST)	;
exit;*/

?>
<?php echo"test--". $selectedval; ?>
<form action="test27.php" method="POST">
<select id="hello" name="select_name">
<option  <?php if ($selectedval=='text') echo ' selected="selected"'?>value="text">text</option>
<option <?php if ($selectedval=='textarea') echo ' selected="selected"'?> value="textarea">textarea</option>
<option <?php if ($selectedval=='radio') echo ' selected="selected"'?> value="radio">radio</option>
<option <?php if ($selectedval=='checkbox') echo ' selected="selected"'?> value="checkbox">checkbox</option>
</select>
<BR>
<BR>
<input type="submit" name="submit" value="submit" >
<br>
<br>
<input type="text" value="text" id="text" style="display:none;">
<textarea  id="textarea" style="display:none;" rows="20" cols="40"></textarea>
</BR>
<span id="radio" style="display:none;">
<h1>click ur gender</h1>
<input type="radio" value="men">men<br>
<input type="radio" value="women">womwn<br>
<input type="radio" value="others">others<br>
</span>
<span id="checkbox" style="display:none;">
<h1>tick ur vehicle</h1>
<input type="checkbox" value="car">car<br>
<input type="checkbox" value="bike">bike<br>
<input type="checkbox" value="cycle">cycle<br>
</span>
</form>
</body>
</html>