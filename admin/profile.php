<?php 
include "../connection/server.php";
require_once "../connection/middleware.php" ;
middlewareAdmin();
$id_user = $_SESSION['id_user'];
$data = mysqli_query($mysqli, "SELECT * FROM tb_user where id_user = '$id_user'")->fetch_array();


?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perencanaan Rapat - Profile Admin</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <link rel="stylesheet" href="../assets/css/adminpagenew.css">
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

      <div class="logo fs-4 text-center fw-bold">Meeting Kampus</div>

      <ul class="menu">
        <li class="menu-item">
          <i>📊</i>
          <a href="dashboard.php">Dashboard</a>
        </li>

        <li class="menu-item">
          <i>📨</i>
          <a href="rapat.php">Rapat</a>
        </li>

        <li class="menu-item active">
          <i>👤</i>
          <a href="profilenew.php">Profil</a>
        </li>

        <li class="menu-item">
          <i>👥</i>
          <a href="user.php">User</a>
        </li>

        <li class="menu-item">
          <i>🚪</i>
          <a href="../action/logout.php">Keluar</a>
        </li>

      </ul>
    </div>
    <!-- End Sidebar -->

    <!-- Main Content -->
    <div class="main-content">
      <div class="profile-container">
        <div class="card profile-card">

          <!-- Header -->
          <div class="header">
            <h2 class="page-title">Profile</h2>
            <div class="user-info">
              <span>Admin</span>
              <div class="use3r-avatar">A</div>
            </div>
          </div>

          <!-- Form Profil -->

          <div class="profile-card text-center mt-3">
            <!-- <img src="https://via.placeholder.com/120" alt="Profile Picture"> -->
            <h3 id="nameDisplay"><?= $data['nama'] ?></h3>
            <p id="emailDisplay"><?= $data['email'] ?></p>
            <p id="positionDisplay"><?= $data['role'] ?></p>

            <!-- Tombol Edit Profile di bawah tulisan Staff -->
            <button id="editProfileBtn" class="btn btn-primary" data-bs-toggle="modal"
              data-bs-target="#editProfileModal">Edit Profile</button>
          </div>

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
          <form action="../action/edit_profile_admin.php" method="post" id="editProfileForm">
            <input type="hidden" name="id_user" class="form-control" id="id_user" value="<?= $data['id_user'] ?>">
            <div class="mb-3">
              <label for="nameInput" class="form-label">Nama</label>
              <input type="text" name="nama" class="form-control" id="nameInput" value="<?= $data['nama'] ?>" required>
            </div>
            <div class="mb-3">
              <label for="nameInput" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" id="nameInput" value="<?= $data['username'] ?>"
                required>
            </div>
            <div class="mb-3">
              <label for="emailInput" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="emailInput" value="<?= $data['email'] ?>"
                required>
            </div>
            <div class="mb-3">
              <label for="emailInput" class="form-label">Password</label>
              <input type="text" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3">
              <label for="positionInput" class="form-label">Jabatan</label>
              <input type="text" class="form-control" id="positionInput" value="<?= $data['role'] ?>" readonly>
            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="input" class="btn btn-primary" id="saveProfileBtn">Simpan</button>
          </form>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
  </script>
  <script src="../assets/js/sidebar.js"></script>

  <script>
    // const btn = document.getElementById("hamburgerBtn");
    // const sidebar = document.querySelector(".sidebar");

    // btn.addEventListener("click", () => {
    //     sidebar.classList.toggle("active");
    // });

    // // -------------------------------
    // // Aksi tombol Simpan di Modal Edit
    // // -------------------------------
    // document.getElementById("saveProfileBtn").addEventListener("click", function () {

    //     let id_user = document.getElementById("id_user").innerText; 
    //     let nama     = document.getElementById("nameInput").value;
    //     let email    = document.getElementById("emailInput").value;
    //     let password = document.getElementById("password").value;

    //     // Siapkan data
    //     let formData = new FormData();
    //     formData.append("id_user", id_user);
    //     formData.append("nama", nama);
    //     formData.append("email", email);
    //     formData.append("password", password);

    //     // Kirim menggunakan fetch
    //     fetch("../action/edit_profile_admin.php", {
    //         method: "POST",
    //         body: formData
    //     })
    //     .then(response => response.text())
    //     .then(result => {
    //         console.log(result);

    //         // Jika sukses, tutup modal dan refresh halaman
    //         alert("Profil berhasil diperbarui!");
    //         location.reload();
    //     })
    //     .catch(error => {
    //         console.error("Error:", error);
    //         alert("Terjadi kesalahan, coba lagi.");
    //     });

    // });
  </script>


</body>

</html>