<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
	<header>
		<body>
		<nav class="navbar navbar-dark bg-dark">
		 	<a class="navbar-brand" href="#"><img src="images/logo.png" class="img_size"></a>

			<a href="#">test</a>
			<a href="#">test</a>	

		 	<div>

		 		<form action="includes/login.inc.php" method="post">
		 			<input type="text" name="mailuid" placeholder="Username/E-mail">
		 			<input type="password" name="pwd" placeholder="Password">
		 			<button type="submit" name="login-submit">Login</button>
		 		</form>

		 		<a href="signup.php">Signup</a>
		 		<form action="includes/logout.inc.php" method="post">
		 			<button type="submit" name="logout-submit">Logout</button>
		 		</form>

		 	</div>
		</nav>
	</header>
