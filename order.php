<?php
session_start();
require 'includes/dbh.inc.php';

if (!isset($_SESSION['useruid'])) {
	echo "You have to Login First";
	header("Location: index.php?error=notloggedin&uid=".$_SESSION['useruid']);
	exit();

}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="includes/cart.js" async></script>
</head>
<body>
	<?php require 'header.php'; ?>
<div class="container-fluid px-0">
<?php
$sql = "SELECT * FROM item";
$result = mysqli_query($conn,$sql); ?>
				<section class="container content-section">
					<div class="shop-items">

		<?php	if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) { $itemid = $row['itemid']; $itemprice = $row['itemprice']; $itemname = $row['itemname']; $itemimage = $row['itemimage'];?>


					
						<div class="shop-item">	

							<input type="hidden" class="item-id" value=<?=$itemid;?>>
							<input type="hidden" class="item-price" value=<?=$itemprice;?>>
							<input type="hidden" class="item-name" value="<?=$itemname;?>">
							<input type="hidden" class="item-image" value=<?=base64_encode($itemimage);?>>

							<span class="shop-item-title"><?=$itemname;?></span>
							<img class="shop-item-image" src="data:image/;base64,<?=base64_encode($itemimage);?>">

							<div class="shop-item-details">
								<span class="shop-item-price">Rp.<?=$itemprice;?></span>
								<button class="btn btn-primary shop-item-button" type="button">Add To Cart</button>
							</div>

						</div>
					

			<?php	}	
			}	else {
				print'no data';
				}
?>
</div>
</section>

<section class="container content-section">
	<h2>Cart</h2>
	<div class="cart-row">
		<span class="cart-item cart-header cart-column">ITEMS</span>
		<span class="cart-price cart-header cart-column">PRICE</span>
		<span class="cart-quantity cart-header cart-column">QUANTITY</span>
	</div>
	<form action="includes/cart.inc.php" method="post" onsubmit="return confirm('Is Everything Met Your Desire ?');">
	<div class="cart-items"></div>
    <div class="cart-total">
        <strong class="cart-total-title">Total</strong>
        <span class="cart-total-price">RP.0</span>
    </div>
    <button class='btn btn-primary btn-purchase' name='cart-submit' type='submit'>PURCHASE</button>
	</form>    
</section>

<?php require 'footer.php'; ?>
</div>

	<script src="bootstrap/js/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
	<script src="bootstrap/js/popper.min.js" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
