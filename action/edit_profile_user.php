<?php
include "../connection/server.php";
$id = $_SESSION['id_user'];
/* =======================
   PROSES UPDATE PROFIL
======================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // =======================
    // DATA FORM
    // =======================
    $nama     = mysqli_real_escape_string($mysqli, $_POST['nama']);
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $email    = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = trim($_POST['password']);

    // =======================
    // FOTO PROFIL
    // =======================
    $fotoBaru = null;

    if (!empty($_FILES['foto']['name'])) {

        $folder = "../assets/uploads/profile/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];

        if (!in_array($ext, $allowed)) {
            die("Format foto tidak valid");
        }

        if ($_FILES['foto']['size'] > 2 * 1024 * 1024) {
            echo "<script>
            alert('Ukuran foto tidak boleh lebih dari 2MB!');
            window.history.back();
        </script>";
            exit;
        }

        $fotoBaru = "user_{$id}_" . time() . "." . $ext;

        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $folder . $fotoBaru)) {
            die("Upload foto gagal");
        }

        // hapus foto lama
        $q = mysqli_query($mysqli, "SELECT foto FROM tb_user WHERE id_user='$id'");
        $old = mysqli_fetch_assoc($q);
        if (!empty($old['foto'])) {
            $oldPath = $folder . $old['foto'];
            if (file_exists($oldPath)) unlink($oldPath);
        }
    }

    // =======================
    // BUILD QUERY
    // =======================
    $set = [];
    $set[] = "nama = '$nama'";
    $set[] = "username = '$username'";
    $set[] = "email = '$email'";

    if (!empty($password)) {
        $passwordHash = md5($password);
        $set[] = "password = '$passwordHash'";
    }

    if (!empty($fotoBaru)) {
        $set[] = "foto = '$fotoBaru'";
    }

    $sql = "UPDATE tb_user SET " . implode(", ", $set) . " WHERE id_user='$id'";
    $update = mysqli_query($mysqli, $sql);

    if ($update) {
        header("Location: ../page/profil.php");
        exit;
    } else {
        die("Gagal update profil");
    }
}
