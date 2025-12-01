<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perencanaan Rapat - User Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
                    <a href="dashboardnew.php">Dashboard</a>
                </li>

                <li class="menu-item">
                    <i>📨</i>
                    <a href="rapatnew.php">Rapat</a>
                </li>

                <li class="menu-item">
                    <i>👤</i>
                    <a href="profilnew.php">Profil</a>
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
            <td>Ayaraa</td>
            <td>ayaraaa</td>
            <td>auliyara@gmail.com</td>
            <td>Teknik Informatika</td>
            <td>Teknik Informatika</td>
            <td>
                <button class="view-btn btn btn-primary">View</button> <button class="edit-btn btn btn-success">Edit</button>
              </td>
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