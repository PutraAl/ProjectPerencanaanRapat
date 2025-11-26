<?php 
// include "../connection/server.php";
// include "../middleware.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manajemen User</title>
  <link rel="stylesheet" href="../assets/css/rapat.css" />
  <link rel="stylesheet" href="../assets/css/user.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <!-- SIDEBAR -->
    <aside class="sidebar">
      <div class="logo-section">
        <img src="../assets/img/poltek.png" alt="Logo" class="logo-img" />
        <hr class="divider" />
      </div>

       <nav class="nav-menu">
        <a href="dashboard.php" class="menu-item">
          <span class="icon">🏠</span>
          <span class="label">Dashboard</span>
        </a>
        <a href="rapat.php" class="menu-item">
          <span class="icon">📄</span>
          <span class="label">Rapat</span>
        </a>
        <a href="user.php" class="menu-item active">
          <span class="icon">👤</span>
          <span class="label">User</span>
        </a>
      </nav>

      <div class="bottom-profile">
        <hr class="divider" />
        <a href="./profile.php" class="profile-link">
          <span class="icon">⚫</span>
          <span class="label">Profile</span>
        </a>
      </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
      <div class="user-header">
        <h1 class="user-title">User Management</h1>
        <button class="add-btn" id="addUserBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">＋</button>
      </div>

        <div class="border bg-white rounded p-3">
       <table class="table table-responsive table-hover table-striped">
        <thead class="table-primary">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>Jurusan</th>
            <th>Prodi</th>
            <!-- <th>Role</th> -->
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="userTableBody">
          <tr>
            <td>1</td>
            <td>s</td>
            <td>ssadas</td>
            <td>ssadas</td>
            <td>ssadas</td>
            <td>ssadas</td>
            <td>ssadas</td>
          </tr>
        </tbody>
      </table>
              </div>
    </main>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="userForm" method="post" action="../action/insertuser.php">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="email">Prodi</label>
            <select name="id_prodi" class="form-control" id="" required>
              <option value="" selected disabled>Pilih Jurusan</option>
            
            </select>

            <label for="role">Role</label>
            <select name="role" id="" class="form-control" required>
              <option selected disabled>Pilih Role!</option>
              <option value="admin">Admin</option>
              <option value="peserta">Peserta</option>
            </select>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="tambah" class="btn save-btn btn-success">Tambah</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
  </script>

</body>

</html>