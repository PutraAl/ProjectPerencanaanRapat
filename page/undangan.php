<?php 
include "../connection/server.php";
require_once "../connection/middleware.php";
middlewareUser();
$id_user = $_SESSION['id_user'];
$totalUndangan = mysqli_query($mysqli, "SELECT * FROM tb_undangan where id_peserta = $id_user");
 
$dataUser = mysqli_query($mysqli, "SELECT nama FROM tb_user WHERE id_user = '$id_user'");
$user = mysqli_fetch_assoc($dataUser);


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
        <img src="../assets/img/polteklogo.png" alt="Logo" class="logo-img">
        <hr class="divider">
    </div>

    <div class="logo">Meeting Kampus</div>

    <!-- <ul class="menu"> -->
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
         <div class="main-content">

        <!-- Header -->
            <div class="header">
                <h2 class="page-title">Pengelolaan Undangan Rapat</h2>

            <div class="user-info">
                <span><?= $user['nama'] ?></span>
                <div class="user-avatar"><?= substr($user['nama'], 0, 3) ?></div>
            </div>

            </div>

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
        <input type="text" id="searchInput"
            placeholder="Cari judul rapat..."
            onkeyup="filterUndangan()">
    </div>

    <!-- Button Jadwal -->
    <a href="jadwal.php"
       class="btn btn-outline-primary btn-sm icon-btn"
       title="Jadwal Rapat">
        <i class="bi bi-calendar-event"></i>
    </a>

    <!-- Button Notulen -->
    <a href="notulen.php"
       class="btn btn-outline-success btn-sm icon-btn"
       title="Notulen Rapat">
        <i class="bi bi-journal-text"></i>
    </a>

    </div>
          <form action="" method="GET" id="filterForm">
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="tanggal_dari" class="form-label">Tanggal Dari</label>
                <input type="date" name="tanggal_dari" id="tanggal_dari" class="form-control"
                  value="<?= $filterTanggalDari ?>">
              </div>
              <div class="col-md-3 mb-3">
                <label for="tanggal_sampai" class="form-label">Tanggal Sampai</label>
                <input type="date" name="tanggal_sampai" id="tanggal_sampai" class="form-control"
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
              <div class="col-md-3 mb-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary flex-fill">Filter</button>
                <a href="rapat.php" class="btn btn-secondary flex-fill">Reset</a>
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
                     <?php 
                $data = mysqli_query($mysqli, "SELECT * FROM tb_undangan a JOIN tb_rapat b ON a.id_rapat = b.id_rapat where id_peserta = $id_user ORDER BY status ASC ");
                while($row = mysqli_fetch_array($data)) {
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

                                 <div class="meeting-detail"><i>📅</i> <span><?= $row['tanggal'] ?></span></div>
                                 <div class="meeting-detail"><i>⏰</i> <span><?= $row['waktu'] ?></span></div>
                                 <div class="meeting-detail"><i>📍</i> <span><?= $row['lokasi'] ?></span></div>
                                 <div class="meeting-detail"><i>Absensi :</i>
                                     <span><?= ($row['status_kehadiran'] == 'hadir') ? 'Hadir' :
     (($row['status_kehadiran'] == 'tidak_hadir') ? 'Tidak Hadir' : 'Belum Dikonfirmasi');?></span></div>
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
                            if($row['status'] != 'selesai') {
                            ?>
                             <button class="toggle-button"
                                 onclick="toggleDetail('detail-wisuda-<?= $row['id_undangan'] ?>')">
                                 Tampilkan Detail
                             </button>
                             <?php } else if($row['status_kehadiran'] == NULL || $row['status_kehadiran'] == 'tidak_hadir' ) {?>

                             <form action="../action/konfirmasi_kehadiran.php" method="post">
                                 <input type="hidden" name="id_user" value="<?= $id_user ?>">
                                 <input type="hidden" name="id_undangan" value="<?= $row['id_undangan'] ?>">
                                 <button type="submit" name="absen_user" class="btn btn-success w-100 my-2">Konfirmasi Kehadiran</button>
                             </form>
                             <?php }else if($row['status'] == 'selesai'){ ?>

                             <button class="toggle-button"
                                 onclick="toggleDetail('detail-notulen-<?= $row['id_undangan'] ?>')">
                                 Lihat Notulen
                             </button>

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