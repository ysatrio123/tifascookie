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
</head>
<body>
<?php require 'header.php'; ?>

<section>
	<div class="container-fluid">
<?php	$userid = $_SESSION['userid'];
		$sql_form = "SELECT DISTINCT purchase_id FROM cart WHERE order_status = 'pending'  AND user_id = $userid || order_status = 'declined' AND user_id = $userid";
		$result1 = mysqli_query($conn,$sql_form);
		while ($row1 = mysqli_fetch_array($result1)) { $form = $row1['purchase_id'];
?>
			<div class="card mx-auto my-5" style="width: 50rem;">
				<form action="includes/confirm.inc.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are You Sure ? Please Recheck Everything Before Continue.')">
				<div class="card-body">
					<input type="hidden" name="order-id" value="<?=$form?>">
					<h5 class="card-title cart-column">Order <?=$form?></h5>
					<div class="row">
						<div class="col-3">
							<h3 class="cart-column font-weight-bold">Items</h3>
						</div>
						<div class="col-3 offset-6">
							<h3 class="cart-column font-weight-bold">Quantity</h3>
						</div>
					</div>
<?php 				$sql_items = "SELECT user_name,user_address, user_phone, item_name, item_quantity FROM cart WHERE purchase_id = $form 									AND order_status = 'pending' || purchase_id = $form AND order_status = 'declined'";
					$result2 = mysqli_query($conn,$sql_items);
					while ($row2 = mysqli_fetch_assoc($result2)) { $item = $row2['item_name']; $item_quantity = $row2['item_quantity'];$username = $row2['user_name']; $useraddress = $row2['user_address']; $userphone = $row2['user_phone'];
?>
					<div class="row">
						<div class="col-4">
							<p class="card-text cart-column"><?=$item?></p>
						</div>
						<div class="d-flex align-items-center col-2 offset-6">
							<p class="card-text cart-column"><?=$item_quantity?></p>
						</div>
					</div>
<?php 				}
					$sql_total = "SELECT SUM(total_price) AS total_payment FROM cart WHERE purchase_id = $form";
					$result3 = mysqli_query($conn,$sql_total);
					$row3 = mysqli_fetch_assoc($result3);
					$total_payment = $row3['total_payment'];
?>
					<input type="hidden" name="user-name" value="<?=$username?>">
					<input type="hidden" name="user-address" value="<?=$useraddress?>">
					<input type="hidden" name="user-phone" value="<?=$userphone?>">
					<input type="hidden" name="total-payment" value=<?=$total_payment?>>
					<div class="row">
						<div class="col-3 offset-9">
							<strong class="card-text">Total</strong>
							<span class="card-text">Rp.<?=$total_payment?></span>
						</div>
					</div>
					<p>Address : <?=$useraddress?></p>
					<div class="row">
						<div class="col">
							<p class="text-center">Please Upload Your Payment Receipt</p>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<input type="file" name="receipt"/>
						</div>
						<div class="col">
							<button class="btn btn-success" type="submit" name="confirm-order">Confirm Your Payment</button>
							<button class="btn btn-danger" type="submit" name="cancel-order">Cancel Order</button>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#changeaddress<?=$form?>">Change Address</button>

														<!-- Modal -->
							<div class="modal fade" id="changeaddress<?=$form?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLongTitle">Enter Your Delivery Address</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        	<div class="form-group">
							        	<textarea class="form-control" name="address-change" rows="3"></textarea>
							        	</div>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							        <button type="submit" name="address-update" class="btn btn-primary">Change Delivery Address</button>
							      </div>
							    </div>
							  </div>
							</div>

						</div>
					</div>
				</div>				
				</form>
			</div>
<?php 		} if(empty($row3)) {
?>
			<h3 class="text-center">You Currently Have No Active Orders! If You Want To Buy Some Sweet Treats, Go To <a href="order.php">This Page</a>.</h3>
<?php 		}
?>
	</div>
</section>
<?php require 'footer.php'; ?>
	<script src="bootstrap/js/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
	<script src="bootstrap/js/popper.min.js" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>