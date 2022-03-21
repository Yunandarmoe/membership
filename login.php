<?php

include "crud.php";
include "init.php";

if (isset($_SESSION['auth'])) {
	redirect('home');
}

$_SESSION['errors'] = '<i class="bi bi-exclamation-circle-fill"></i> Username, email and password is required!';
$_SESSION['incorrect'] = '<i class="bi bi-exclamation-circle-fill"></i> Wrong username, email and password. Try again!';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$uname = $_POST['uname'];
	$email = $_POST['email'];
	$pass = $_POST['password'];

	if (isset($_POST['uname']) && isset($_POST['email']) && isset($_POST['password'])) {
		if (!$uname && !$pass && !$email) {
			$errors['require'] = '';
		} else {
			$pass = md5($pass);
			$sql = "SELECT * FROM users WHERE username='$uname' AND password='$pass' AND email='$email'";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) === 1) {
				$row = mysqli_fetch_assoc($result);
				$_SESSION['auth'] = [
					'username' => $uname,
					'email' => $email,
					'password' => $pass
				];
				header('location: home.php');
			} else {
				$errors['incorrect'] = '';
			}
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Form</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body style="background-color: #aac4f1;">
	<div class="container mt-5">
		<div class="row d-flex justify-content-center">
			<div class="col-lg-5">
				<div class="card rounded-3 p-4" style="box-shadow: 0px 0px 20px rgb(0 0 0 / 30%);">
					<h2 class="text-center" style="color: #618edd;">LOGIN</h2>
					<form action="login.php" method="POST">
						<div class="form-group mt-3">
							<label for="username" class="form-label">Username</label>
							<input type="text" name="uname" id="username" class="form-control" placeholder="Enter your username ..."><br>

							<label for="email" class="form-label">Email</label>
							<input type="email" name="email" class="form-control" placeholder="Enter your email ..."><br>

							<label for="username" class="form-label">Password</label>
							<input type="password" name="password" class="form-control" placeholder="Enter your password ...">
							<?php if (isset($errors['require'])) : ?>
								<br>
								<span class="text-danger"><?php echo $_SESSION['errors'] ?></span>
							<?php endif; ?>
							<?php if (isset($errors['incorrect'])) : ?>
								<br>
								<span class="text-danger"><?php echo $_SESSION['incorrect'] ?></span>
							<?php endif; ?>
							<div class="mt-4">
								<button type="submit" class="btn btn-primary">Login</button>
							</div>
						</div>
						<p class="mt-4 text-center text-muted">Not a member? <a href="register.php">Sign Up</a></p>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

</html>