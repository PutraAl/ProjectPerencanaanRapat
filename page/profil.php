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
    $nama   = $_POST['nama'];
    $email  = $_POST['email'];

    $update = mysqli_prepare($mysqli, 
        "UPDATE tb_user 
         SET nama = ?, email = ?
         WHERE id_user = ?"
    );

    mysqli_stmt_bind_param(
        $update,
        "ssi",
        $nama, $email, $id
    );

    mysqli_stmt_execute($update);

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
            <form id="profileForm" method="POST" action="update_profile.php">

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" class="form-control" value="User" readonly>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" value="user.user@company.com" readonly>
                </div>

                <div class="form-group">
                    <label for="department">Departemen</label>
                    <input type="text" id="department" class="form-control" value="Teknik Informatika" readonly>
                </div>

                <div class="form-group">
                    <label for="position">Jabatan</label>
                    <input type="text" id="position" class="form-control" value="Ketua" readonly>
                </div>

                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="tel" id="phone" class="form-control" value="081234567890" readonly>
                </div>

                <!-- Tombol (default hanya EDIT yang muncul) -->
                <div class="form-group my-2" id="buttonArea">
                    <button type="button" id="btnEdit" class="form-control btn-primary">Edit</button>

                    <div id="editActions" class="d-none mt-2">
                        <button type="submit" id="btnSave" class="btn btn-success w-100 mb-2">Simpan</button>
                        <button type="button" id="btnCancel" class="btn btn-secondary w-100">Batal</button>
                    </div>
                </div>

            </form>
        </div>

    </div>

</div>
<!-- End Main Content -->


<!-- JavaScript -->
<script>
    const btn = document.getElementById("hamburgerBtn");
    const sidebar = document.querySelector(".sidebar");

    btn?.addEventListener("click", () => {
        sidebar.classList.toggle("active");
    });

    // ===========================
    // LOGIC UNTUK EDIT PROFIL
    // ===========================

    const editBtn = document.getElementById("btnEdit");
    const cancelBtn = document.getElementById("btnCancel");
    const saveBtn = document.getElementById("btnSave");
    const editActions = document.getElementById("editActions");

    const inputs = document.querySelectorAll("#profileForm input");

    // Simpan nilai awal (untuk tombol batal)
    let initialValues = {};

    editBtn.addEventListener("click", () => {

        // Simpan data awal
        inputs.forEach(input => {
            initialValues[input.id] = input.value;
        });

        // Aktifkan input
        inputs.forEach(input => {
            input.removeAttribute("readonly");
        });

        // Sembunyikan tombol Edit, tampilkan tombol Simpan & Batal
        editBtn.classList.add("d-none");
        editActions.classList.remove("d-none");
    });

    cancelBtn.addEventListener("click", () => {

        // Kembalikan nilai awal
        inputs.forEach(input => {
            input.value = initialValues[input.id];
            input.setAttribute("readonly", true);
        });

        // Kembalikan tampilan tombol
        editBtn.classList.remove("d-none");
        editActions.classList.add("d-none");
    });

</script>


</body>

</html>
