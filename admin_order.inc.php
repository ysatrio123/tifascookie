<?php
session_start();
require 'dbh.inc.php';
if ($_SESSION['level'] != 'admin') {
	header("Location: ../index.php?accessdenied");
	exit();
}elseif (isset($_POST['verify-order'])) {
	$id = $_POST['id'];
	$verify_sql = "UPDATE payment SET payment_status = 'approved' WHERE purchase_id = '$id'";
	$verify_result = mysqli_query($conn,$verify_sql);
	if ($verify_result) {
		$cart_sql = "UPDATE cart SET order_status = 'approved' WHERE purchase_id = '$id'";
		$cart_result = mysqli_query($conn,$cart_sql);
		if ($cart_result) {
			header("Location: ../admin_index.php?verifysuccess");
			exit();
		}
	}else{
		header("Location: ../admin_index.php?verifysqlerror");
		exit();
	}
}elseif (isset($_POST['decline-order'])) {
	$id = $_POST['id'];
	$decline_sql = "UPDATE payment SET payment_status = 'declined' WHERE purchase_id = '$id'";
	$decline_result = mysqli_query($conn,$decline_sql);
	if ($decline_result) {
		$cartdecline_sql = "UPDATE cart SET order_status = 'declined' WHERE purchase_id = '$id'";
		$cartdecline_result = mysqli_query($conn,$cartdecline_sql);
		if ($cartdecline_result) {
			header("Location: ../admin_index.php?declineordersuccess");
			exit();
		}
	}else{
		header("Location: ../admin_index.php?declineordersqlerror");
		exit();
	}
}elseif (isset($_POST['cooking-order'])) {
	$id = $_POST['id'];
	$cooking_sql = "UPDATE payment SET payment_status = 'baking' WHERE purchase_id = '$id'";
	$cooking_result = mysqli_query($conn,$cooking_sql);
	if ($cooking_result) {
		$cartcooking_sql = "UPDATE cart SET order_status = 'baking' WHERE purchase_id = '$id'";
		$cartcooking_result = mysqli_query($conn,$cartcooking_sql);
		if ($cartcooking_result) {
			header("Location: ../admin_index.php?orderreadytobake");
			exit();
		}
	}else{
		header("Location: ../admin_index.php?orderbakesqlerror");
		exit();
	}
}elseif (isset($_POST['send-submit'])) {
	$id = $_POST['id'];
	$couriertype = $_POST['order-courier'];
	$tracknumber = $_POST['track-number'];
	$updatecourier = $couriertype.$tracknumber;
	$courier_sql = "UPDATE payment SET payment_status = 'sending' , transport = '$updatecourier' WHERE purchase_id = '$id'";
	$courier_result = mysqli_query($conn,$courier_sql);
	if ($courier_result) {
		$cartcourier_sql = "UPDATE cart SET order_status = 'sending' WHERE purchase_id = '$id'";
		$cartcourier_result = mysqli_query($conn,$cartcourier_sql);
		if ($cartcourier_result) {
			header("Location: ../admin_index.php?sendingordersuccess");
			exit();
		}
	}else{
		header("Location: ../admin_index.php?sendingordersqlerror");
		exit();
	}
}