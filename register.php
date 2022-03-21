<?php

include 'init.php';
include "crud.php";

$_SESSION['errors'] = '<i class="bi bi-exclamation-circle-fill"></i> Please enter your username, email and password';
$_SESSION['successful'] = '* Your account has been created successfully';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if (
		isset($_POST['uname']) && isset($_POST['password'])
		&& isset($_POST['email']) && isset($_POST['re_password'])
	) {

		$uname = $_POST['uname'];
		$pass = $_POST['password'];

		$re_pass = $_POST['re_password'];
		$email = $_POST['email'];

		if (!($uname && $pass && $re_pass && $email)) {
			$errors['errors'] = '';
		} else {

			$pass = md5($pass);
			$sql = "SELECT * FROM users WHERE username='$uname' ";
			$result = mysqli_query($conn, $sql);
			$sql2 = "INSERT INTO users(username, password, email) VALUES('$uname', '$pass', '$email')";
			$result2 = mysqli_query($conn, $sql2);

			if ($result2) {
				$errors['successful'] = '';
			} else {
				echo "Please fill out all your data";
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
					<h2 class="text-center" style="color: #618edd;">SIGN UP</h2>
					<form action="register.php" method="POST">
						<div class="form-group mt-3">
							<label for="username" class="form-label">Username</label>
							<input type="text" name="uname" id="username" class="form-control" placeholder="Enter your username ..."><br>

							<label for="email" class="form-label">Email</label>
							<input type="email" name="email" id="email" class="form-control" placeholder="Enter your email ..."><br>

							<label for="password" class="form-label">Password</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="Enter your password ..."><br>

							<label for="re-password" class="form-label">Confirm Password</label>
							<input type="password" name="re_password" id="re_password" class="form-control" placeholder="Confirm your password ...">
							<?php if (isset($errors['errors'])) : ?>
								<br>
								<span class="text-danger"><?php echo $_SESSION['errors'] ?></span>
							<?php endif; ?>
							<?php if (isset($errors['successful'])) : ?>
								<br>
								<span class="text-primary"><?php echo $_SESSION['successful'] ?></span>
							<?php endif; ?>
							<div class="mt-4">
								<button type="submit" class="btn btn-primary">Signup</button>
							</div>
							<p class="mt-3 text-center text-muted">Already have an account! <a href="login.php">Login</a></p>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

</html>