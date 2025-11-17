<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Rapat - Dashboard User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/userpage.css">

</head>

<body>
    <!-- Tombol Hamburger -->
    <button class="hamburger" onclick="toggleSidebar()">☰</button>

<!-- Halaman sidebar -->
        <div class="container">
        <div class="sidebar" id="sidebar">
            <div class="logo">Meeting Kampus</div>
            <ul class="menu">
                <li class="menu-item active">
                    <i>📊</i>
                    <a href="index.php">Dashboard</a>
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
                    <a href="../action/logout.php">Keluar</a>
                </li>
            </ul>
        </div>

        <!-- <div class="main-content">
            <div class="header">
                <h1 class="page-title">Dashboard</h1>
                    <div class="user-info">
                    <div class="user-avatar">U</div>
                    <span>User</span>
                </div> 
            </div> -->



        <div class="card mb-3 shadow-sm">
            <div class="row g-0">
                <div id="dashboard" class="page active">
                    <div class="stats-container">
                        <div class="stat-card">
                            <span class="stat-label">Total Rapat</span>
                            <span class="stat-value">7</span>
                            <span>+1 dari bulan lalu</span>
                        </div>
                        <div class="stat-card">
                            <span class="stat-label">Rapat Mendatang</span>
                            <span class="stat-value">3</span>
                            <span>Dalam 7 hari ke depan</span>
                        </div>
                    </div>
                </div>
                <!-- Rapat-Rapat -->
                <div class="card">
                    <h2 class="card-title">Rapat Mendatang</h2>
                    <ul class="meeting-list">
                        <li class="meeting-item">
                            <div>
                                <div class="meeting-title">Rapat Tim Pengembang</div>
                                <div class="meeting-time">Hari Ini, 10:00 - 11:30 • Ruang Rapat A</div>
                            </div>
                            <span class="badge badge-primary">Akan Datang</span>
                        </li>
                        <li class="meeting-item">
                            <div>
                                <div class="meeting-title">Review Proyek Q3</div>
                                <div class="meeting-time">Besok, 14:00 - 16:00 • Ruang Rapat B</div>
                            </div>
                            <span class="badge badge-primary">Akan Datang</span>
                        </li>
                        <li class="meeting-item">
                            <div>
                                <div class="meeting-title">Presentasi XYZ</div>
                                <div class="meeting-time">Jumat, 09:00 - 10:30 • Ruang Rapat C</div>
                            </div>
                            <span class="badge badge-primary">Akan Datang</span>
                        </li>
                    </ul>
                </div>

                <div class="card">
                    <h2 class="card-title">Rapat Terlaksana</h2>
                    <ul class="meeting-list">
                        <li class="meeting-item">
                            <div>
                                <div class="meeting-title">Briefing Tim Marketing</div>
                                <div class="meeting-time">Senin, 02 Sep 2023, 13:00 - 14:00</div>
                            </div>
                            <span class="badge badge-success">Selesai</span>
                        </li>

                        <li class="meeting-item">
                            <div>
                                <div class="meeting-title">Rapat Koordinasi Divisi</div>
                                <div class="meeting-time">Jumat, 30 Agu 2023, 09:00 - 11:00</div>
                            </div>
                            <span class="badge badge-success">Selesai</span>
                        </li>
                    </ul>
                </div>
            </div>
</body>
<script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("active");
        // const sidebar = document.getElementById("sidebar");
        // const btn = document.getElementById("hamburgerBtn");

        // sidebar.classList.toggle("active");

        // btn.textContent = sidebar.classList.contains("active") ?
        //     "✕" :
        //     "☰";

    }
</script>

</html>