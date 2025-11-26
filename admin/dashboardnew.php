<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perencanaan Rapat - Dashboard Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/css/adminpagenew.css">
</head>

<body>

    <!-- Tombol Hamburger -->
    <button class="hamburger" id="hamburgerBtn">☰</button>

    <div class="container">

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
                    <a href="dashboardnew.php">Dashboard</a>
                </li>

                <li class="menu-item">
                    <i>📨</i>
                    <a href="rapatnew.php">Rapat</a>
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
        <!-- End Sidebar -->

    <!-- Main Content: Pengelolaan Data Rapat -->
<div class="main-content">

    <!-- Header -->
    <div class="header">
        <h2 class="page-title">Dashboard Admin</h2>

        <div class="user-info">
            <span>Admin</span>
            <div class="user-avatar">A</div>
        </div>
    </div>

    <!-- Top Bar: Search + Notification -->
    <div class="top-bar">
        <div class="search-box">
            <i class="search-icon">🔍</i>
            <input type="text" placeholder="Cari rapat...">
        </div>

        <div class="notif-icon">
            <i>🔔</i>
            <span class="notif-count" id="notifCount">2</span>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-value" id="todayMeetingCount">0</div>
            <div class="stat-label">Rapat Hari Ini</div>
        </div>

        <div class="stat-card">
            <div class="stat-value" id="weekMeetingCount">0</div>
            <div class="stat-label">Rapat Minggu Ini</div>
        </div>

        <div class="stat-card">
            <div class="stat-value" id="totalInvitation">0</div>
            <div class="stat-label">Undangan Masuk</div>
        </div>
    </div>

    <!-- Ringkasan Rapat Hari Ini -->
    <div class="card">
        <h3 class="card-title">Rapat Hari Ini</h3>
        <ul class="meeting-list" id="todayMeetingsList"></ul>
    </div>

    <!-- Ringkasan Rapat Minggu Ini -->
    <div class="card">
        <h3 class="card-title">Rapat Minggu Ini</h3>
        <ul class="meeting-list" id="weekMeetingsList"></ul>
    </div>

    <!-- Undangan Rapat -->
    <div class="card">
        <h3 class="card-title">Notifikasi Undangan</h3>

        <div class="meeting-grid" id="invitationGrid"></div>
    </div>

    <!-- Shortcut -->
    <div class="stats-container">
        <div class="stat-card">
            <h3 class="stat-label">Jadwal Rapat</h3>
        </div>

        <div class="stat-card">
            <h3 class="stat-label">Notulen Rapat</h3>
        </div>

        <div class="stat-card">
            <h3 class="stat-label">Ruang Virtual</h3>
        </div>
    </div>

</div>


   <!-- JavaScript -->
    <script>
        const btn = document.getElementById("hamburgerBtn");
        const sidebar = document.querySelector(".sidebar");

        btn.addEventListener("click", () => {
            sidebar.classList.toggle("active");
        });
    </script>

</body>

</html>