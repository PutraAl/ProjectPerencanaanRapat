<?php 
include "../connection/server.php";

$nama = mysqli_real_escape_string($mysqli, $_POST['nama']);
$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$email = mysqli_real_escape_string($mysqli, $_POST['email']);
$password = mysqli_real_escape_string($mysqli, md5($_POST['password']));
$role = mysqli_real_escape_string($mysqli, ($_POST['role']));

$checkUsername = mysqli_query($mysqli, "SELECT * FROM tb_user where username = '$username'");

if($checkUsername->num_rows>0) {
    echo "
    <script>
    alert('Username telah digunakan, harap gunakan username yang lain');
    window.history.back();
    </script>
    ";
}
else {
    $query = mysqli_query($mysqli, "INSERT INTO tb_user VALUES (NULL, '$nama', '$username', '$email', '$password', '$role')");
    if($query) {
        echo "
        <script>
        alert('Berhasil menambahkan data');
        window.location.href ='../admin/user.php';
        </script>
        ";
    }
}
?>