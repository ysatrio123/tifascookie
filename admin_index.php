<?php
session_start();
require 'includes/dbh.inc.php';
if (!isset($_SESSION['useruid'])) {
	echo "You have to Login First";
	header("Location: index.php?error=notloggedin&uid=".$_SESSION['useruid']);
	exit();

}
$userid = $_SESSION['userid'];
require 'includes/dbh.inc.php';
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

<div class="container-fluid">
<?php 	
		$sql_status = "SELECT * FROM payment";
		$status_result = mysqli_query($conn, $sql_status);
		if (mysqli_num_rows($status_result) === 0) {
?>
		 	<h3>You currently don't have any active order. If you want to buy something, go to <a href="order.php">this page</a></h3>
<?php
		}else{
			while ($row1 = mysqli_fetch_array($status_result)) {
				$purchase_id = $row1['purchase_id'];
				$status = $row1['payment_status'];
				$transport = $row1['transport'];
				$total_payment = $row1['total_payment'];
				$receipt = $row1['receipt'];
				$username = $row1['user_name'];
				$phone = $row1['phone_number'];
				$courier = $row1['transport'];
?>			
			<form action="includes/admin_order.inc.php" method="post" onsubmit="return confirm('Are You Sure ?');">
				<div class="card mx-auto my-5" style="width: 50rem;">
					<div class="card-body">
						<input type="hidden" name="id" value="<?=$purchase_id?>">
						<div class="row">
							<div class="col-8">
							<h5 class="card-title">Order <?= $purchase_id; ?></h5>
							</div>
<?php 				
						if ($status === 'pending') { 
?>
							<div class="col-4">
								<h5>Status<span class="badge badge-secondary">Pending</span></h5>
							</div>

<?php
						}elseif ($status === 'verifying') {
?>
							<div class="col-4">
								<h5>Status<span class="badge badge-primary">Verifying</span></h5>
							</div>
<?php
						}elseif ($status === 'approved') {
?>
							<div class="col-4">
								<h5>Status<span class="badge badge-info">Verified</span></h5>
							</div>
<?php
						}elseif ($status === 'baking') {
?>
							<div class="col-4">
								<h5>Status<span class="badge badge-warning">Baking</span></h5>
							</div>
<?php
						}elseif ($status === 'sending') {
?>
							<div class="col-4">
								<h5>Status<span class="badge badge-primary">Sending</span></h5>
							</div>
<?php
						}elseif ($status === 'success') {
?>
							<div class="col-4">
								<h5>Status<span class="badge badge-success">Success</span></h5>
							</div>
<?php
						}elseif ($status === 'declined') {
?>
							<div class="col-4">
								<h5>Status<span class="badge badge-danger">Declined</span></h5>
							</div>
<?php
						}
?>			
						</div>
						<div class="row">
						<div class="col-3">
						<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#viewdetail<?=$purchase_id?>">View Details</button>

						<div class="modal fade" id="viewdetail<?=$purchase_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLongTitle">Order <?=$purchase_id?></h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
<?php
								$detail_sql = "SELECT * FROM cart WHERE purchase_id = $purchase_id";
								$detail_result = mysqli_query($conn, $detail_sql);
								while ($row2 = mysqli_fetch_assoc($detail_result)) { 
									$item = $row2['item_name']; 
									$qty = $row2['item_quantity'];
									$address = $row2['user_address'];
?>
									<div class="row">
										<div class="col">
											<h5><?=$item;?></h5>
										</div>
										<div class="col">
											<h5><?=$qty;?></h5>
										</div>
									</div>
<?php
								}

?>
									<div class="row">
										<div class="col">
											<p>Customer Name: <?=$username;?></p>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Phone Number: <?=$phone;?></p>
										</div>
									</div>	
									<div class="row">
										<div class="col">
											<p>Address: <?=$address;?></p>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Total Payment: Rp.<?=$total_payment;?></p>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Courier: <?=$courier?></p>
										</div>
									</div>								
<?php 								
									if ($status != 'pending') {
?>
									<div class="row">
										<div class="col" id="receiptimage">
											<p>Order Receipt</p>
											<img src="data:image/;base64,<?=base64_encode($receipt);?>">
										</div>
									</div>
<?php
									}
?>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						      </div>
						    </div>
						  </div>
						</div>
					</div>
<?php 				if ($status === 'verifying') {?>
						<div class="col-6">
							<button type="submit" name="verify-order" class="btn btn-primary">Verify Order</button>
							<button type="submit" name="decline-order" class="btn btn-danger">Decline</button>
						</div>
<?php
					}elseif ($status === 'approved') {
?>
						<div class="col-3">
							<button type="submit" name="cooking-order" class="btn btn-primary">Ready To Cook</button>
						</div>
<?php
					}elseif ($status === 'baking') {
?>
						<div class="col-3">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ordersend<?=$purchase_id?>">Send Order</button>
						</div>

						<!-- Modal -->
						<div class="modal fade" id="ordersend<?=$purchase_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLongTitle">Courier Selection</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        <div class="form-group">
						        	<label for="courierlabel">Select Courier</label>
						        	<select class="form-control" id="courierlabel" name="order-courier">
						        		<option value="(Go-Jek) ">Go-Jek</option>
						        		<option value="(Grab) ">Grab</option>
						        		<option value="(JNE) ">JNE</option>
						        	</select>
						        </div>
						        <div class="form-group">
						        	<input type="text" class="form-control" name="track-number" placeholder="Enter Courier's Phone Number Or Tracking Number">
						        </div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						        <button type="submit" class="btn btn-primary" name="send-submit">Send Order</button>
						      </div>
						    </div>
						  </div>
						</div>
<?php
					}elseif ($status === 'sending') {
?>
						<div class="col-5">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ordersend<?=$purchase_id?>">Update Courier Information</button>
						</div>

												<!-- Modal -->
						<div class="modal fade" id="ordersend<?=$purchase_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLongTitle">Courier Selection</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        <div class="form-group">
						        	<label for="courierlabel">Select Courier</label>
						        	<select class="form-control" id="courierlabel" name="order-courier">
						        		<option value="(Go-Jek) ">Go-Jek</option>
						        		<option value="(Grab) ">Grab</option>
						        		<option value="(JNE) ">JNE</option>
						        	</select>
						        </div>
						        <div class="form-group">
						        	<input type="text" class="form-control" name="track-number" placeholder="Enter Courier's Phone Number Or Tracking Number">
						        </div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						        <button type="submit" class="btn btn-primary" name="send-submit">Send Order</button>
						      </div>
						    </div>
						  </div>
						</div>
<?php
					}
?>
				</div>
					</div>
				</div>
			</form>							
<?php 
			}
		}
?>
</div>

<?php require 'footer.php'; ?>
	<script src="bootstrap/js/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
	<script src="bootstrap/js/popper.min.js" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
