<?php
	session_start();
include 'shop_config.php'; 
include 'header.php';
?>
<!doctype html>
<html lang="en">
<head>
	<title>Cart Box</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body> 
	<div class="container">
   <div class="col-md-7">
  <table class="table">
    <tr>
      <th>product id</th>
      <th>product name</th>
      <th>remove</th>
      <th>price</th>
      </tr> 
<?php
$items = $_SESSION['cart'];
$cartitems = explode(",", $items);
$total = '';
   
 foreach ($cartitems as $key=>$id) {
	$sql = "SELECT * FROM products WHERE id = $id";
	$res=mysqli_query($connection, $sql);
	$r = @mysqli_fetch_assoc($res);
	  if(empty($r)){
	  	?>	
	  	<tr>
	  	<td></td>
	  	<td></td>
	  	<td><h4>cart is empty</h4></td>
         <td></td>
	  	</tr>
	  	<?php
	  }
	  else
	  {
	  	?>
	<tr>
		<td><?php echo $r['id'] ; ?></td>
		<td><?php echo $r['tittel']; ?></td>
		<td><a  class="btn btn-danger" href="delcart.php?remove=<?php echo $key; ?>" onclick=" return confirm('do u want to remove?')">Remove</a></td>
		<td>$<?php echo $r['price']; ?></td>
	</tr>
<?php 
	$total = $total + $r['price'];
	} 
}
?>		
<tr>
	<td><strong>Total Price</strong></td>
	<td></td>
	<td></td>
	<td><strong>$<?php echo $total; ?></strong></td>
	
</tr>
       
</table>
<a href="#" class="btn btn-info">Checkout</a>
</div>
</div>
</body>
</html>
