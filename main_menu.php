<?php

session_start();

if (isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first to access the page";
	header("location: login.php");
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: login.php");
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
<div class="container-fluid px-0 mt-3 mb-5">
	<div class="row mx-0">
		<div class="col-4 logo ">
			<a href="#"><img src="images/logo.png" class="img_size"></a>
		</div>

		<div class="col-4 pl-0">
			<div class="row h-100 align-items-center menu">
			</div>
	
		</div>

		<div class="col-4">
			<div class="row h-100">
				<div class="col-12">
				</div>
			</div>
		</div>
	</div>
</div>


<h1>This is the Homepage</h1>
<?php
if (isset($_SESSION['success'])) : ?>

	<div>
		<h3>
			<?php
			echo $_SESSION['success'];
			unset($_SESSION['success']);
			?>
		</h3>
	</div>
<?php endif ?>

<?php if(isset($_SESSION['username'])) : ?>
	<h3>Welcome<strong><?php echo $_SESSION['username']; ?></strong></h3>

	<button><a href="login.php?logout='1'"></a></button>
<?php endif ?>

<div class="container-fluid px-0">
	<div class="row px-0 mx-0 mt-5">
		<div class="col-12 px-0 slider2 text-center" style="background-image: url('images/slider2.jpg');">
			<p>Copyright &copy 2019 Johanes Satrio. All Rights Reserved.</p>
		</div>
	</div>
</div>

<script src="bootstrap/js/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="bootstrap/js/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.min.js" integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp" crossorigin="anonymous"></script>
</body>
</html>