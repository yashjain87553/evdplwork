<?php
session_start();
require_once('shop_config.php');
include('header.php');
$sql = "SELECT * FROM products";
$res = mysqli_query($connection, $sql);

?>
<?php while($r = mysqli_fetch_assoc($res)){
	?>

 

	  <div class="col-sm-6 col-md-3">
	    <div class="thumbnail">
	      <img src="images/<?php echo $r['image'];?>" alt="image title">
	      <div class="caption">
	        <h3>Product Name:- <?php echo $r['tittel'];?></h3>
	        <p>Product Description:- <?php echo $r['description'];?></p>
	        <p>price:-<?php echo $r['price'];?></p>
	        <p><a href="addtocart.php?id=<?php echo $r['id']; ?>" class="btn btn-primary" role="button">Add to Cart</a></p>
	      </div>
	    </div>
	  </div>

<?php
}?>
</body>
</html>