<?php
include "../connection/server.php";
include "../middleware.php";


if (isset($_POST['tambah'])) {
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $nama = mysqli_real_escape_string($mysqli, $_POST['nama']);
    $id_prodi = mysqli_real_escape_string($mysqli, $_POST['id_prodi']);
    $role = mysqli_real_escape_string($mysqli, $_POST['role']);
    $password = mysqli_real_escape_string($mysqli, md5($_POST['password']));

    $check = mysqli_query($mysqli, "SELECT * FROM tb_user where username ='$username'");
    if ($check->num_rows > 0) {
        echo "
        <script>
        alert('Username telah digunakan!');
        window.history.back();
        </script>
        ";
    } else {

        $insertUser = mysqli_query($mysqli, "INSERT INTO tb_user (username, email, nama, id_prodi, role, password) VALUES ('$username', '$email', '$nama', '$id_prodi', '$role', '$password')");

        if ($insertUser) {
            echo "
            <script>
            alert('Berhasil Menambahkan Data');
            window.history.back();
            </script>
            ";
        } else {
            echo "
            <script>
            alert('Gagal Menambah Data');
            window.history.back();
            </script>
            ";
        }
    }
} else {
    echo "
        <script>
        alert('Gagal Menambah Data');
        window.history.back();
        </script>
        ";
}
