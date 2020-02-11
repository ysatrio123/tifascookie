<?php
session_start();
require 'dbh.inc.php';
if (!isset($_SESSION['useruid'])) {
	echo "You Have To Login Before Proceed";
	header("Location: ../index.php?error=notloggedin");
	exit();
}elseif (isset($_POST['address-update'])) {
	$address_id = $_POST['order-id'];
	$new_address = htmlspecialchars($_POST['address-change']);
	$address_sql = "UPDATE cart SET user_address = '$new_address' WHERE purchase_id = '$address_id'";
	$address_result = mysqli_query($conn,$address_sql);
	if ($address_result) {
		$payment_sql = "UPDATE payment SET user_address = '$new_address' WHERE purchase_id = '$address_id'";
		$payment_result = mysqli_query($conn, $payment_sql);
		if ($payment_result) {
			header("Location: ../order_confirm.php?newaddressupdated");
			exit();
		}
	}else{
		header("Location: ../order_confirm.php?newaddresssqlerror");
		exit();
	}
}elseif(isset($_POST['cancel-order'])) {
		$order_delete = $_POST['order-id'];
		$sql_delete = "DELETE FROM cart WHERE purchase_id = '$order_delete'";
		$deleteresult = mysqli_query($conn,$sql_delete);
		if ($deleteresult) {
			$confirm_delete = "DELETE FROM payment WHERE purchase_id = '$order_delete'";
			$delconresult = mysqli_query($conn, $confirm_delete);
			if ($delconresult) {
				header("Location: ../order_confirm.php?deletesuccess");
				exit();
			}else{
				header("Location: ../order_confirm.php?secondcheckfailed");
				exit();
			}
		}else{
			header("Location: ../order_confirm.php?cancellingorderfailed");
			exit();
		}
	}elseif (isset($_POST['confirm-order'])) {
		$file = $_FILES['receipt'];
		$fileName = $file['name'];
		$fileTmpName = $file['tmp_name'];
		$fileSize = $file['size'];
		$fileError = $file['error'];
		$fileType = $file['type'];

		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));

		$allowed = array('jpg', 'jpeg', 'png');

		if ($_FILES["receipt"]["error"] != 0) {
			header("Location: ../order_confirm.php?receiptnotfound");
			exit();
		}elseif (in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 16777215) {
					$receipt = addslashes (file_get_contents($fileTmpName));
					$order_id = $_POST['order-id'];
					$status = 'verifying';
					$sql_confirm = "UPDATE payment SET payment_status = '$status', receipt = '$receipt' WHERE purchase_id = '$order_id'";
					$result = mysqli_query($conn,$sql_confirm);
					if ($result) {
						$sql_update = "UPDATE cart SET order_status = '$status' WHERE purchase_id = '$order_id'";
						$result2 = mysqli_query($conn, $sql_update);
						if ($result2) {
							header("Location: ../order_confirm.php?reconfirmationsuccess");
							exit();
						}else{
							header("Location: ../order_confirm.php?reconfirmationfailed");
							exit();
						}
						header("Location: ../order_confirm.php?confirmationsuccessfullyuploaded");
						exit();
					}else{
						echo "<pre>";
						var_dump($conn);
						echo "</pre>";
						header("Location: ../order_confirm.php?confirmationfailed&address=".$receipt);
						exit();
					}	
				}else{
					header("Location: ../order_confirm.php?sizetoobig");
					exit();
				}
			}else{
				header("Location: ../order_confirm.php?errorduringupload");
				exit();
			}
		}else{
			header("Location: ../order_confirm.php?extensionforbidden");
			exit();
		}
	}elseif (isset($_POST['order-success'])) {
	$id = $_POST['id'];
	$success_sql = "UPDATE payment SET payment_status = 'success' WHERE purchase_id = '$id'";
	$success_result = mysqli_query($conn,$success_sql);
	if ($success_result) {
		$cartsuccess_sql = "UPDATE cart SET order_status = 'success' WHERE purchase_id = '$id'";
		$cartsuccess_result = mysqli_query($conn,$cartsuccess_sql);
		if ($cartsuccess_result) {
			header("Location: ../order_status.php?orderreceivedthankyou");
			exit();
		}
	}else{
		header("Location: ../order_status.php?orderreceivedsqlerror");
		exit();
	}
}
		

