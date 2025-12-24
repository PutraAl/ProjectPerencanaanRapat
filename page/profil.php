<?php
include "../connection/server.php";
require_once "../connection/middleware.php";
middlewareUser();

$id = $_SESSION['id_user'];

/* =======================
   PROSES UPDATE PROFIL
======================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama     = mysqli_real_escape_string($mysqli, $_POST['nama']);
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $email    = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = $_POST['password'];

    // Jika password diisi → update dengan password
    if (!empty($password)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $update = mysqli_query($mysqli, "
            UPDATE tb_user SET
                nama = '$nama',
                username = '$username',
                email = '$email',
                password = '$passwordHash'
            WHERE id_user = '$id'
        ");
    } 
    // Jika password kosong → jangan update password
    else {
        $update = mysqli_query($mysqli, "
            UPDATE tb_user SET
                nama = '$nama',
                username = '$username',
                email = '$email'
            WHERE id_user = '$id'
        ");
    }

    if ($update) {
        echo "<script>
                alert('Profil berhasil diperbarui');
                window.location.href='profil.php';
              </script>";
        exit;
    } else {
        echo "<script>alert('Gagal update profil');</script>";
    }
}

/* =======================
   AMBIL DATA USER
======================= */
$query = mysqli_query($mysqli, "SELECT * FROM tb_user WHERE id_user = '$id'");
$row = mysqli_fetch_assoc($query);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

    <!-- Tombol Hamburger -->
    <button class="hamburger" id="hamburgerBtn">☰</button>

    <div class="container-fluid d-flex p-0">


    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo-section">
            <img src="../assets/img/polteklogo.png" class="logo-img">
            <hr class="divider">
        </div>

        <div class="logo">Meeting Kampus</div>

        <!-- <ul class="menu"> -->
            <li class="menu-item">
                <i class="fa-solid fa-chart-line"></i>
                <a href="dashboard.php">Dashboard</a>
            </li>

            <li class="menu-item">
                <i class="fa-solid fa-envelope"></i>
                <a href="undangan.php">Rapat</a>
            </li>

            <li class="menu-item">
                <i class="fa-solid fa-file-lines"></i>
                <a href="notulen.php">Notulen</a>
            </li>

            <li class="menu-item active">
                <i class="fa-solid fa-user"></i>
                <a href="profil.php">Profil</a>
            </li>

            <li class="menu-item">
                <i class="fa-solid fa-right-from-bracket"></i>
                <a href="logout.php">Keluar</a>
            </li>
        <!-- </ul> -->
    </div>
    <!-- End Sidebar -->

        <!-- Main Content -->
<div class="main-content">


<!-- header -->
<div class="header">
    <h2 class="page-title">Profil User</h2>

    <div class="user-info">
        <span><?= htmlspecialchars($row['nama']) ?></span>
        <div class="user-avatar"><?= substr($row['nama'], 0, 3) ?></div>
    </div>
</div>

          <!-- Form Profil -->
<div class="card profile-card shadow-sm mt-4">
  <div class="card-body text-center">

    <!-- Avatar / Foto -->
    <?php if (!empty($row['foto'])): ?>
      <img src="../assets/uploads/profile/<?= htmlspecialchars($row['foto']) ?>" 
           class="profile-img mb-3">
    <?php else: ?>
      <div class="profile-avatar mb-3 mx-auto">
        <?= strtoupper(substr($row['nama'], 0, 1)) ?>
      </div>
    <?php endif; ?>

    <h4 class="fw-bold"><?= htmlspecialchars($row['nama']) ?></h4>
    <p class="text-muted"><?= htmlspecialchars($row['email']) ?></p>

    <span class="badge bg-primary mb-3">
      <?= htmlspecialchars($row['role']) ?>
    </span>

    <div class="mt-3">
      <button class="btn btn-outline-primary btn-sm"
        data-bs-toggle="modal" data-bs-target="#editProfileModal">
        <i class="fa fa-pen"></i> Edit Profil
      </button>
    </div>

  </div>
</div>

    <!-- End Main Content -->


  </div>

  <!-- Modal Edit Profile -->
  <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="editProfileLabel">Edit Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form action="../page/profil.php" method="post" id="editProfileForm">
            <input type="hidden" name="id_user" class="form-control" id="id_user" value="<?= $row['id_user'] ?>">
            <div class="mb-3">
              <label for="nameInput" class="form-label">Nama</label>
              <input type="text" name="nama" class="form-control" id="nameInput" value="<?= $row['nama'] ?>" required>
            </div>
            <div class="mb-3">
              <label for="nameInput" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" id="nameInput" value="<?= $row['username'] ?>"
                required>
            </div>
            <div class="mb-3">
              <label for="emailInput" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="emailInput" value="<?= $row['email'] ?>"
                required>
            </div>
            <div class="mb-3">
              <label for="emailInput" class="form-label">Password</label>
              <input type="text" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3">
              <label for="positionInput" class="form-label">Jabatan</label>
              <input type="text" class="form-control" id="positionInput" value="<?= $row['role'] ?>" readonly>
            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary" id="saveProfileBtn">Simpan</button>
          </form>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
  </script>
  <script src="../assets/js/sidebar.js"></script>

  


<!-- JavaScript -->
<script src="../assets/js/profiluser.js"></script>


</body>

</html>
