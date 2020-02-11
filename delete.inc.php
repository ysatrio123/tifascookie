<?php

session_start();
if (!isset($_SESSION['useruid'])) {
	echo "You have to Login First";
	header("Location: ../index.php?error=notloggedin&uid=".$_SESSION['useruid']);
	exit();

}elseif (isset($_POST['order_delete'])){
	require 'dbh.inc.php';
	$delete_id = $_POST['order_id'];
	$delete_sql = "DELETE FROM cart WHERE cartid = $delete_id";
	$delete_execute = mysqli_query($conn,$delete_sql);

		if ($delete_execute) {
			header("Location: ../order.php?deletingitem=success");
			exit();
		}else{
			header("Location: ../order.php?deletingitem=failed");
			exit();
		}
}elseif (isset($_POST['order_confirm'])){
	foreach ($_POST['cart_data'] as $key => $value) {
		$order_id = $_POST['cart_data'];
		$final_quantity = $_POST['order_item_quantity'];
		echo $order_id[$key];
		echo $final_quantity[$key];
	}
}else{
	echo "nothing happened";
}