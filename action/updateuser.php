<?php
include "../connection/server.php";
include "../middleware.php";


if (isset($_POST['edit'])) {
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $nama = mysqli_real_escape_string($mysqli, $_POST['nama']);
    $id_prodi = mysqli_real_escape_string($mysqli, $_POST['id_prodi']);
    $role = mysqli_real_escape_string($mysqli, $_POST['role']);
    $password = mysqli_real_escape_string($mysqli, md5($_POST['password']));

    $check = mysqli_query($mysqli, "SELECT * FROM tb_user where username ='$username'");
    $row = $check->fetch_assoc();
    if ($check->num_rows > 0) {
        echo "
        <script>
        alert('Username telah digunakan!');
        window.history.back();
        </script>
        ";
    } else {

        if($username != $row['username']) {
if($password != NULL || $password != '') {

            $updateUser = mysqli_query($mysqli, "UPDATE tb_user SET username ='$username', email = '$email', nama = '$nama', id_prodi = '$id_prodi', role = '$role', password = '$password' ");
            if ($updateUser) {
            echo "
            <script>
            alert('Berhasil Menambahkan Data');
            window.history.back();
            </script>
            ";
        } else {
            echo "
            <script>
            alert('Gagal Edit Data');
            window.history.back();
            </script>
            ";
        }
        }
        else {
            $updateUser = mysqli_query($mysqli, "UPDATE tb_user SET username ='$username', email = '$email', nama = '$nama', id_prodi = '$id_prodi', role = '$role' ");
            if ($updateUser) {
            echo "
            <script>
            alert('Berhasil Menambahkan Data');
            window.history.back();
            </script>
            ";
        } 
            else {
            echo "
            <script>
            alert('Gagal Edit Data');
            window.history.back();
            </script>
            ";
        }

        }
        }



        

    }
} else {
    echo "
        <script>
        alert('Gagal Edit Data');
        window.history.back();
        </script>
        ";
}