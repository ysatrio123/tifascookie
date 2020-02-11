<?php
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="includes/cart.js"></script>
</head>
<body>
<?php include 'header.php'; ?>
		<div class="container">
			<div class="card mt-5">
				<div class="card-body">
				<h1 class="card-title">Signup</h1>
					<form action="includes/signup.inc.php" onsubmit="return confirm('Are You Sure ? Please Recheck Everything Before Proceed.');" method="post">
						<div class="form-group">
							<input type="text" name="uid" placeholder="Full Name" class="form-control">
						</div>

						<div class="form-group">
							<input type="text" name="address" placeholder="Home/Delivery Address" class="form-control">
						</div>

						<div class="form-group">
							<input type="text" name="phone" placeholder="Phone Number" class="form-control">
						</div>

						<div class="form-group">
							<input type="text" name="mail" placeholder="email" class="form-control">
						</div>

						<div class="form-group">
							<input type="password" name="pwd" placeholder="Password" class="form-control">
						</div>

						<div class="form-group">
							<input type="password" name="pwd-repeat" placeholder=" Repeat Password" class="form-control">
						</div>

						<button type="submit" name="signup-submit">Signup</button>
					</form>
				</div>
			</div>
		</div>

<?php include 'footer.php'; ?>

	<script src="bootstrap/js/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="bootstrap/js/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.min.js" integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp" crossorigin="anonymous"></script>
</body>
</html>
