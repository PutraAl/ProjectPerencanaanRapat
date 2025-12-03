<?php 
include "../connection/server.php";

if(isset($_POST['login'])) {
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password = mysqli_real_escape_string($mysqli, md5($_POST['password']));
    $checkLogin = mysqli_query($mysqli, "SELECT * FROM tb_user where username = '$username' AND password = '$password';");
    $checkRole = $checkLogin->fetch_assoc();


    if($checkLogin->num_rows>0) {
        $_SESSION['id_user'] = $checkRole['id_user'];
        $_SESSION['username'] = $checkRole['username'];
        $_SESSION['login'] = 'login';
        if($checkRole['role'] == 'admin') {
            echo "
            <script>
            alert('Selamat anda berhasil Login sebagai Admin');
            window.location.href = '../admin/dashboardnew.php';
            </script>
            ";
        }
        elseif($checkRole['role'] == 'peserta') {
             echo "
            <script>
            alert('Selamat anda berhasil Login sebagai Peserta');
            window.location.href = '../page/dashboard.php';
            </script>
            ";
        }
    }
     else {
            echo "
            <script>
            alert('Username atau Password Salah!');
            window.location.href = '../login.php';
            </script>
            ";
        }
}
?>