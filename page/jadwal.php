<?php
include "../connection/server.php";
require_once "../connection/middleware.php";
middlewareUser();

$id_user = $_SESSION['id_user'];
$today = date('Y-m-d');

/* =======================
   QUERY STATISTIK
======================= */

// Rapat Hari Ini
$qToday = mysqli_query($mysqli, "
    SELECT COUNT(*) AS total
    FROM tb_undangan u
    JOIN tb_rapat r ON u.id_rapat = r.id_rapat
    WHERE u.id_peserta = '$id_user'
      AND u.status_kehadiran = 'hadir'
      AND r.tanggal = '$today'
");
$rapatToday = mysqli_fetch_assoc($qToday)['total'];

// Rapat Minggu Ini
$qWeek = mysqli_query($mysqli, "
    SELECT COUNT(*) AS total
    FROM tb_undangan u
    JOIN tb_rapat r ON u.id_rapat = r.id_rapat
    WHERE u.id_peserta = '$id_user'
      AND u.status_kehadiran = 'hadir'
      AND r.tanggal BETWEEN '$today' AND DATE_ADD('$today', INTERVAL 7 DAY)
");
$rapatMinggu = mysqli_fetch_assoc($qWeek)['total'];

// Rapat Mendatang (LIST)
$rapatMendatang = mysqli_query($mysqli, "
    SELECT r.judul, r.tanggal, r.waktu
    FROM tb_undangan u
    JOIN tb_rapat r ON u.id_rapat = r.id_rapat
    WHERE u.id_peserta = '$id_user'
      AND u.status_kehadiran = 'hadir'
      AND r.tanggal > '$today'
    ORDER BY r.tanggal ASC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Rapat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/userpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

<button class="hamburger" id="hamburgerBtn">☰</button>

<div class="container-fluid d-flex p-0">

<!-- ================= SIDEBAR ================= -->
<div class="sidebar" id="sidebar">
    <div class="logo-section">
        <img src="../assets/img/polteklogo.png" class="logo-img">
        <hr class="divider">
    </div>

    <div class="logo">Meeting Kampus</div>

        <li class="menu-item">
            <i class="fa-solid fa-chart-line"></i>
            <a href="dashboard.php">Dashboard</a>
        </li>

        <li class="menu-item">
            <i class="fa-solid fa-envelope"></i>
            <a href="undangan.php">Undangan Rapat</a>
        </li>

        <li class="menu-item active">
            <i class="fa-regular fa-calendar-days"></i>
            <a href="jadwal.php">Jadwal Rapat</a>
        </li>

        <li class="menu-item">
            <i class="fa-solid fa-user"></i>
            <a href="profil.php">Profil</a>
        </li>

        <li class="menu-item">
            <i class="fa-solid fa-right-from-bracket"></i>
            <a href="logout.php">Keluar</a>
        </li>
</div>

<!-- ================= MAIN CONTENT ================= -->
<main class="main-content">

<!-- Header -->
<div class="page-header d-flex align-items-center mb-4">
    <a href="dashboard.php" class="back-link me-3">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <h2 class="page-title mb-0">Jadwal Rapat Saya</h2>
</div>

<!-- Statistik -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card shadow-sm">
            <div class="label">Rapat Hari Ini</div>
            <div class="value"><?= $rapatToday ?></div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card shadow-sm">
            <div class="label">Rapat Minggu Ini</div>
            <div class="value"><?= $rapatMinggu ?></div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card shadow-sm">
            <div class="label">Rapat Mendatang</div>
            <div class="value"><?= mysqli_num_rows($rapatMendatang) ?></div>
        </div>
    </div>
</div>

<!-- Rapat Mendatang -->
<div class="card">
    <h2 class="card-title">Rapat Mendatang</h2>

    <?php if (mysqli_num_rows($rapatMendatang) > 0): ?>
        <ul class="meeting-list">
            <?php while ($row = mysqli_fetch_assoc($rapatMendatang)): ?>
                <li class="meeting-item d-flex justify-content-between align-items-center">
                    <div>
                        <div class="meeting-title">
                            <?= htmlspecialchars($row['judul']) ?>
                        </div>
                        <div class="meeting-datetime">
                            <?= date('d M Y', strtotime($row['tanggal'])) ?> |
                            <?= htmlspecialchars($row['waktu']) ?>
                        </div>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p class="no-meetings">Tidak ada rapat mendatang.</p>
    <?php endif; ?>
</div>

</main>
</div>

<!-- ================= JS ================= -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/userpage.js"></script>
<script>
const sidebar = document.getElementById('sidebar');
const hamburgerBtn = document.getElementById('hamburgerBtn');

hamburgerBtn.addEventListener('click', () => {
    sidebar.classList.toggle('active');
});
</script>

</body>
</html>
