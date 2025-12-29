<?php
include "../connection/server.php";
require_once "../connection/middleware.php";
middlewareUser();

$id_user = $_SESSION['id_user'];

// Ambil nilai filter dari form (GET / POST)
$filterTanggalDari   = $_GET['tanggal_dari']   ?? '';
$filterTanggalSampai = $_GET['tanggal_sampai'] ?? '';
$filterStatus        = $_GET['status']          ?? '';

// Ambil data user (UNTUK HEADER)
$userQuery = mysqli_query($mysqli, "
   SELECT nama, foto FROM tb_user WHERE id_user = '$id_user'
");
$user = mysqli_fetch_assoc($userQuery);

// ==========================
// QUERY DI SINI ⬇⬇⬇
// ==========================
$query = "
    SELECT * 
    FROM tb_undangan a
    JOIN tb_rapat b ON a.id_rapat = b.id_rapat
    WHERE a.id_peserta = $id_user
";

if (!empty($filterTanggalDari)) {
    $query .= " AND b.tanggal >= '$filterTanggalDari'";
}

if (!empty($filterTanggalSampai)) {
    $query .= " AND b.tanggal <= '$filterTanggalSampai'";
}

if (!empty($filterStatus)) {
    $query .= " AND b.status = '$filterStatus'";
}

$query .= " ORDER BY b.tanggal ASC";

$data = mysqli_query($mysqli, $query);
// ==========================

// Judul halaman
$pageTitle = "Rapat";
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perencanaan Rapat - Undangan Rapat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
            <li class="menu-item ">
                <i class="fa-solid fa-chart-line"></i>
                <a href="dashboard.php">Dashboard</a>
            </li>

            <li class="menu-item active">
                <i class="fa-solid fa-envelope"></i>
                <a href="undangan.php">Rapat</a>
            </li>

            <li class="menu-item ">
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
        <div class="main-content">


            <!-- Header -->
            <?php include "header.php"; ?>

            <!-- undangan rapat -->
            <div id="invitations" class="page">


                <div class="card">
                    <h2 class="card-title">Undangan Rapat</h2>
                    <p>Anda memiliki <span
                            id="invitation-count"><?= $totalUndangan->num_rows <= 0 ? "0" : $totalUndangan->num_rows ?></span>
                        undangan rapat</p>
                </div>

                <!-- Form Filter/Search -->
                <div class="filter-bar">


                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="mb-3"> Filter & Pencarian Rapat</h5>

                            <div class="top-bar d-flex align-items-center gap-2">

                                <!-- Search -->
                                <div class="search-box flex-grow-1">
                                    <i class="bi bi-search search-icon"></i>
                                    <input type="text"
                                        id="searchInput"
                                        class="form-control"
                                        placeholder="Cari judul rapat..."
                                        onkeyup="filterUndangan()">
                                </div>


                                <!-- Button Jadwal -->
                                <!-- <a href="jadwal.php"
       class="btn btn-outline-primary btn-sm icon-btn"
       title="Jadwal Rapat">
        <i class="bi bi-calendar-event"></i>
    </a> -->

                                <!-- Button Notulen -->
                                <!-- <a href="notulen.php"
       class="btn btn-outline-success btn-sm icon-btn"
       title="Notulen Rapat">
        <i class="bi bi-journal-text"></i>
    </a> -->

                            </div>
                            <form action="" method="GET" id="filterForm">
                                <div class="row align-items-end">

                                    <div class="col-md-3 mb-3">
                                        <label for="tanggal_dari" class="form-label">Tanggal Dari</label>
                                        <input type="date" name="tanggal_dari" id="tanggal_dari"
                                            class="form-control"
                                            value="<?= $filterTanggalDari ?>">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="tanggal_sampai" class="form-label">Tanggal Sampai</label>
                                        <input type="date" name="tanggal_sampai" id="tanggal_sampai"
                                            class="form-control"
                                            value="<?= $filterTanggalSampai ?>">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="">Semua Status</option>
                                            <option value="dijadwalkan" <?= $filterStatus == 'dijadwalkan' ? 'selected' : '' ?>>Dijadwalkan</option>
                                            <option value="selesai" <?= $filterStatus == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                            <option value="dibatalkan" <?= $filterStatus == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                                        </select>
                                    </div>

                                    <!-- KOLOM TOMBOL (ISI SPACE KOSONG) -->
                                    <div class="col-md-3 mb-3 d-flex gap-2">
                                        <button type="submit"
                                            class="btn btn-outline-primary btn-sm icon-btn-text flex-fill">
                                            <i class="fa-solid fa-filter"></i> Filter
                                        </button>

                                        <a href="undangan.php"
                                            class="btn btn-outline-warning btn-sm icon-btn-text flex-fill">
                                            <i class="fa-solid fa-rotate-left"></i> Reset
                                        </a>

                                    </div>

                                </div>
                            </form>


                            <?php if (!empty($filterTanggalDari) || !empty($filterTanggalSampai) || !empty($filterStatus)): ?>
                                <div class="alert alert-info mt-3 mb-0">
                                    <strong>Filter Aktif:</strong>
                                    <?php if (!empty($filterTanggalDari)): ?>
                                        Dari: <?= date('d M Y', strtotime($filterTanggalDari)) ?>
                                    <?php endif; ?>
                                    <?php if (!empty($filterTanggalSampai)): ?>
                                        Sampai: <?= date('d M Y', strtotime($filterTanggalSampai)) ?>
                                    <?php endif; ?>
                                    <?php if (!empty($filterStatus)): ?>
                                        | Status: <span class="badge bg-primary"><?= ucfirst($filterStatus) ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Search + Notif -->



                    <!-- <div class="notif-icon">
                         <i class="bi bi-bell"></i>
                         <span class="notif-count">2</span>
                     </div> -->

                    <!-- </div> -->
                    <!-- Grid Undangan -->
                    <div class="meeting-grid" id="invitations-grid">
                        <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                            <!-- Card 1 -->
                            <div class="meeting-card">

                                <div class="meeting-header">
                                    <h3><?= $row['judul'] ?></h3>
                                </div>

                                <div class="rapat-item" data-judul="<?= strtolower($row['judul']) ?>"
                                    data-tanggal="<?= strtolower($row['tanggal']) ?>" style="width: 330px;">
                                </div>

                                <div class="meeting-body">
                                    <div class="meeting-detail-visible">

                                        <div class="meeting-detail">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <span><?= $row['tanggal'] ?></span>
                                        </div>

                                        <div class="meeting-detail">
                                            <i class="fa-solid fa-stopwatch"></i>

                                            <span><?= $row['waktu'] ?></span>
                                        </div>

                                        <div class="meeting-detail">
                                            <span class="icon-circle bg-location">
                                                <i class="fa-solid fa-map-location-dot"></i>
                                            </span>
                                            <span><?= $row['lokasi'] ?></span>
                                        </div>

                                        <div class="meeting-detail"><i>Absensi :</i>
                                            <span><?= ($row['status_kehadiran'] == 'hadir') ? 'Hadir' : (($row['status_kehadiran'] == 'tidak_hadir') ? 'Tidak Hadir' : 'Belum Dikonfirmasi'); ?></span>
                                        </div>
                                        <div class="meeting-detail"><i>Status :</i> <span><?= ucfirst($row['status']) ?></span>
                                        </div>

                                        <div class="content-hidden" id="detail-wisuda-<?= $row['id_undangan'] ?>">
                                            <p>
                                                <?= $row['deskripsi'] ?>
                                            </p>
                                        </div>
                                        <div class="content-hidden" id="detail-notulen-<?= $row['id_undangan'] ?>">
                                            <p>
                                                <?= $row['notulen'] ?>
                                            </p>
                                        </div>

                                    </div>

                                    <?php
                                    if ($row['status'] != 'selesai') {
                                    ?>
                                        <button class="toggle-button"
                                            onclick="toggleDetail('detail-wisuda-<?= $row['id_undangan'] ?>')">
                                            Tampilkan Detail
                                        </button>
                                    <?php } else if ($row['status_kehadiran'] == NULL || $row['status_kehadiran'] == 'tidak_hadir' || $row['status_kehadiran'] == 'belum_dikonfirmasi') { ?>

                                        <form action="../action/konfirmasi_kehadiran.php" method="post">
                                            <input type="hidden" name="id_user" value="<?= $id_user ?>">
                                            <input type="hidden" name="id_undangan" value="<?= $row['id_undangan'] ?>">
                                            <button type="submit" name="absen_user" class="btn btn-success w-100 my-2">Konfirmasi Kehadiran</button>
                                        </form>
                                    <?php } else if ($row['status'] == 'selesai') { ?>

                                        <a href="notulen.php?id=<?= $row['id_rapat'] ?>" class="btn btn-primary w-100  ">
                                            Lihat Notulen
                                        </a>

                                    <?php  } ?>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                    <!-- End Grid -->

                </div>
            </div>

        </div> <!-- End Container -->

        <!-- JavaScript -->
        <script src="../assets/js/undanganuser.js"></script>

</body>

</html>