<?php

session_start();

//initializing variables

$username = "";
$email = "";

$errors = array();

$db = mysqli_connect('localhost','root','','cookie') or die("could not connect to database");

//Registration

$username = mysqli_real_escape_string($db,$_POST['username']);
$email = mysqli_real_escape_string($db,$_POST['email']);
$password1 = mysqli_real_escape_string($db,$_POST['password_1']);
$password2 = mysqli_real_escape_string($db,$_POST['password_2']);

//validate the form

if (empty($username)) {array_push($errors,"Name is Required");}

if (empty($email)) {array_push($errors,"Email is Required");}

if (empty($password1)) {array_push($errors,"Username is Required");}

if ($password1 != $password2) {array_push($errors,"Your Password Do Not Match");}

//check database for existing username with the same username

$user_check_query = "SELECT * FROM tbl_login WHERE username = '$username' OR email = '$email' LIMIT 1";

$result = mysqli_query($db,$user_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) {
	if ($user['username'] === $username) {array_push($errors,"Name Is Already Taken");}
	if ($user['email'] === $email) {array_push($errors,"Email Is Already Taken");}
}

//valid registration

if (count($errors) == 0) {
	$password = md5($txtRegPass); //password encryption
	$query = "INSERT INTO tbl_login(username,email,password) VALUES('$username','$email','$password1')";

	mysqli_query($db,$query);
	$_SESSION['username'] = $username;
	$_SESSION['success'] = "You Are Now Logged In";

}

?>
