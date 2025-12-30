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

// ==================== PAGINATION ====================
$itemsPerPage = 6; // Jumlah card per halaman
$currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

// Hitung total data
$totalResult = mysqli_query($mysqli, $query);
$totalData = mysqli_num_rows($totalResult);
$totalPages = ceil($totalData / $itemsPerPage);

// Validasi halaman
if ($currentPage > $totalPages && $totalPages > 0) {
    $currentPage = $totalPages;
}

// Hitung offset
$offset = ($currentPage - 1) * $itemsPerPage;

// Query dengan LIMIT
$queryWithLimit = $query . " LIMIT $offset, $itemsPerPage";
$data = mysqli_query($mysqli, $queryWithLimit);

// Helper function untuk membuat URL dengan filter & pagination
function buildPaginationUrl($page, $filterTanggalDari = '', $filterTanggalSampai = '', $filterStatus = '')
{
    $params = ['page' => $page];
    if (!empty($filterTanggalDari)) $params['tanggal_dari'] = $filterTanggalDari;
    if (!empty($filterTanggalSampai)) $params['tanggal_sampai'] = $filterTanggalSampai;
    if (!empty($filterStatus)) $params['status'] = $filterStatus;
    return '?' . http_build_query($params);
}

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

    <style>
        .pagination-container {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .pagination {
            justify-content: center;
            margin-bottom: 0;
        }

        .pagination-info {
            font-size: 0.9rem;
            margin-top: 15px;
        }

        .meeting-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
    </style>

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
                            id="invitation-count"><?= $totalData ?></span>
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

                    <!-- Grid Undangan -->
                    <div class="meeting-grid" id="invitations-grid">
                        <?php
                        if (mysqli_num_rows($data) > 0) {
                            while ($row = mysqli_fetch_assoc($data)) {
                        ?>
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

                        <?php
                            }
                        } else {
                            echo '<div class="alert alert-warning text-center col-12">⚠️ Tidak ada undangan rapat ditemukan</div>';
                        }
                        ?>

                    </div>
                    <!-- End Grid -->

                    <!-- PAGINATION -->
                    <?php if ($totalPages > 1): ?>
                        <div class="pagination-container">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <!-- Previous Button -->
                                    <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                                        <a class="page-link" href="<?= buildPaginationUrl(max(1, $currentPage - 1), $filterTanggalDari, $filterTanggalSampai, $filterStatus) ?>">
                                            ← Sebelumnya
                                        </a>
                                    </li>

                                    <!-- Page Numbers -->
                                    <?php
                                    $startPage = max(1, $currentPage - 2);
                                    $endPage = min($totalPages, $currentPage + 2);

                                    if ($startPage > 1) {
                                        echo '<li class="page-item"><a class="page-link" href="' . buildPaginationUrl(1, $filterTanggalDari, $filterTanggalSampai, $filterStatus) . '">1</a></li>';
                                        if ($startPage > 2) {
                                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                        }
                                    }

                                    for ($page = $startPage; $page <= $endPage; $page++) {
                                        $active = ($page === $currentPage) ? 'active' : '';
                                        echo '<li class="page-item ' . $active . '"><a class="page-link" href="' . buildPaginationUrl($page, $filterTanggalDari, $filterTanggalSampai, $filterStatus) . '">' . $page . '</a></li>';
                                    }

                                    if ($endPage < $totalPages) {
                                        if ($endPage < $totalPages - 1) {
                                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                        }
                                        echo '<li class="page-item"><a class="page-link" href="' . buildPaginationUrl($totalPages, $filterTanggalDari, $filterTanggalSampai, $filterStatus) . '">' . $totalPages . '</a></li>';
                                    }
                                    ?>
                                </ul>
                            </nav>

                            <!-- Info Pagination -->
                            <div class="pagination-info text-center text-muted">
                                Menampilkan data <?= (($currentPage - 1) * $itemsPerPage) + 1 ?> -
                                <?= min($currentPage * $itemsPerPage, $totalData) ?>
                                dari <?= $totalData ?> data
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        </div> <!-- End Container -->

        <!-- JavaScript -->
        <script src="../assets/js/undanganuser.js"></script>

</body>

</html>