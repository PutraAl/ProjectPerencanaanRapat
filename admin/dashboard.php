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
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/rapat.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo-section">
                <img src="../assets/img/poltek.png" alt="Logo" class="logo-img">    
                <hr class="divider" />
            </div>

            <nav class="nav-menu">
                <a href="./dashboard.php" class="menu-item active">
                    <span class="icon">🏠</span>
                    <span class="label">Dashboard</span>
                </a>
                <a href="rapat.php" class="menu-item">
                    <span class="icon">📄</span>
                    <span class="label">Rapat</span>
                </a>
                <a href="user.php" class="menu-item">
                    <span class="icon">👤</span>
                    <span class="label">User</span>
                </a>
            </nav>

            <div class="bottom-profile">
                <hr class="divider" />
                <a href="profile.php" class="profile-link">
                    <span class="icon">⚫</span>
                    <span class="label">Profile</span>
                </a>
            </div>
        </aside>

        <main class="main-content">
            <h1 class="dashboard-title">Dashboard</h1>
            <div class="stats">
                <div class="card">
                    <h2>Total User</h2>
                    <p class="count"></p>
                </div>
                <div class="card">
                    <h2>Total Data</h2>
                    <p class="count"></p>
                </div>
            </div>
            <div class="description">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis at velit maximus, molestie est a, tempor magna.</p>
                <p>Integer ullamcorper neque eu purus euismod, ac facilisis massa placerat. Praesent facilisis, velit sit amet.</p>
                <p>Morbi a bibendum metus. Donec scelerisque sollicitudin enim eu venenatis. Duis tincidunt laoreet ex, in pretium orci.</p>
            </div>
        </main>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>
