<?php

include 'init.php';

if (!isset($_SESSION['auth'])) {
  redirect('login');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HOME</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body style="background-color: #aac4f1;">
  <div class="container mt-5 text-center">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-5 text-secondary">
        <div class="card rounded-3 p-5" style="box-shadow: 0px 0px 20px rgb(0 0 0 / 30%);">
          <i class="bi bi-unlock-fill" style="font-size: 40px"></i>
          <h2 class="mt-3 text-secondary">You are logged in!</h2>
          <p class="mt-3">Username: <?php echo $_SESSION['auth']['username'] ?></p>
          <p>Email: <?php echo $_SESSION['auth']['email'] ?></p>
          <a href="logout.php" class="mt-2">Logout</a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>