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
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<style>
  /* -- Responsive Hamburger -- */
.hamburger {
    display: none;
    font-size: 26px;
    font-weight: bold;
    background: var(--primary);
    color: var(--white);
    border: none;
    padding: 10px 12px;
    border-radius: 8px;
    cursor: pointer;
    position: fixed;
    top: 15px;
    left: 15px;
    z-index: 300;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.hamburger:active {
    transform: scale(0.95);
}

/* -- Responsive Sidebar -- */
.sidebar {
    transition: transform 0.3s ease-in-out;
}

.sidebar::-webkit-scrollbar {
    width: 6px;
}

.sidebar::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
}

.sidebar::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 3px;
}

/* -- Responsive Main Content -- */
.main-content {
    transition: all 0.3s ease-in-out;
}

.header {
    flex-wrap: wrap;
    gap: 15px;
}

/* -- Responsive Table Container -- */
.table-responsive-wrapper {
    overflow-x: auto;
    background: var(--white);
    border-radius: 8px;
    padding: 20px;
}

.table {
    width: 100%;
    margin-bottom: 0;
}

.table th,
.table td {
    white-space: nowrap;
    padding: 12px 15px;
}

/* -- Responsive Desktop (1024px ke atas) -- */
@media (min-width: 1024px) {
    .hamburger {
        display: none !important;
    }

    .sidebar {
        transform: translateX(0) !important;
    }

    .main-content {
        margin-left: 250px;
        padding: 40px;
        width: calc(100% - 250px);
    }

    .header {
        flex-wrap: nowrap;
    }

    .page-title {
        flex: 1;
    }

    .table-responsive-wrapper {
        overflow-x: auto;
    }
}

/* -- Responsive Tablet (768px - 1023px) -- */
@media (max-width: 1023px) {
    .hamburger {
        display: block;
    }

    .sidebar {
        width: 280px;
        position: fixed;
        left: 0;
        top: 0;
        height: 100vh;
        z-index: 200;
        transform: translateX(-100%);
    }

    .sidebar.active {
        transform: translateX(0);
    }

    .main-content {
        margin-left: 0;
        padding: 20px 15px;
        padding-top: 60px;
        width: 100%;
    }

    .header {
        padding: 15px;
        margin-bottom: 20px;
    }

    .page-title {
        font-size: 20px;
    }

    .table-responsive-wrapper {
        padding: 15px;
    }

    .table th,
    .table td {
        padding: 10px 8px;
        font-size: 13px;
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 11px;
    }
}

/* -- Responsive Mobile (481px - 767px) -- */
@media (max-width: 767px) {
    .hamburger {
        display: block;
        top: 10px;
        left: 10px;
        padding: 8px 10px;
        font-size: 22px;
    }

    .sidebar {
        width: 100%;
        max-width: 280px;
    }

    .logo {
        font-size: 20px;
    }

    .logo-img {
        width: 100px;
    }

    .menu-item {
        padding: 12px 20px;
        font-size: 14px;
    }

    .main-content {
        margin-left: 0;
        padding: 15px;
        padding-top: 55px;
        width: 100%;
    }

    .header {
        flex-direction: column;
        align-items: flex-start;
        padding: 12px;
        margin-bottom: 15px;
        gap: 10px;
    }

    .page-title {
        font-size: 18px;
        width: 100%;
    }

    .user-info {
        width: 100%;
        font-size: 14px;
    }

    .table-responsive-wrapper {
        padding: 10px;
        margin-bottom: 15px;
    }

    .table {
        font-size: 12px;
    }

    .table th,
    .table td {
        padding: 8px 5px;
        font-size: 12px;
    }

    .table th {
        font-size: 11px;
    }

    .btn-sm {
        padding: 4px 8px;
        font-size: 10px;
        margin: 2px;
    }
}

/* -- Extra Small Devices (max 480px) -- */
@media (max-width: 480px) {
    .hamburger {
        top: 8px;
        left: 8px;
        padding: 6px 8px;
        font-size: 20px;
    }

    .logo {
        font-size: 18px;
    }

    .logo-img {
        width: 80px;
    }

    .menu-item {
        padding: 10px 15px;
        font-size: 13px;
    }

    .menu-item i {
        font-size: 1em;
        margin-right: 8px;
    }

    .main-content {
        padding: 12px;
        padding-top: 50px;
    }

    .header {
        padding: 10px;
        margin-bottom: 12px;
        gap: 8px;
    }

    .page-title {
        font-size: 16px;
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        font-size: 14px;
    }

    .user-info {
        font-size: 12px;
    }

    .table-responsive-wrapper {
        padding: 8px;
    }

    .table {
        font-size: 11px;
    }

    .table th,
    .table td {
        padding: 6px 4px;
        font-size: 11px;
    }

    .table th {
        font-size: 9px;
    }

    .btn-sm {
        padding: 3px 6px;
        font-size: 9px;
        margin: 1px;
    }
}
</style>
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

      <!-- <ul class="menu"> -->   
        <li class="menu-item">
          <i class="fa-solid fa-chart-line"></i>
          <a href="dashboard.php">Dashboard</a>
        </li>

        <li class="menu-item">
          <i class="fa-solid fa-envelope"></i>
          <a href="rapat.php">Rapat</a>
        </li>

        <li class="menu-item">
          <i class="fa-solid fa-user"></i>
          <a href="profile.php">Profil</a>
        </li>

        <li class="menu-item active">
          <i class="fa-solid fa-user"></i>
          <a href="user.php">User</a>
        </li>

        <li class="menu-item">
          <i class="fa-solid fa-right-from-bracket"></i>
          <a href="../action/logout.php">Keluar</a>
        </li>
      <!-- </ul> -->
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


     <!-- Ganti bagian ini di file HTML Anda: -->

<div class="border bg-white rounded p-3">
    <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#tambahuser">
        Tambah User
    </button>

    <!-- Table Wrapper untuk Responsive -->
    <div class="table-responsive-wrapper">
        <table class="table table-hover table-striped" id="myTable">
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
                    <td>
                        <span class="badge bg-primary"><?= $row['role'] ?></span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                            <button class="view-btn btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#edituser-<?= $row['id_user'] ?>">
                                Edit
                            </button>

                            <a href="../action/edit_user.php?id=<?= $row['id_user'] ?>" name="delete"
                                class="edit-btn btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?');">
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>

                <!-- Modal edit user -->
                <div class="modal fade" id="edituser-<?= $row['id_user'] ?>" tabindex="-1"
                    aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel">Edit User - <?= $row['nama'] ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="../action/edit_user.php" method="POST">
                                <div class="modal-body">
                                    <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">

                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control mb-3" 
                                        value="<?= $row['nama'] ?>" required>

                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control mb-3" 
                                        value="<?= $row['username'] ?>" required>

                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control mb-3" 
                                        value="<?= $row['email'] ?>" required>

                                    <label>Password (Kosongkan jika tidak ingin mengubah)</label>
                                    <input type="password" name="password" class="form-control mb-3">

                                    <label>Role</label>
                                    <select name="role" class="form-control mb-3" required>
                                        <option value="admin" <?= $row['role'] == 'admin' ? 'selected' : "" ?>>Admin</option>
                                        <option value="peserta" <?= $row['role'] == 'peserta' ? 'selected' : "" ?>>Peserta</option>
                                    </select>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <?php
                    $no++;
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="tambahuser" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahModalLabel">Tambah User Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="../action/tambah_user.php" method="POST">
                <div class="modal-body">

                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control mb-3" required>

                    <label>Username</label>
                    <input type="text" name="username" class="form-control mb-3" required>

                    <label>Email</label>
                    <input type="email" name="email" class="form-control mb-3" required>

                    <label>Password</label>
                    <input type="password" name="password" class="form-control mb-3" required>

                    <label>Role</label>
                    <select name="role" class="form-control mb-3" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin">Admin</option>
                        <option value="peserta">Peserta</option>
                    </select>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah User</button>
                </div>
            </form>

        </div>
    </div>
</div>

      <script src="../assets/js/sidebar.js"></script>
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