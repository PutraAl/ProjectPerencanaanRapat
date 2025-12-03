<?php 
include "../connection/server.php";
require_once("../connection/session.php");
middleware();

$id = $_SESSION['id_user'];

// Ambil data user
$query = mysqli_prepare($mysqli, "SELECT * FROM tb_user WHERE id_user = ?");
mysqli_stmt_bind_param($query, "i", $id);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);
$row = mysqli_fetch_assoc($result);

// Jika tombol edit ditekan
if (isset($_POST['edit'])) {
    $nama       = $_POST['nama'];
    $email      = $_POST['email'];
    $departemen = $_POST['departemen'];
    $jabatan    = $_POST['jabatan'];
    $telepon    = $_POST['telepon'];

    $update = mysqli_prepare($mysqli, 
        "UPDATE tb_user 
         SET nama_lengkap=?, email=?, departemen=?, jabatan=?, telepon=? 
         WHERE id_user=?"
    );

    mysqli_stmt_bind_param(
        $update,
        "sssssi",
        $nama, $email, $departemen, $jabatan, $telepon, $id
    );

    mysqli_stmt_execute($update);

    echo "<script>
            alert('Profil berhasil diperbarui!');
            window.location='profil.php';
          </script>";

if (mysqli_stmt_affected_rows($update) > 0) {
    echo "<script>
            alert('Profil berhasil diperbarui!');
            window.location='profil.php';
          </script>";
} else {
    echo "<script>
            alert('Tidak ada perubahan data!');
          </script>";
}
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perencanaan Rapat - profil</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/css/userpage.css">
</head>

<body>

    <!-- Tombol Hamburger -->
    <button class="hamburger" id="hamburgerBtn">☰</button>

    <div class="container-fluid d-flex p-0">

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">

            <div class="logo-section">
                <img src="../assets/img/poltek.png" alt="Logo" class="logo-img">
                <hr class="divider">
            </div>

            <div class="logo">Meeting Kampus</div>

            <ul class="menu">
                <li class="menu-item">
                    <i>📊</i>
                    <a href="dashboard.php">Dashboard</a>
                </li>

                <li class="menu-item">
                    <i>📨</i>
                    <a href="undangan.php">Undangan Rapat</a>
                </li>

                <li class="menu-item active">
                    <i>👤</i>
                    <a href="profil.php">Profil</a>
                </li>

                <li class="menu-item">
                    <i>🚪</i>
                    <a href="logout.php">Keluar</a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <!-- Main Content -->
        <div class="main-content">

            <div class="profile-container">

                <div class="card profile-card">

                    <!-- Header Profil -->
                    <div class="profile-header">
                        <div class="profile-avatar">U</div>

                        <div class="profile-info">
                            <h2>User</h2>
                            <p>Leader</p>
                        </div>
                    </div>

                    <!-- Form Profil -->
<form method="POST">

    <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" value="<?= $row['nama_lengkap']; ?>">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="<?= $row['email']; ?>">
    </div>

    <div class="form-group">
        <label for="department">Departemen</label>
        <input type="text" name="departemen" class="form-control" value="<?= $row['departemen']; ?>">
    </div>

    <div class="form-group">
        <label for="position">Jabatan</label>
        <input type="text" name="jabatan" class="form-control" value="<?= $row['jabatan']; ?>">
    </div>

    <div class="form-group">
        <label for="phone">Nomor Telepon</label>
        <input type="tel" name="telepon" class="form-control" value="<?= $row['telepon']; ?>">
    </div>

    <div class="form-group my-2">
        <button type="submit" name="edit" class="form-control btn-primary">
            Simpan Perubahan
        </button>
    </div>

</form>

                </div>

            </div>

        </div>
        <!-- End Main Content -->

    </div>

    <!-- JavaScript -->
    <script>
        const btn = document.getElementById("hamburgerBtn");
        const sidebar = document.querySelector(".sidebar");

        btn.addEventListener("click", () => {
            sidebar.classList.toggle("active");
        });
    </script>

</body>

</html>
