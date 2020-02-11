<?php
session_start();
require 'dbh.inc.php';
if ($_SESSION['level'] != 'admin') {
	header("Location: ../index.php?accessdenied");
	exit();
}elseif (isset($_POST['submit-image'])) {
	$file = $_FILES['item-image'];
	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileError = $file['error'];
	$fileType = $file['type'];
	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));
	$allowed = array('jpg', 'jpeg', 'png');

	if ($_FILES["item-image"]["error"] != 0) {
		header("Location: ../admin_modify.php?receiptnotfound");
		exit();
	}elseif (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			if ($fileSize < 16777215) {
				$image = addslashes (file_get_contents($fileTmpName));
				$id = $_POST['id'];
				$image_sql = "UPDATE item SET itemimage = '$image' WHERE itemid = $id";
				$image_result = mysqli_query($conn,$image_sql);
				if ($image_result) {
					header("Location: ../admin_modify.php?imagesuccessfullyupdated");
					exit();
				}else{
					header("Location: ../admin_modify.php?updatingimagefailed&id=".$id);
					exit();
				}
			}else{
				header("Location: ../admin_modify.php?sizetoobig");
				exit();
			}
		}else{
			header("Location: ../admin_modify.php?errorduringupload");
			exit();
		}
	}else{
		header("Location: ../admin_modify.php?extensionforbidden&ext=");
		exit();
	}
}elseif (isset($_POST['submit-price'])) {
	$price = $_POST['price'];
	$id = $_POST['id'];
	$price_sql = "UPDATE item SET itemprice = $price WHERE itemid = $id";
	$price_result = mysqli_query($conn,$price_sql);
	if ($price_result) {
		header("Location: ../admin_modify.php?settingpricesuccess");
		exit();
	}else{
		header("Location: ../admin_modify.php?settingpricefailed");
		exit();
	}
}elseif (isset($_POST['submit-name'])) {
	$name = $_POST['item-name'];
	$id = $_POST['id'];
	$name_sql = "UPDATE item SET itemname = '$name' WHERE itemid = $id";
	$name_result = mysqli_query($conn,$name_sql);
	if ($name_result) {
		header("Location: ../admin_modify.php?updatenamesuccess");
		exit();
	}else{
		header("Location: ../admin_modify.php?updatenamefailed");
		exit();
	}
}elseif (isset($_POST['submit-new-item'])) {
	$itemname = $_POST['newitemname'];
	$itemprice = $_POST['newitemprice'];

	$file = $_FILES['newitemimage'];
	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileError = $file['error'];
	$fileType = $file['type'];
	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));
	$allowed = array('jpg', 'jpeg', 'png');
	if ($_FILES["item-image"]["error"] != 0) {
		header("Location: ../admin_modify.php?receiptnotfound");
		exit();
	}elseif (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			if ($fileSize < 16777215) {
				$image = addslashes (file_get_contents($fileTmpName));
				$newitem_sql = "INSERT INTO item (itemname, itemprice, itemimage) VALUES ('$itemname', $itemprice, '$image')";
				$newitem_result = mysqli_query($conn,$newitem_sql);
				if ($newitem_result) {
					header("Location: ../admin_modify.php?itemsuccessfullyadded");
					exit();
				}else{
					header("Location: ../admin_modify.php?addnewitemslqerror");
					exit();
				}
			}else{
				header("Location: ../admin_modify.php?sizetoobig");
				exit();
			}
		}else{
			header("Location: ../admin_modify.php?errorduringupload");
			exit();
		}
	}else{
		header("Location: ../admin_modify.php?extensionforbidden&ext=");
		exit();
	}
}elseif (isset($_POST['delete-submit'])) {
	$id = $_POST['id'];
	$delete_sql = "DELETE FROM item WHERE itemid = $id";
	$delete_result = mysqli_query($conn, $delete_sql);
	if ($delete_result) {
		header("Location: ../admin_modify.php?deleteitemsuccess");
		exit();
	}else{
		header("Location: ../admin_modify.php?deleteitemsqlerror");
		exit();
	}
}