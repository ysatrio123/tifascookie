<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div class="container">
	<div class="row d-flex justify-content-center">
<?php

require 'includes/dbh.inc.php';

$sql = "SELECT * FROM item";
$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) { 
		echo "error";
	}	else{
		mysqli_stmt_execute($stmt);
		$result = $stmt->get_result();
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) { ?>
						<div class="col-4">
										<div class="card">
										<img height="250" width="250" class="card-img-top" src="data:image/jpeg;base64,<?=base64_encode($row['itemimage'])?>">
											<div class="card-body">
												<form action="includes/cart.inc.php" method="post">
													<div class="form-group">
														<input type="hidden" name="item_id" value="<?=$row["itemid"]?>" class="form-control">
													</div>
													<h5 class="card-title"><?= $row["itemname"] ?></h5>
													<p class="card-text">Price : <?= $row["itemprice"] ?></p>
													<div class="form-group">
														<input type="number" min="0" max="99" name="item_quantity" class="form-control">
													</div>
													<button type="submit" name="cart_submit">Add To Cart</button>
												</form>
											</div>
										</div>
									</div>
			<?php	}	
			}	else {
				print'no data';
				}
		}
$conn->close();
?>
</div>
	<script src="bootstrap/js/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="bootstrap/js/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.min.js" integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp" crossorigin="anonymous"></script>
</div>
</body>
</html>
