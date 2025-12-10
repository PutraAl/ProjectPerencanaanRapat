<?php 
include "../connection/server.php";
require_once "../connection/middleware.php" ;
middlewareAdmin();
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
  <link rel="stylesheet" href="//cdn.datatables.net/2.3.5/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="../assets/css/adminpagenew.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

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
          <a href="rapat.php">Rapat</a>
        </li>

        <li class="menu-item">
          <i>👤</i>
          <a href="profile.php">Profil</a>
        </li>

        <li class="menu-item active">
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
   

          <div class="border bg-white rounded p-3">
            <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#tambahuser">
              Tambah User
            </button>

            <table class="table table-responsive table-hover table-striped" id="myTable">
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
                    <button class="view-btn btn btn-sm btn-primary" data-bs-toggle="modal"
                      data-bs-target="#edituser-<?= $row['id_user'] ?>">
                      Edit
                    </button>
                  
                    <a href="../action/edit_user.php?id=<?= $row['id_user'] ?>" name="delete"
                      class="edit-btn btn btn-sm btn-danger">
                      Delete
                    </a>
                  </td>
                </tr>
                <!-- Modal edit user -->
                <div class="modal fade" id="edituser-<?= $row['id_user'] ?>" tabindex="-1"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <form action="../action/edit_user.php" method="POST">
                        <div class="modal-body">
                          <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
                          <label>Nama</label>
                          <input type="text" name="nama" class="form-control mb-2" value="<?= $row['nama'] ?>" required>

                          <label>Username</label>
                          <input type="text" name="username" class="form-control mb-2" value="<?= $row['username'] ?>"
                            required>

                          <label>Email</label>
                          <input type="email" name="email" class="form-control mb-2" value="<?= $row['email'] ?>"
                            required>

                          <label>Password</label>
                          <input type="password" name="password" class="form-control mb-2">

                          <label>Role</label>
                          <select name="role" class="form-control mb-2" required>
                            <option value="admin" <?= $row['role'] == 'admin' ? 'selected' : "" ?>>Admin</option>
                            <option value="peserta" <?= $row['role'] == 'peserta' ? 'selected' : "" ?>>Peserta</option>
                          </select>

                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="input" class="btn btn-primary">Simpan</button>
                        </div>
                      </form>

                    </div>
                  </div>
                </div>


                <?php
              $no++;
              }?>
              </tbody>
            </table>
          </div>


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
          <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
          <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
          <script src="//cdn.datatables.net/2.3.5/js/dataTables.min.js"></script>
          <script>
            let table = new DataTable('#myTable');
          </script>

</body>

</html>