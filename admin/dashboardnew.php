<?php 
include "../connection/server.php";
$username = $_SESSION['username'];
$allUser = mysqli_query($mysqli, "SELECT * FROM tb_user where role != 'admin' ");
$allRapat = mysqli_query($mysqli, "SELECT * FROM tb_rapat ");
$allUndangan = mysqli_query($mysqli, "SELECT * FROM tb_undangan");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perencanaan Rapat - Dashboard Admin</title>

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

                <li class="menu-item">
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

        <!-- Main Content: Pengelolaan Data Rapat -->
        <div class="main-content">

            <!-- Header -->
            <div class="header">
                <h2 class="page-title">Dashboard Admin</h2>

                <div class="user-info">
                    <span><?=  $username ?></span>
                    <div class="user-avatar">A</div>
                </div>
            </div>

            <!-- Stats -->
            <div class="stats-container">
                <a href="usernew.php" style="text-decoration: none;">
                    <div class="stat-card" >
                        <div class="stat-value" id="todayMeetingCount"><?= $allUser->num_rows ?></div>
                        <div class="stat-label">Total User</div>
                    </div>
                </a>
                <a href="rapat.php" style="text-decoration: none;">
                <div class="stat-card">
                    <div class="stat-value" id="weekMeetingCount"><?= $allRapat->num_rows ?></div>
                    <div class="stat-label">Total Rapat</div>
                </div>
                </a>
                <div class="stat-card">
                    <div class="stat-value" id="totalInvitation"><?= $allUndangan->num_rows ?></div>
                    <div class="stat-label">Total Undangan</div>
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