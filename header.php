	<div class="d-flex flex-column" id="myContent">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item" id="logo-header">
<?php 				if (!isset($_SESSION['level']) || $_SESSION['level'] == 'user') {?>
			 		<a class="navbar-brand" href="index.php"><img src="images/logo.png" class="img_size"></a>
<?php
			 		}else{?>
			 		<a class="navbar-brand" href="admin_index.php"><img src="images/logo.png" class="img_size"></a>
<?php
			 		}
?>
			 	</li>
<?php 			if (!isset($_SESSION['level'])) {?>
				<li class="nav-item">
<!-- 					<a class="nav-link active" href="how_to_use.php">How To Use</a> -->
				</li>	
<?php
				}elseif($_SESSION['level'] === 'admin'){
?>
				<li class="nav-item">
					<a class="nav-link active" href="admin_index.php">Order List</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="admin_modify.php">Modify Shop Items</a>
				</li>
<?php					
				}else{
?>
				<li class="nav-item">
					<a class="nav-link active" href="order.php">Shop</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="order_confirm.php">Shopping Cart</a>
				</li>	
				<li class="nav-item">
					<a class="nav-link active" href="order_status.php">Order Status</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="acc_setting.php">Account Setting</a>
				</li>
<?php
				}
?>
			</ul>
			<div>
		 		<?php
					if (isset($_SESSION['useruid'])) { ?>
						<form action="includes/logout.inc.php" method="post"><button type="submit" class="btn btn-warning" name="logout-submit">Logout</button></form>
					<?php }
					else { ?>
						<form action="includes/login.inc.php" method="post">
							<input type="text" name="mailuid" placeholder="E-mail">
							<input type="password" name="pwd" placeholder="Password">
							<button type="submit" name="login-submit" class="btn btn-success">Login</button>
							</form>
							<p class="navbar-text">Dont have an account ?</p> <a href="signup.php">Signup</a>
					<?php }
		 		?>
		 	</div>
		</nav>
	


