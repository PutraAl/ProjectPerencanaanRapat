
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

  <div class="row login text-center shadow">
    <div class="image col-12 col-md-6 ">
        <img src="assets/img/Polibatam.png" alt="">
    </div>
    <div class="col-12 col-md-6">

        <h2 class="mb-4 fw-bold mb-5">Login Form</h2>
        <form action="action/login.php" method="post">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="mb-3 register">
                <label for="" class="form-label ">Does'nt have account? 
                    <a href="register.php">Register now</a>

                </label>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
        </form>
    </div>
  </div>

</body>
</html>
