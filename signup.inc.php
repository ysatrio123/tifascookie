<?php
if (isset($_POST['signup-submit'])) {
	
	require 'dbh.inc.php';

	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$username = $_POST['uid'];
	$email = $_POST['mail'];
	$password = $_POST['pwd'];
	$passwordrepeat = $_POST['pwd-repeat'];
	$level = 'user';

	if (empty($username) || empty($email) || empty($password) || empty($passwordrepeat) || empty($phone) || empty($address) ) {
		header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
		exit();
	}

	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/, $username")) {
		header("Location: ../signup.php?error=invalidmailuid");
		exit();
	}

	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../signup.php?error=invalidmail&uid=".$username);
		exit();
	}

	elseif (!preg_match("/^[a-zA-Z0-9\\s]*$/", $username)) {
		header("Location: ../signup.php?error=invaliduid&mail=".$email);
		exit();
	}

	elseif (!preg_match("/^[0-9]*$/", $phone)) {
		header("Location: ../signup.php?error=invalidphone&mail=".$email."&uid=".$uid);
		exit();
	}

	elseif ($password !== $passwordrepeat) {
		header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
		exit();
	}

	else{

		$sql = "SELECT uidusers FROM users WHERE uidusers=? AND emailusers=?";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../signup.php?error=sqlerror");
		exit();
		}

		else{
			mysqli_stmt_bind_param($stmt,"ss", $username, $email);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultcheck = mysqli_stmt_num_rows($stmt);
			if ($resultcheck > 0) {
				header("Location: ../signup.php?error=usertaken&mail=".$email);
				exit();
			}
			else{

				$sql = "INSERT INTO users (level, uidusers, emailusers, pwdusers, phoneuser, addressuser) VALUES (?, ?, ?, ?, ?, ?)";

				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("Location: ../signup.php?error=sqlerror");
					exit();
				}
					else{

						$hashedpwd = password_hash($password, PASSWORD_DEFAULT);

						mysqli_stmt_bind_param($stmt,"ssssss",$level, $username, $email, $hashedpwd, $phone, $address);
						mysqli_stmt_execute($stmt);
						header("Location: ../signup.php?signup=success");
						exit();	
					}

			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}

else {
	header("Location: ../signup.php");
	exit();
}
