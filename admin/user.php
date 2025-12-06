<?php 
include "../connection/server.php";
$id_user = $_SESSION['id_user'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perencanaan Rapat - User Admin</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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

      <div class="logo">Meeting Kampus</div>

      <ul class="menu">
        <li class="menu-item">
          <i>📊</i>
          <a href="dashboardnew.php">Dashboard</a>
        </li>

        <li class="menu-item">
          <i>📨</i>
          <a href="rapat.php">Rapat</a>
        </li>

        <li class="menu-item">
          <i>👤</i>
          <a href="profilenew.php">Profil</a>
        </li>

        <li class="menu-item active">
          <i>👥</i>
          <a href="usernew.php">User</a>
        </li>

        <li class="menu-item">
          <i>🚪</i>
          <a href="../action/logout.php">Keluar</a>
        </li>

      </ul>
    </div>
    <!-- End Sidebar -->
    <!-- MAIN CONTENT -->
    <main class="main-content">
      <!-- Header -->
      <div class="header">
        <h2 class="page-title">User Management</h2>

        <div class="user-info">
          <span>Admin</span>
          <div class="user-avatar">A</div>
        </div>
      </div>
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="mb-3">🔍 Filter & Pencarian Rapat</h5>
          <form action="" method="GET" id="filterForm">
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="tanggal_dari" class="form-label">Tanggal Dari</label>
                <input type="date" name="tanggal_dari" id="tanggal_dari" class="form-control"
                  value="<?= $filterTanggalDari ?>">
              </div>
              <div class="col-md-3 mb-3">
                <label for="tanggal_sampai" class="form-label">Tanggal Sampai</label>
                <input type="date" name="tanggal_sampai" id="tanggal_sampai" class="form-control"
                  value="<?= $filterTanggalSampai ?>">
              </div>
              <div class="col-md-3 mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                  <option value="">Semua Status</option>
                  <option value="dijadwalkan" <?= $filterStatus == 'dijadwalkan' ? 'selected' : '' ?>>Dijadwalkan
                  </option>
                  <option value="selesai" <?= $filterStatus == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                  <option value="dibatalkan" <?= $filterStatus == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                </select>
              </div>
              <div class="col-md-3 mb-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary flex-fill">🔍 Filter</button>
                <a href="rapat.php" class="btn btn-secondary flex-fill">🔄 Reset</a>
              </div>
            </div>
          </form>

          <div class="border bg-white rounded p-3">
            <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#tambahuser">
              Tambah User
            </button>

            <table class="table table-responsive table-hover table-striped">
              <thead class="table-primary">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody id="userTableBody">
                <?php 
                $no = 1;
                $data = mysqli_query($mysqli, "SELECT * FROM tb_user WHERE id_user != '$id_user' ORDER BY nama ASC");
                while($row = $data->fetch_array()) {
                ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $row['nama'] ?></td>
                  <td><?= $row['username'] ?></td>
                  <td><?= $row['email'] ?></td>
                  <td><?= $row['role'] ?></td>
                  <td>
                    <button class="view-btn btn btn-sm btn-primary">
                      Edit
                    </button>

                    <button class="edit-btn btn btn-sm btn-danger">
                      Delete
                    </button>
                  </td>
                </tr>
                <?php
              $no++;
              }?>
              </tbody>
            </table>
          </div>

          <!-- <div class="modal fade" id="viewUserModal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Detail User</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                  <p><b>Nama:</b> <span id="viewNama"></span></p>
                  <p><b>Username:</b> <span id="viewUsername"></span></p>
                  <p><b>Email:</b> <span id="viewEmail"></span></p>
                  <p><b>Jurusan:</b> <span id="viewJurusan"></span></p>
                  <p><b>Prodi:</b> <span id="viewProdi"></span></p>
                </div>

                <div class="modal-footer">
                  <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="editUserModal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title">Edit User</h5>
                  <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="editUserForm" action="../action/updateuser.php" method="POST">
                  <div class="modal-body">

                    <label>ID User</label>
                    <input type="text" name="id_user" id="editId" class="form-control" readonly>

                    <label>Nama</label>
                    <input type="text" name="nama" id="editNama" class="form-control">

                    <label>Username</label>
                    <input type="text" name="username" id="editUsername" class="form-control">

                    <label>Email</label>
                    <input type="email" name="email" id="editEmail" class="form-control">

                    <label>Prodi</label>
                    <input type="text" name="prodi" id="editProdi" class="form-control">

                  </div>

                  <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success" type="submit">Simpan</button>
                  </div>

                </form>
              </div>
            </div>
          </div> -->


          <!-- Modal Tambah User -->
          <div class="modal fade" id="tambahuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">

                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="../action/tambah_user.php" method="POST">
                  <div class="modal-body">

                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control mb-2" required>

                    <label>Username</label>
                    <input type="text" name="username" class="form-control mb-2" required>

                    <label>Email</label>
                    <input type="email" name="email" class="form-control mb-2" required>

                    <label>Password</label>
                    <input type="password" name="password" class="form-control mb-2" required>

                    <label>Role</label>
                    <select name="role" class="form-control mb-2" required>
                      <option value="admin">Admin</option>
                      <option value="peserta">Peserta</option>
                    </select>

                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>

              </div>
            </div>
          </div>


          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
          </script>

          <script>
            // // ========== VIEW USER ==========
            // document.querySelectorAll(".view-btn").forEach(btn => {
            //   btn.addEventListener("click", function () {

            //     document.getElementById("viewNama").textContent = this.dataset.nama;
            //     document.getElementById("viewUsername").textContent = this.dataset.username;
            //     document.getElementById("viewEmail").textContent = this.dataset.email;
            //     document.getElementById("viewJurusan").textContent = this.dataset.jurusan;
            //     document.getElementById("viewProdi").textContent = this.dataset.prodi;

            //     new bootstrap.Modal(document.getElementById("viewUserModal")).show();
            //   });
            // });


            // // ========== EDIT USER ==========
            // document.querySelectorAll(".edit-btn").forEach(btn => {
            //   btn.addEventListener("click", function () {

            //     document.getElementById("editId").value = this.dataset.id;
            //     document.getElementById("editNama").value = this.dataset.nama;
            //     document.getElementById("editUsername").value = this.dataset.username;
            //     document.getElementById("editEmail").value = this.dataset.email;
            //     document.getElementById("editProdi").value = this.dataset.prodi;

            //     new bootstrap.Modal(document.getElementById("editUserModal")).show();
            //   });
            // });
          </script>

</body>

</html>