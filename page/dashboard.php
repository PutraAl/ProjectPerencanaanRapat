<?php 
include "../connection/server.php";
require_once "../action/data_user.php";
require_once "../connection/middleware.php";
middlewareUser();

$id_user = $_SESSION['id_user'];

// Data user khusus header
$queryUser = mysqli_query(
    $mysqli,
    "SELECT nama, foto FROM tb_user WHERE id_user = '$id_user'"
);
$user = mysqli_fetch_assoc($queryUser);

// Judul halaman
$pageTitle = "Dashboard";
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perencanaan Rapat - Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <img src="../assets/img/poltek.png" alt="Logo" class="logo-img">
                <hr class="divider">
            </div>

            <div class="logo fs-4 text-center fw-bold">Meeting Kampus</div>

            <!-- <ul class="menu"> -->   
                <li class="menu-item active">
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

                <li class="menu-item">
                    <i class="fa-solid fa-user"></i>
                    <a href="profil.php">Profil</a>
                </li>

                <li class="menu-item">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <a href="../action/logout.php">Keluar</a>
                </li>
            <!-- </ul> -->
        </div>
        <!-- End Sidebar -->

        <!-- Main Content -->
        <main class="main-content">

            <!-- Notifikasi -->
            <div class="alert alert-info shadow-sm mb-4">
                <i class="fa-solid fa-bell me-1"></i> Anda memiliki <strong><?= $totalUndangan->num_rows <= 0 ? '0' : $totalUndangan->num_rows  ?> undangan rapat baru</strong>.  
                <a href="undangan.php" class="alert-link">Lihat sekarang</a>.
            </div>

            <!-- Header -->
            <?php include "header.php"; ?>

 
            <!-- Statistik -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <div class="label">Rapat Hari Ini</div>
                        <div class="value"><?= $rapatToday->num_rows ?></div>
                        <span class="desc">Ada <?= $rapatToday->num_rows ?> rapat berlangsung</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <div class="label">Rapat Minggu Ini</div>
                        <div class="value"><?= $rapatMinggu->num_rows ?></div>
                        <span class="desc">Total selama 7 hari</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <div class="label">Rapat Mendatang</div>
                        <div class="value"><?= $rapatMendatang->num_rows ?></div>
                        <span class="desc">Dalam beberapa hari ke depan</span>
                    </div>
                </div>
            </div>

            <!-- Shortcut -->
            <!-- <div class="row g-3 mb-4">
               <div class="col-md-6">
                    <div class="shortcut-card shadow-sm">
                        <i class="fa-regular fa-calendar-days icon"></i>
                        <h5>Jadwal Rapat</h5>
                        <a href="jadwal.php">Lihat Jadwal →</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="shortcut-card shadow-sm">
                        <i class="fa-solid fa-file-lines icon"></i>
                        <h5>Notulen Rapat</h5>
                        <a href="notulen.php?list=1">Lihat Notulen →</a>
                    </div>
                </div>
</div> -->

                <!-- <div class="col-md-4">
                    <div class="shortcut-card shadow-sm">
                        <i class="icon">💻</i>
                        <h5>Ruang Virtual</h5>
                        <a href="virtual.php">Masuk Ruang →</a>
                    </div>
                </div>
            </div> -->


            <!-- Rapat Mendatang -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Rapat Mendatang</h4>
                    <ul class="meeting-list">
                        <?php 
                        while ($row = $rapatMendatang->fetch_array()) {
                        ?>
                        <li class="meeting-item">
                            <div>
                                <div class="meeting-title"><?= $row['judul'] ?></div>
                                <div class="meeting-time"><?= $row['tanggal'] ?>, <?= $row['waktu'] ?> • <?= $row['lokasi'] ?></div>
                            </div>
                            <span class="badge badge-upcoming">Akan Datang</span>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <!-- Rapat Terlaksana -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Rapat Terlaksana</h4>
                    <ul class="meeting-list">
                        <?php 
                        while ($row = $rapatSelesai->fetch_array()) {
                        ?>

                        <li class="meeting-item">
                            <div>
                                <div class="meeting-title"><?= $row['judul'] ?></div>
                                <div class="meeting-time"><?= $row['tanggal'] ?>, <?= $row['waktu'] ?></div>
                            </div>
                            <span class="badge badge-success">Selesai</span>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
            </div>

                     


    <script>
        const btn = document.getElementById("hamburgerBtn");
        const sidebar = document.getElementById("sidebar");

        btn.addEventListener("click", () => {
            sidebar.classList.toggle("active");
        });
    </script>

</body>

</html>
