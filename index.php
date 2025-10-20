<?php 
include "connection/server.php";

if(isset($_POST['login'])) {
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password = mysqli_real_escape_string($mysqli, md5($_POST['password']));
    $checkLogin = mysqli_query($mysqli, "SELECT * FROM tb_user where username = '$username' AND password = '$password';");
    $checkRole = $checkLogin->fetch_assoc();

   

    if($checkLogin->num_rows>0) {
        $row = $checkLogin->fetch_assoc();
        $row['username'] = $_SESSION['username'];

        if($checkRole['role'] == 'admin') {
            $_SESSION['login'] = 'login';
                echo "
            <script>
            alert('Selamat anda berhasil Login sebagai Admin');
            window.location.href = 'admin/dashboard.php';
            </script>
            ";
        }
        elseif($checkRole['role'] == 'peserta') {
            $_SESSION['login'] = 'login';
             echo "
            <script>
            alert('Selamat anda berhasil Login sebagai Peserta');
            window.location.href = 'page/index.php';
            </script>
            ";
        }
    }
     else {
            echo "
            <script>
            alert('Username atau Password Salah!');
            </script>
            ";
        }
}
?>
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
        <form action="" method="post">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
        </form>
    </div>
  </div>

</body>
</html>
