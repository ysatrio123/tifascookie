<?php

require 'includes/dbh.inc.php';

$active_table = $_SESSION['userid'];
$table_query = "SELECT * FROM cart WHERE user_id=$active_table AND order_status='pending'";
$table_execute = mysqli_query($conn,$table_query);
$table_row_check = mysqli_num_rows($table_execute);

if ($table_row_check == 0) { ?>
	<h1>You don't have anything in the cart. Try add some jar of cookie :)</h1>
<?php }	else{ ?>
   				<table class="table">
   					<thead>
   						<tr>
   							<th scope="col">Item Name</th>
   							<th scope="col">Qty</th>
   							<th scope="col">Subtotal</th>
   						</tr>
   					</thead>
   					<tbody>
					<form action="includes/delete.inc.php" method="post">
						<?php $cart_data=[]; $i = 0; ?>
   						<?php while ($table_row = $table_execute->fetch_assoc()) { $order_id = $table_row['cartid']; $price[$i]=$table_row['item_price']; ?>
   						<tr>

<!--    							<input type="hidden" name="order_id[<?=$i?>]" value=<?= $order_id ?>> -->
   							<th scope="row"><?= $table_row['item_name']; ?></th>
   							<td><input type="number" min="1" max="99" name="order_item_quantity[<?= $i; ?>]" value=<?= $table_row['item_quantity']; ?>></td>
   							<td></td>
   							<td><button type="submit" name="order_delete" class="btn btn-danger">Remove From Cart</button></td>
   							<?php $cart_data[$i]= $order_id; ?>
   							<input type="hidden" name="cart_data[<?=$i;?>]" value=<?= $cart_data[$i]; ?>>
   							<input type="hidden" name="price[<?=$i;?>]" value=<?=$price[$i];?>>
   							<?php $i++ ?>
   						</tr>
   						<?php  } ?>
   						<tr>
   							<th scope="row"><button type="submit" name="order_confirm">Confirm Order</button></th>
   						</tr>
   					</form>
   					</tbody>
   				</table>
   			
	<?php 	}
exit(); ?>
