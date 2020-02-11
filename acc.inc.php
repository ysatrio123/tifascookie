<?php
session_start();
require 'dbh.inc.php';

if (!isset($_SESSION['userid']) || $_SESSION['level'] === 'admin') {
	header("location: ../index.php?accessforbidden");
	exit();
}elseif (isset($_POST['name-submit'])) {
	$id = $_POST['id'];
	$new_name = $_POST['new-name'];
	$name_sql = "UPDATE users SET uidusers = '$new_name' WHERE idusers = $id";
	$name_result = mysqli_query($conn,$name_sql);
	if ($name_result) {
		header("Location: ../acc_setting.php?nameupdatesuccess");
		$_SESSION['useruid'] = $new_name;
		exit();
	}else{
		header("Location: ../acc_setting.php?nameupdatesqlerror");
		exit();
	}
}elseif (isset($_POST['mail-submit'])) {
	$id = $_POST['id'];
	$new_mail = $_POST['new-mail'];
	$check_sql = "SELECT * FROM users WHERE emailusers = '$new_mail'";
	$check_result = mysqli_query($conn, $check_sql);
	if (mysqli_num_rows($check_result) < 1) {
		$mail_sql = "UPDATE users SET emailusers = '$new_mail' WHERE idusers = $id";
		$mail_result = mysqli_query($conn,$mail_sql);
		if ($mail_result) {
			header("Location: ../acc_setting.php?mailupdatesuccess");
			exit();
		}else{
			header("Location: ../acc_setting.php?mailupdatefailed");
			exit();
		}
	}else{
		header("Location: ../acc_setting.php?mailalreadytaken");
		exit();
	}
}elseif (isset($_POST['phone-submit'])) {
	$id = $_POST['id'];
	$phone = $_POST['new-phone'];
	if (!preg_match("/^[0-9]*$/", $phone)) {
		header("Location: ../acc_setting.php?invalidphonenumber");
		exit();
	}else{
		$phone_sql = "UPDATE users SET phoneuser = '$phone' WHERE idusers = $id";
		$phone_result = mysqli_query($conn,$phone_sql);
		if ($phone_result) {
			header("Location: ../acc_setting.php?phoneupdatesuccess");
			exit();
		}else{
			header("Location: ../acc_setting.php?phoneupdatesqlerror");
			exit();
		}
	}
}elseif (isset($_POST['address-submit'])) {
	$id = $_POST['id'];
	$address = $_POST['new-address'];
	$address_sql = "UPDATE users SET addressuser = '$address' WHERE idusers = $id";
	$address_result = mysqli_query($conn,$address_sql);
	if ($address_result) {
		header("Location: ../acc_setting.php?addressupdatesuccess");
		exit();
	}else{
		header("Location: ../acc_setting.php?addressupdatesqlerror");
		exit();
	}
}elseif (isset($_POST['pwd-submit'])) {
	$id = $_POST['id'];
	$old_pwd = $_POST['old-pwd'];
	$new_pwd = $_POST['new-pwd'];
	$pwd_repeat = $_POST['pwd-repeat'];
	if (empty($old_pwd) || empty($new_pwd) || empty($pwd_repeat)) {
		header("Location: ../acc_setting.php?emptyfields");
		exit();
	}else{
		$pwd_sql = "SELECT * FROM users WHERE idusers = $id";
		$pwd_result = mysqli_query($conn,$pwd_sql);
		if ($row = mysqli_fetch_assoc($pwd_result)) {
			$pwdcheck = password_verify($old_pwd, $row['pwdusers']);
			if ($pwdcheck === false) {
				header("Location: ../acc_setting.php?error=wrongoldpassword");
				exit();
			}elseif($pwdcheck === true){
				if ($new_pwd != $pwd_repeat) {
					header("Location: ../acc_setting.php?error=newpasswordmismatch");
					exit();
				}else{
					$hashedpwd = password_hash($pwd_repeat, PASSWORD_DEFAULT);
					$realpwd_sql = "UPDATE users SET pwdusers = '$hashedpwd' WHERE idusers = $id";
					$realpwd_result = mysqli_query($conn,$realpwd_sql);
					if ($realpwd_result) {
					 	header("Location: ../acc_setting.php?updatepasswordsuccess");
					 	exit();
					}else{
						header("Location: ../acc_setting.php?error=pwdsqlerror");
						exit();
					} 
				}
			}
		}
	}
}