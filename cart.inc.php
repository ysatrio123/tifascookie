<?php
session_start();

if (!isset($_SESSION['useruid'])) {
	echo "You have to Login First";
	header("Location: ../index.php?error=notloggedin&uid=".$_SESSION['useruid']);
	exit();

}elseif (isset($_POST['cart-submit'])) {
	require 'dbh.inc.php';
	$tz = 'Asia/Jakarta';
	$timestamp = time();
	$dt = new DateTime("Now", new DateTimeZone($tz));
	$dt -> setTimestamp($timestamp);
	$orderdate =  $dt->format('Y-m-d');
	$torder = $dt->format('Hi');
	$dorder = $dt->format('dYm');
	
	$user_id = $_SESSION['userid'];
	$item_id = $_POST['item-id'];
	if (empty($item_id)) {
		header("Location: ../order.php?emptycart");
		exit();
	}
	
	$item_price = $_POST['item-price'];
	$item_name = $_POST['item-name'];
	$item_quantity = $_POST['item-quantity'];
	$cart_sql = "SELECT * FROM users WHERE idusers=?";
	$cart_stmt = mysqli_stmt_init($conn);
	$counter = 0;
	$total_quantity = 0;
	$total_id_cart = 0;
	foreach ($item_id as $key => $value) {
						$total_quantity += $item_quantity[$key];
						$total_id_cart += $item_id[$key];
					}
	$digits = 8;
    $rnumber=str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
    $a = $total_quantity;
    $b = $a.$total_id_cart;
    $c = $torder.$dorder;
    $d = $c.$b;
    $purchase_id = $d.$rnumber;				

		if (!mysqli_stmt_prepare($cart_stmt,$cart_sql)) {
			header("Location: ../order.php?error=sqlerror");
			exit();

		}else{
			mysqli_stmt_bind_param($cart_stmt,"i",$user_id);
			$cart_execute = mysqli_stmt_execute($cart_stmt);
			$cart_result = mysqli_stmt_get_result($cart_stmt);

			while ($cart_row = mysqli_fetch_assoc($cart_result)) {
				$username = $cart_row['uidusers'];
				$useraddress = $cart_row['addressuser'];
				$userphone = $cart_row['phoneuser'];
				$total_payment = 0;
				foreach ($item_id as $key => $value) {
					$total_price = $item_price[$key] * $item_quantity[$key];
					$order_status = 'pending';
					$add_sql = "INSERT INTO cart (purchase_id, user_id, user_name, user_address, user_phone, item_name, item_quantity, item_price, total_price, order_date, order_status) VALUES ($purchase_id, $user_id, '$username', '$useraddress', '$userphone', '$item_name[$key]', $item_quantity[$key], $item_price[$key], $total_price, '$orderdate', '$order_status')";
					$add_cart_to_db = mysqli_query($conn,$add_sql);
					$total_payment += $total_price;
					if ($add_cart_to_db) {
						$counter++;
					}
				}
				if (count($item_id) === $counter) {
					$transport = 'TBD';
					$confirm_sql = "INSERT INTO payment(purchase_id , user_id, user_name, phone_number, user_address, total_payment, payment_status, transport) VALUES ('$purchase_id', $user_id, '$username', '$userphone', '$useraddress', '$total_payment', '$order_status','$transport')";
					$result = mysqli_query($conn, $confirm_sql);
					if ($result) {
						header("Location: ../order_confirm.php?addingitemstocart=success&orderid=".$purchase_id);
						exit();
					}
				}else{
					header("Location: ../order.php?addingitemstocart=failed");
					exit();
				}
			}
		}
}
					
