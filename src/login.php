<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<title>Login</title>
		<style>
			.bd-placeholder-img {
				font-size: 1.125rem;
				text-anchor: middle;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
			}
			@media (min-width: 768px) {
				.bd-placeholder-img-lg {
				font-size: 3.5rem;
				}
			}
		</style>
		<link href="sign-in.css" rel="stylesheet">
	</head>
	<body class="text-center">
		<form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<img class="mb-4" src="image/mask.png" alt="Logo" width="200" height="200">
			<h1 class="h3 mb-3 font-weight-normal">Employee Login</h1>
			<label for="email" class="sr-only">Email</label>
			<input type="email" name="email" class="form-control" placeholder="Email Address" required autofocus>
			<label for="password" class="sr-only">Password</label>
			<input type="password" name="password" class="form-control" placeholder="Password" required>
			<div class="checkbox mb-3">
				<label>
					<input type="checkbox" value="remember-me">&nbsp;Remember me
				</label>
			</div>
			<input type="submit" class="btn btn-lg btn-outline-dark btn-block" style="background-color: #00b388;" value="Login" name="login">
			<p class="mt-5 mb-3 text-muted">COVID Employee Tracker</p>
			<?php
				if(isset($_POST['login'])) {
					require 'config.php';
					$link = mysqli_connect("$host", "$username", "$password", "$db");
					if ($link == false) {
						die ("ERROR: Could not connect. " . mysqli_connect_error());
					}
					$email = mysqli_real_escape_string($link, $_REQUEST['email']);
					$pwd = mysqli_real_escape_string($link, $_REQUEST['password']);
					$sql = "SELECT * FROM employees WHERE email = '$email' AND pwd = '$pwd'";
					if($result = mysqli_query($link, $sql)) {
						if(mysqli_num_rows($result) == 1) {
							while($row = mysqli_fetch_array($result)) {
								$name = $row['name'];
								$email = $row['email'];
								$level = $row['level'];
								$_SESSION['name'] = $name;
								$_SESSION['email'] = $email;
								if($level == 0) {
									header('Location: ehome.php');
								} else if($level == 1) {
									header('Location: mhome.php');
								} else if($level == 2) {
									header('Location: smhome.php');
								} else {
									header('Location: dhome.php');
								}
							}		
						} else {
							echo "<div class=\"alert alert-danger\" role=\"alert\">Incorrect Credentials</div>";
						}
					} else {
						echo "Error : Unable to fetch information";
					}
					mysqli_free_result($result);
					mysqli_close($link);
				}
			?>
		</form>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>