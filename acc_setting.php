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
<div class="container-fluid">
<?php 
		$id = $_SESSION['userid'];
		$user_sql = "SELECT * FROM users WHERE idusers = $id";
		$user_result = mysqli_query($conn,$user_sql);
		if ($user_result) {
			$row = mysqli_fetch_assoc($user_result);
			$name = $row['uidusers'];
			$email = $row['emailusers'];
			$phone = $row['phoneuser'];
			$address = $row['addressuser'];
?>			
		<form action="includes/acc.inc.php" method="post" onsubmit="return confirm('Are You Sure ?');">
			<input type="hidden" name="id" value=<?=$id?>>
			<div class="card mx-auto my-5 w-75">
				<div class="card-header text-center">
					User Information
				</div>
				<div class="card-body">
					<div class="row my-2">
						<h5 class="col-3">Full Name : </h5><h5 class="col-5"><?=$name;?></h5>
						<button type="button" class="col-3 btn btn-primary" data-toggle="modal" data-target="#namechange">Update Full Name</button>

						<!-- Modal -->
						<div class="modal fade" id="namechange" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLongTitle">New Full Name</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        <div class="form-group">
						        	<input type="text" name="new-name" class="form-control" placeholder="Please Enter Your Full Name">
						        </div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						        <button type="submit" name="name-submit" class="btn btn-primary">Save changes</button>
						      </div>
						    </div>
						  </div>
						</div>

					</div>

					<div class="row my-2">
						<h5 class="col-3">Email : </h5><h5 class="col-5"><?=$email;?></h5>
						<button type="button" class="col-3 btn btn-primary" data-toggle="modal" data-target="#mailchange">Update Email Address</button>

						<!-- Modal -->
						<div class="modal fade" id="mailchange" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLongTitle">New Email</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        <div class="form-group">
						        	<input type="email" name="new-mail" class="form-control" placeholder="Please Enter Your Email Address">
						        </div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						        <button type="submit" name="mail-submit" class="btn btn-primary">Save changes</button>
						      </div>
						    </div>
						  </div>
						</div>

					</div>
					<div class="row my-2">
						<h5 class="col-3">Phone Number : </h5><h5 class="col-5"><?=$phone;?></h5>
						<button type="button" class="col-3 btn btn-primary" data-toggle="modal" data-target="#phonechange">Update Phone Number</button>

						<!-- Modal -->
						<div class="modal fade" id="phonechange" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLongTitle">New Phone Number</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        <div class="form-group">
						        	<input type="text" name="new-phone" class="form-control" placeholder="Please Enter Your Delivery Address">
						        </div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						        <button type="submit" name="phone-submit" class="btn btn-primary">Save changes</button>
						      </div>
						    </div>
						  </div>
						</div>

					</div>
					<div class="row my-1">
						<h5 class="col-3">Delivery Address : </h5><h5 class="col-5"><?=$address;?></h5>
						<button type="button" class="col-3 btn btn-primary" data-toggle="modal" data-target="#addresschange">Update Delivery Address</button>
					</div>

					<!-- Modal -->
						<div class="modal fade" id="addresschange" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLongTitle">New Delivery Address</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        <div class="form-group">
						        	<input type="text" name="new-address" class="form-control" placeholder="Please Enter Your Delivery Address">
						        </div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						        <button type="submit" name="address-submit" class="btn btn-primary">Save changes</button>
						      </div>
						    </div>
						  </div>
						</div>

				</div>
				<div class="card-footer text-center">
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#pwdchange">Change Password</button>
				</div>

				<!-- Modal -->
						<div class="modal fade" id="pwdchange" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLongTitle">New Password</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        <div class="form-group">
						        	<input type="password" name="old-pwd" class="form-control" placeholder="Please Enter Your Old Password">
						        </div>
						        <div class="form-group">
						        	<input type="password" name="new-pwd" class="form-control" placeholder="Please Enter Your New Password">
						        </div>
						        <div class="form-group">
						        	<input type="password" name="pwd-repeat" class="form-control" placeholder="Repeat New Password">
						        </div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						        <button type="submit" name="pwd-submit" class="btn btn-primary">Save changes</button>
						      </div>
						    </div>
						  </div>
						</div>


			</div>
		<form>
<?php
		}else{
?>
			<h1>sql error</h1>
<?php			
		}
?>
</div>
<?php require 'footer.php'; ?>
	<script src="bootstrap/js/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
	<script src="bootstrap/js/popper.min.js" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>