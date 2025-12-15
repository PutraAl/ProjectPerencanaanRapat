<?php
include "../connection/server.php";



$id_rapat = $_GET['id'] ?? null;

// Ambil rapat selesai (UNTUK LIST)
$rapatSelesai = mysqli_query($mysqli, "
    SELECT id_rapat, judul, tanggal, waktu
    FROM tb_rapat
    WHERE status = 'selesai'
    ORDER BY tanggal DESC
");

// Kalau ADA id → ambil detail notulen
if ($id_rapat) {
    $data = mysqli_query($mysqli, "
        SELECT judul, tanggal, waktu, notulen
        FROM tb_rapat
        WHERE id_rapat = '$id_rapat'
    ");

    $rapat = mysqli_fetch_assoc($data);
}


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

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo-section">
            <img src="../assets/img/polteklogo.png" class="logo-img">
            <hr class="divider">
        </div>

        <div class="logo">Meeting Kampus</div>

        <ul class="menu">
            <li class="menu-item">
                <i class="fa-solid fa-chart-line"></i>
                <a href="dashboard.php">Dashboard</a>
            </li>

            <li class="menu-item active">
                <i class="fa-solid fa-envelope"></i>
                <a href="undangan.php">Undangan Rapat</a>
            </li>

            <li class="menu-item">
                <i class="fa-solid fa-user"></i>
                <a href="profil.php">Profil</a>
            </li>

            <li class="menu-item">
                <i class="fa-solid fa-right-from-bracket"></i>
                <a href="logout.php">Keluar</a>
            </li>
        </ul>
    </div>
    <!-- End Sidebar -->

    <!-- Main Content -->
    <main class="main-content">

            <!-- Tombol Kembali -->
                <div class="page-header d-flex align-items-center mb-4">
            <a href="undangan.php" class="back-link me-3">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
                <h2 class="page-title mb-0">Rapat Selesai</h2>
</div>

<div class="container-fluid mt-4 px-4">


<!-- Detail Notulen -->
<?php if (isset($rapat)) { ?>
<div class="card mb-4 notulen-card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <!-- Kiri: Judul & Meta -->
        <div>
            <h3 class="mb-1">
                Notulen Rapat: <?= htmlspecialchars($rapat['judul']) ?>
            </h3>
            <p class="notulen-meta mb-0">
                <?= htmlspecialchars($rapat['tanggal']) ?> |
                <?= htmlspecialchars($rapat['waktu']) ?>
            </p>
        </div>

        <!-- Kanan: Download -->
    <a href="download_notulen.php?id=<?= $id_rapat ?>" 
    class="btn btn-outline-success btn-sm" 
    title="Download Notulen"> 
    <i class="fa-solid fa-download"></i> </a>

    </div>

    <div class="card-body notulen-body">
        <?= nl2br(htmlspecialchars($rapat['notulen'])) ?>
    </div>

</div>
<?php } ?>

            
            <!-- Rapat Terlaksana -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-3">Rapat Terlaksana</h4>

                    <ul class="meeting-list">
                        <?php while ($row = mysqli_fetch_assoc($rapatSelesai)) { ?>
                            <li class="meeting-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><?= htmlspecialchars($row['judul']) ?></strong><br>
                                    <small><?= htmlspecialchars($row['tanggal']) ?>, <?= htmlspecialchars($row['waktu']) ?></small>
                                </div>

                                <a href="notulen.php?id=<?= $row['id_rapat'] ?>"
                                class="btn btn-sm btn-outline-primary">
                                    Lihat Notulen
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>


    </main>
    <!-- End Main Content -->

</div>
<script>
            const btn = document.getElementById("hamburgerBtn");
        const sidebar = document.getElementById("sidebar");

        btn.addEventListener("click", () => {
            sidebar.classList.toggle("active");
        });
    </script>
<script src="../assets/js/userpage.js"></script>
</body>

</html>
