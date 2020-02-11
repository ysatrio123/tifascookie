<!--  <?php 
$conn =mysqli_connect("localhost", "root", "","cookie");
if(isset($_POST['btnLoginSubmit']))
{
	$txtLoginEmail = $_POST['txtLoginEmail'];
	$txtLoginPass = $_POST['txtLoginPass'];

	$query = "select * from tbl_login where email_id='{$txtLoginEmail}' and password='{$txtLoginPass}'";
	$result = mysqli_query($conn,$query);

	if ($res=mysqli_fetch_array($result))
	{
		echo "<script>alert(\"Login Sucess\");</script>";
	}
	else
	{
		echo "<script>alert(\"Login Denied\");</script>";
	}
}
?> -->


<!-- <?php include('server.php') ?> -->

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container-fluid px-0 mt-3 mb-5">
	<div class="row mx-0">
		<div class="col-4 logo ">
			<a href="#"><img src="images/logo.png" class="img_size"></a>
		</div>

		<div class="col-4 pl-0">
			<div class="row h-100 align-items-center menu">
			</div>
	
		</div>

		<div class="col-4">
			<div class="row h-100">
				<div class="col-12">
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-4">
<!-- 				<div class="card login-panel">
					<div class="card-header">
						LOGIN
					</div>
					<div class="card-body">
						<form action="login.php" method="post">
							<div class="form-group">
								<label>Email</label>
								<input type="mail" name="txtLoginEmail" required class="form-control">
							</div>

							<div class="form-group">
								<label>Password</label>
								<input type="password" name="txtLoginPass" required class="form-control">
							</div>

							<div class="form-group">
								<button type="submit" name="btnLoginSubmit" class="form-control btn btn-success">Submit</button>
							</div>
						</form>
					</div>
				</div> -->
		</div>

		<div class="col-4">
			<div class="card reg-panel">
				<div class="card-header">
					Create An Account
				</div>
				<div class="card-body">
					<form action="login_dummy.php" method="post">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="username" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password_1" class="form-control" required>
						</div>

						<div class="form-group">
							<button type="submit" name="login_user" class="btn btn-success form-control">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid px-0">
	<div class="row px-0 mx-0 mt-5">
		<div class="col-12 px-0 slider2 text-center" style="background-image: url('images/slider2.jpg');">
			<p>Copyright &copy 2019 Johanes Satrio. All Rights Reserved.</p>
		</div>
	</div>
</div>

<script src="bootstrap/js/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="bootstrap/js/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.min.js" integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp" crossorigin="anonymous"></script>
</body>
</html>