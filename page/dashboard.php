<?php 
include "../connection/server.php";
include "../connection/session.php";
$id_user = $_SESSION['id_user'];
$totalUndangan = mysqli_query($mysqli, "SELECT * FROM tb_undangan WHERE id_peserta = '$id_user'");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perencanaan Rapat - Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <li class="menu-item active">
                    <i>📊</i>
                    <a href="dashboard.php">Dashboard</a>
                </li>

                <li class="menu-item">
                    <i>📨</i>
                    <a href="undangan.php">Undangan Rapat</a>
                </li>

                <li class="menu-item">
                    <i>👤</i>
                    <a href="profil.php">Profil</a>
                </li>

                <li class="menu-item">
                    <i>🚪</i>
                    <a href="<?= logout() ?>">Keluar</a>
                </li>
            </ul>

</div>
        <!-- End Sidebar -->

        <!-- Main Content -->
        <main class="main-content">

            <!-- Notifikasi -->
            <div class="alert alert-info shadow-sm mb-4">
                🔔 Anda memiliki <strong><?= $totalUndangan->num_rows <= 0 ? '0' : $totalUndangan->num_rows  ?> undangan rapat baru</strong>.  
                <a href="undangan.php" class="alert-link">Lihat sekarang</a>.
            </div>

            <!-- Shortcut -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="shortcut-card shadow-sm">
                        <i class="icon">🗓️</i>
                        <h5>Jadwal Rapat</h5>
                        <a href="jadwal.php">Lihat Jadwal →</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="shortcut-card shadow-sm">
                        <i class="icon">📝</i>
                        <h5>Notulen Rapat</h5>
                        <a href="notulen.php">Lihat Notulen →</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="shortcut-card shadow-sm">
                        <i class="icon">💻</i>
                        <h5>Ruang Virtual</h5>
                        <a href="virtual.php">Masuk Ruang →</a>
                    </div>
                </div>
            </div>

            <!-- Statistik -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <div class="label">Rapat Hari Ini</div>
                        <div class="value">2</div>
                        <span class="desc">Ada 2 rapat berlangsung</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <div class="label">Rapat Minggu Ini</div>
                        <div class="value">5</div>
                        <span class="desc">Total selama 7 hari</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <div class="label">Rapat Mendatang</div>
                        <div class="value">3</div>
                        <span class="desc">Dalam 7 hari ke depan</span>
                    </div>
                </div>
            </div>

            <!-- Rapat Mendatang -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Rapat Mendatang</h4>
                    <ul class="meeting-list">
                        <li class="meeting-item">
                            <div>
                                <div class="meeting-title">Rapat Tim Pengembang</div>
                                <div class="meeting-time">Hari Ini, 10:00 - 11:30 • Ruang A</div>
                            </div>
                            <span class="badge badge-upcoming">Akan Datang</span>
                        </li>

                        <li class="meeting-item">
                            <div>
                                <div class="meeting-title">Review Proyek Q3</div>
                                <div class="meeting-time">Besok, 14:00 - 16:00 • Ruang B</div>
                            </div>
                            <span class="badge badge-upcoming">Akan Datang</span>
                        </li>

                        <li class="meeting-item">
                            <div>
                                <div class="meeting-title">Presentasi XYZ</div>
                                <div class="meeting-time">Jumat, 09:00 - 10:30 • Ruang C</div>
                            </div>
                            <span class="badge badge-upcoming">Akan Datang</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Rapat Terlaksana -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Rapat Terlaksana</h4>
                    <ul class="meeting-list">

                        <li class="meeting-item">
                            <div>
                                <div class="meeting-title">Briefing Tim Marketing</div>
                                <div class="meeting-time">Senin, 02 Sep 2025, 13:00 - 14:00</div>
                            </div>
                            <span class="badge badge-success">Selesai</span>
                        </li>

                        <li class="meeting-item">
                            <div>
                                <div class="meeting-title">Rapat Koordinasi Divisi</div>
                                <div class="meeting-time">Jumat, 30 Agu 2025, 09:00 - 11:00</div>
                            </div>
                            <span class="badge badge-success">Selesai</span>
                        </li>

                    </ul>
                </div>
            </div>

        </main>
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
