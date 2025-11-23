<?php 
// include "../connection/server.php";
// include "../middleware.php";
// $allRapat = mysqli_query($mysqli, "SELECT * FROM tb_rapat");
// $allUser = mysqli_query($mysqli, "SELECT * FROM tb_user where role ='peserta'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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
                    <i>🏠</i>
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="menu-item">
                    <i>📄</i>
                    <a href="undangan.php">Rapat</a>
                </li>
                <li class="menu-item">
                    <i>👤</i>
                    <a href="profil.php">User</a>
                </li>
                <li class="menu-item">
                    <i>🚪</i>
                    <a href="../action/logout.php">Keluar</a>
                </li>
            </ul>
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