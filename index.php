<?php
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>
	<div class="container-fluid">
		<div class="row" id="slider" style="background-image: url('images/slider.jpg');">
			<div class="col py-5 text-center" id="slider">
				<?php
					if (isset($_SESSION['useruid'])) { ?>
						<h1>Welcome, <?=$_SESSION['useruid']?> !</h1>
					<?php }
					else { ?>
						<h1>Welcome !</h1>
					<?php } ?>
			</div>
		</div>
		<div class="container mt-5">
			<div class="row">
				<div class="col-8">
					<h3>Cookies, Cakes & Pudding!</h3>
					<h4>Fit for every occasion.</h4>
					<p>In Cookie Monsta, we serve homemade treats with family's recipe freshly baked from the oven. Your tastebud will be satisfied with our product and beg for more ! But, do not worry about our product hygiene and quality. We always make sure for all of our customer's order to be delivered safe and sound, fine handcrafted packaging and high quality ingredients to make sure customer can preserve our cookies for much needed time. So, what are you waiting for ? head to our registration page and start buying !</p>
				</div>
				<div class="col-4" id="index-image">
					<img src="images/slider1.jpg">
				</div>
			</div>
		</div>
	</div>
<?php include 'footer.php'; ?>

	<script src="bootstrap/js/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="bootstrap/js/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.min.js" integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp" crossorigin="anonymous"></script>
</body>
</html>
