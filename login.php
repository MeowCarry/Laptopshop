<?php
Session_start();
/** 
 * Nếu người dùng đã đăng nhập thì sẽ tồn tại $_SESSION['user_logged']
 * => isset($_SESSION['user_logged']) = TRUE
 * Nếu người dùng chưa đăng nhập thì sẽ ko tồn tại $_SESSION['user_logged']
 * => isset($_SESSION['user_logged']) = false
 */

/**
 * Nếu người dùng đa đăng nhập thì ko cho phép người dùng quay lại trang login
 */

if (isset($_SESSION['user_logged'])) {
	header("Location:home.php");
}


?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Đăng nhập</title>
    <link rel="stylesheet" href="css/login.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<script defer src="js/register.js"></script>	
</head>

<body>
	<div class="container">
		<div class="form" action="/">
			<h1>Customer</h1>
				<?php
				if (isset($_SESSION['error']['invalid_account'])) {
					echo $_SESSION['error']['invalid_account'];
					unset($_SESSION['error']['invalid_account']);
				}
				?>
				<form action="login-process.php" role="form" method="post">
					<fieldset>
						<div class="input-control">
						<label for="email">Email</label>
							<input id="email" placeholder="E-mail" name="cust_mail" type="email" autofocus>
							<?php
							if (isset($_SESSION['error']['cust_mail'])) {
								echo $_SESSION['error']['cust_mail'];
								unset($_SESSION['error']['cust_mail']);
							}
							?>
						</div>
						<div class="input-control">
						<label for="password">Mật khẩu</label>
							<input id="password" placeholder="Mật khẩu" name="cust_pass" type="password" value="">
							<?php
							if (isset($_SESSION['error']['cust_pass'])) {
								echo $_SESSION['error']['cust_pass'];
								unset($_SESSION['error']['cust_pass']);
							}
							?>

						</div>
						<div class="checkbox">
							<label>
								<input name="remember" type="checkbox" value="Remember Me">Nhớ tài khoản
							</label>
						</div>
						<button type="submit" >Đăng nhập</button>
					</fieldset>
				</form>
				<form action="register.php" role="form" method="post">
					<fieldset>
						<button type="submit" >Đăng kí</button>
					</fieldset>
				</form>
		</div><!-- /.col-->
	</div><!-- /.row -->

</body>

</html>