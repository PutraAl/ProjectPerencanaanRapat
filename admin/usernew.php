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
          <button 
              class="view-btn btn btn-primary"
              data-nama="Ayaraa"
              data-username="ayaraaa"
              data-email="auliyara@gmail.com"
              data-jurusan="Teknik Informatika"
              data-prodi="Teknik Informatika"
          >
              View
          </button>

          <button 
              class="edit-btn btn btn-success"
              data-id="1"
              data-nama="Ayaraa"
              data-username="ayaraaa"
              data-email="auliyara@gmail.com"
              data-prodi="Teknik Informatika"
          >
              Edit
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<div class="modal fade" id="viewUserModal" tabindex="-1">
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
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
  </script>
  
  <script>
  // ========== VIEW USER ==========
  document.querySelectorAll(".view-btn").forEach(btn => {
    btn.addEventListener("click", function () {

      document.getElementById("viewNama").textContent = this.dataset.nama;
      document.getElementById("viewUsername").textContent = this.dataset.username;
      document.getElementById("viewEmail").textContent = this.dataset.email;
      document.getElementById("viewJurusan").textContent = this.dataset.jurusan;
      document.getElementById("viewProdi").textContent = this.dataset.prodi;

      new bootstrap.Modal(document.getElementById("viewUserModal")).show();
    });
  });


  // ========== EDIT USER ==========
  document.querySelectorAll(".edit-btn").forEach(btn => {
    btn.addEventListener("click", function () {
      
      document.getElementById("editId").value = this.dataset.id;
      document.getElementById("editNama").value = this.dataset.nama;
      document.getElementById("editUsername").value = this.dataset.username;
      document.getElementById("editEmail").value = this.dataset.email;
      document.getElementById("editProdi").value = this.dataset.prodi;

      new bootstrap.Modal(document.getElementById("editUserModal")).show();
    });
  });
</script>

</body>

</html>