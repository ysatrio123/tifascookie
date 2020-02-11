<?php
session_start();
require 'includes/dbh.inc.php';

if ($_SESSION['level'] != 'admin') {
	echo "Access Denied";
	header("Location: index.php?accessdenied&level=".$_SESSION['level']);
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
<?php 
	require 'header.php'; 
?>
<div class="container-fluid">
	<div class="row d-flex justify-content-center">
		<button class="btn btn-info col-2 my-4" data-toggle="modal" data-target="#additem">Add New Item</button>
	</div>

								<!-- Modal -->
								<div class="modal fade" id="additem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLongTitle">New Item</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								     <form action="includes/item_modify.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are You Sure ?');">
								      <div class="modal-body">
								      	<p>Item Name</p>
								      	<div class="form-group">
								   		<input type="text" class="form-control" name="newitemname" placeholder="Please Enter The Item's Name" required>
								   		</div>
								   		<p>Item Price</p>
								   		<div class="form-group">
								   		<input type="number" class="form-control" name="newitemprice" placeholder="Number Digits Only" min="1" max="9999999999" required>
								   		</div>
								   		<p>Item Image</p>
								   		<input type="file" name="newitemimage"/ required>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								        <button type="submit" name="submit-new-item" class="btn btn-primary">Add New Item</button>
								      </div>
								  	</form>
								    </div>
								  </div>
								</div>

<?php
	$sql = "SELECT * FROM item";
	$result = mysqli_query($conn,$sql); 
?>
				<section class="container content-section">
					<div class="shop-items">

<?php			
				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_assoc($result)) { $itemid = $row['itemid']; $itemprice = $row['itemprice']; $itemname = $row['itemname']; $itemimage = $row['itemimage'];
?>

						<form action="includes/item_modify.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are You sure ?');">

					
						<div class="shop-item">	

							<input type="hidden" class="item-id" name="id" value=<?=$itemid;?>>
							<input type="hidden" class="item-price" value=<?=$itemprice;?>>
							<input type="hidden" class="item-name" value="<?=$itemname;?>">
							<input type="hidden" class="item-image" value=<?=base64_encode($itemimage);?>>

							<span class="shop-item-title"><?=$itemname;?></span>
							<img class="shop-item-image" src="data:image/;base64,<?=base64_encode($itemimage);?>">

							<div class="shop-item-details">
								<span class="shop-item-price">Rp.<?=$itemprice;?></span>
							</div>
							<div class="row">
								<button class="btn btn-primary col mx-1" type="button" data-toggle="modal" data-target="#editimage<?=$itemid;?>">Edit Image</button>

								<!-- Modal -->
								<div class="modal fade" id="editimage<?=$itemid?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLongTitle">Select Image</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <input type="file" name="item-image"/>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								        <button type="submit" name="submit-image" class="btn btn-primary">Change Image</button>
								      </div>
								    </div>
								  </div>
								</div>

								<button class="btn btn-primary col mx-1" type="button" data-toggle="modal" data-target="#editprice<?=$itemid;?>">Edit Price</button>

								<!-- Modal -->
								<div class="modal fade" id="editprice<?=$itemid?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLongTitle">Set The New Price</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								      	<div class="form-group">
								        	<input type="number" name="price" class="form-control" min="1" max="999999999" placeholder="Numbers Digits Only">
								        </div>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								        <button type="submit" name="submit-price" class="btn btn-primary">Set Price</button>
								      </div>
								    </div>
								  </div>
								</div>

								<button class="btn btn-primary col mx-1" type="button" data-toggle="modal" data-target="#editname<?=$itemid;?>">Edit Item Name</button>

								<!-- Modal -->
								<div class="modal fade" id="editname<?=$itemid?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLongTitle">Enter Item's Name</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								      	<div class="form-group">
								        	<input type="text" name="item-name" class="form-control" placeholder="Item Name">
								        </div>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								        <button type="submit" name="submit-name" class="btn btn-primary">Update Item Name</button>
								      </div>
								    </div>
								  </div>
								</div>

							</div>
							<div class="row my-2">
								<button class="btn btn-danger col mx-1" name="delete-submit" type="submit">Delete Item</button>
							</div>

						</div>
					</form>
					

<?php			
					}	
				}else{
?>
					<h1>No Data</h1>
<?php
				}
?>
</div>
</section>
</div>
<?php require 'footer.php'; ?>
	<script src="bootstrap/js/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
	<script src="bootstrap/js/popper.min.js" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>