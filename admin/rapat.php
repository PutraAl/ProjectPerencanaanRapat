<?php 
include "../connection/server.php";

// Ambil parameter filter dari GET
$filterTanggalDari = isset($_GET['tanggal_dari']) ? $_GET['tanggal_dari'] : '';
$filterTanggalSampai = isset($_GET['tanggal_sampai']) ? $_GET['tanggal_sampai'] : '';
$filterStatus = isset($_GET['status']) ? $_GET['status'] : '';

// Build query dengan filter
$queryString = "SELECT * FROM tb_rapat WHERE 1=1";

if(!empty($filterTanggalDari)) {
    $queryString .= " AND tanggal >= '" . mysqli_real_escape_string($mysqli, $filterTanggalDari) . "'";
}

if(!empty($filterTanggalSampai)) {
    $queryString .= " AND tanggal <= '" . mysqli_real_escape_string($mysqli, $filterTanggalSampai) . "'";
}

if(!empty($filterStatus)) {
    $queryString .= " AND status = '" . mysqli_real_escape_string($mysqli, $filterStatus) . "'";
}

$queryString .= " ORDER BY tanggal DESC, waktu DESC";

$dataRapat = mysqli_query($mysqli, $queryString);

// Cek apakah ada mode edit
$editMode = false;
$rapatEdit = null;
$pesertaTerpilih = [];

// Cek apakah ada mode absensi
$absensiMode = false;
$rapatAbsensi = null;
$dataPesertaRapat = null;

if(isset($_GET['absensi'])) {
    $absensiMode = true;
    $id_absensi = mysqli_real_escape_string($mysqli, $_GET['absensi']);
    $queryAbsensi = mysqli_query($mysqli, "SELECT * FROM tb_rapat WHERE id_rapat = '$id_absensi' AND status = 'selesai'");
    
    if(mysqli_num_rows($queryAbsensi) > 0) {
        $rapatAbsensi = mysqli_fetch_array($queryAbsensi);
        
        // Ambil data peserta rapat beserta status kehadiran
        $dataPesertaRapat = mysqli_query($mysqli, "
            SELECT u.*, tu.id_undangan, tu.status_kehadiran 
            FROM tb_undangan tu
            JOIN tb_user u ON tu.id_peserta = u.id_user
            WHERE tu.id_rapat = '$id_absensi'
            ORDER BY u.nama ASC
        ");
    } else {
        // Redirect jika rapat belum selesai
        echo "<script>
                alert('Absensi hanya bisa diakses untuk rapat yang sudah selesai!');
                window.location.href='rapat.php';
              </script>";
        exit;
    }
}

if(isset($_GET['edit'])) {
    $editMode = true;
    $id_edit = mysqli_real_escape_string($mysqli, $_GET['edit']);
    $queryEdit = mysqli_query($mysqli, "SELECT * FROM tb_rapat WHERE id_rapat = '$id_edit'");
    $rapatEdit = mysqli_fetch_array($queryEdit);
    
    // Ambil peserta yang sudah terpilih
    $queryPesertaTerpilih = mysqli_query($mysqli, "SELECT id_peserta FROM tb_undangan WHERE id_rapat = '$id_edit'");
    while($row = mysqli_fetch_array($queryPesertaTerpilih)) {
        $pesertaTerpilih[] = $row['id_peserta'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perencanaan Rapat - Dashboard Admin</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  
  <!-- Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  
  <!-- Select2 Bootstrap 5 Theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
  
  <link rel="stylesheet" href="../assets/css/adminpagenew.css">
  
  <style>
    .select2-container {
      width: 100% !important;
    }
    
    .select2-container--bootstrap-5 .select2-selection--multiple {
      min-height: 38px;
    }
    
    .form-section {
      background: white;
      border-radius: 8px;
      padding: 25px;
      margin-bottom: 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      display: none;
    }
    
    .form-section.show {
      display: block;
      animation: slideDown 0.3s ease-out;
    }
    
    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .btn-toggle {
      margin-bottom: 15px;
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

      <div class="logo">Meeting Kampus</div>

      <ul class="menu">
        <li class="menu-item">
          <i>📊</i>
          <a href="dashboardnew.php">Dashboard</a>
        </li>

        <li class="menu-item active">
          <i>📨</i>
          <a href="rapat.php">Data Rapat</a>
        </li>

        <li class="menu-item">
          <i>👤</i>
          <a href="profilenew.php">Profil</a>
        </li>

        <li class="menu-item">
          <i>👥</i>
          <a href="user.php">User</a>
        </li>

        <li class="menu-item">
          <i>🚪</i>
          <a href="../action/logout.php">Keluar</a>
        </li>
      </ul>
    </div>
    <!-- End Sidebar -->

    <div class="main-content">

      <!-- Header -->
      <div class="header">
        <div class="page-title">Pengelolaan Data Rapat</div>
        <div class="user-info">
          <div class="user-avatar">A</div>
          <span>Admin</span>
        </div>
      </div>

      <!-- Stats Section -->
      <div class="stats-container">
        <div class="stat-card">
          <div class="stat-value">12</div>
          <div class="stat-label">Rapat Hari Ini</div>
        </div>
        <div class="stat-card">
          <div class="stat-value">5</div>
          <div class="stat-label">Rapat Minggu Ini</div>
        </div>
        <div class="stat-card">
          <div class="stat-value">8</div>
          <div class="stat-label">Rapat Mendatang</div>
        </div>
        <div class="stat-card">
          <div class="stat-value">3</div>
          <div class="stat-label">Tugas Belum Selesai</div>
        </div>
      </div>

      <!-- Tombol Tambah / Batal -->
      <button type="button" class="btn btn-primary btn-toggle" id="toggleFormBtn" onclick="toggleForm()">
        <span id="btnText">
          <?php 
          if($absensiMode) {
              echo '✅ Form Absensi';
          } elseif($editMode) {
              echo '✏️ Edit Data Rapat';
          } else {
              echo '➕ Tambah Data Rapat';
          }
          ?>
        </span>
      </button>
      
      <?php if($editMode || $absensiMode): ?>
      <a href="rapat.php" class="btn btn-secondary btn-toggle">❌ Batal</a>
      <?php endif; ?>

      <!-- Form Filter/Search -->
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="mb-3">🔍 Filter & Pencarian Rapat</h5>
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
                <button type="submit" class="btn btn-primary flex-fill">🔍 Filter</button>
                <a href="rapat.php" class="btn btn-secondary flex-fill">🔄 Reset</a>
              </div>
            </div>
          </form>
          
          <?php if(!empty($filterTanggalDari) || !empty($filterTanggalSampai) || !empty($filterStatus)): ?>
          <div class="alert alert-info mt-3 mb-0">
            <strong>Filter Aktif:</strong>
            <?php if(!empty($filterTanggalDari)): ?>
              Dari: <?= date('d M Y', strtotime($filterTanggalDari)) ?>
            <?php endif; ?>
            <?php if(!empty($filterTanggalSampai)): ?>
              Sampai: <?= date('d M Y', strtotime($filterTanggalSampai)) ?>
            <?php endif; ?>
            <?php if(!empty($filterStatus)): ?>
              | Status: <span class="badge bg-primary"><?= ucfirst($filterStatus) ?></span>
            <?php endif; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Form Tambah/Edit Rapat (Collapsible) -->
      <div class="form-section <?php echo ($editMode || $absensiMode) ? 'show' : ''; ?>" id="formSection">
        
        <?php if($absensiMode): ?>
        <!-- Form Absensi -->
        <h4 class="mb-4">✅ Absensi Rapat: <?= $rapatAbsensi['judul'] ?></h4>
        <div class="alert alert-info">
          <strong>📅 Tanggal:</strong> <?= date('d M Y', strtotime($rapatAbsensi['tanggal'])) ?> | 
          <strong>⏰ Waktu:</strong> <?= date('H:i', strtotime($rapatAbsensi['waktu'])) ?> |
          <strong>📍 Lokasi:</strong> <?= $rapatAbsensi['lokasi'] ?>
        </div>
        
        <form action="../action/simpan_absensi.php" method="POST" id="absensi-form">
          <input type="hidden" name="id_rapat" value="<?= $rapatAbsensi['id_rapat'] ?>">
          
          <div class="card">
            <div class="card-body">
              <h5 class="mb-3">Daftar Peserta</h5>
              <p class="text-muted mb-3">Centang peserta yang hadir pada rapat ini</p>
              
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th width="50">No</th>
                      <th>Nama Peserta</th>
                      <th>Email</th>
                      <th width="150" class="text-center">Status Kehadiran</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    while($peserta = mysqli_fetch_array($dataPesertaRapat)) {
                        $checked = ($peserta['status_kehadiran'] == 'hadir') ? 'checked' : '';
                    ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td>
                        <strong><?= $peserta['nama'] ?></strong>
                      </td>
                      <td><?= $peserta['email'] ?></td>
                      <td class="text-center">
                        <div class="form-check form-switch d-flex justify-content-center">
                          <input class="form-check-input" type="checkbox" 
                                 name="kehadiran[]" 
                                 value="<?= $peserta['id_undangan'] ?>" 
                                 id="kehadiran_<?= $peserta['id_undangan'] ?>"
                                 <?= $checked ?>>
                          <label class="form-check-label ms-2" for="kehadiran_<?= $peserta['id_undangan'] ?>">
                            <span class="badge bg-success" id="badge_<?= $peserta['id_undangan'] ?>" style="<?= !$checked ? 'display:none;' : '' ?>">Hadir</span>
                            <span class="badge bg-danger" id="badge_tidak_<?= $peserta['id_undangan'] ?>" style="<?= $checked ? 'display:none;' : '' ?>">Tidak Hadir</span>
                          </label>
                        </div>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
          <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn btn-success">💾 Simpan Absensi</button>
            <a href="rapat.php" class="btn btn-secondary">❌ Batal</a>
          </div>
        </form>
        
        <?php else: ?>
        <!-- Form Tambah/Edit Rapat -->
        <h4 class="mb-4"><?php echo $editMode ? 'Edit Data Rapat' : 'Tambah Data Rapat Baru'; ?></h4>
        
        <form action="<?php echo $editMode ? '../action/proses_edit_rapat.php' : '../action/tambah_rapat.php'; ?>" method="POST" id="meeting-form">
          
          <?php if($editMode): ?>
          <input type="hidden" name="id_rapat" value="<?= $rapatEdit['id_rapat'] ?>">
          <?php endif; ?>
          
          <div class="row">
            <div class="col-md-12 mb-3">
              <label for="meeting-title" class="form-label">Judul Rapat <span class="text-danger">*</span></label>
              <input type="text" name="judul" id="meeting-title" class="form-control"
                placeholder="Masukkan judul rapat" value="<?php echo $editMode ? $rapatEdit['judul'] : ''; ?>" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-3">
              <label for="meeting-desc" class="form-label">Deskripsi <span class="text-danger">*</span></label>
              <textarea name="deskripsi" id="meeting-desc" class="form-control" rows="3" 
                placeholder="Masukkan deskripsi rapat" required><?php echo $editMode ? $rapatEdit['deskripsi'] : ''; ?></textarea>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="meeting-date" class="form-label">Tanggal <span class="text-danger">*</span></label>
              <input type="date" name="tanggal" id="meeting-date" class="form-control" 
                value="<?php echo $editMode ? $rapatEdit['tanggal'] : ''; ?>" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="meeting-time" class="form-label">Waktu <span class="text-danger">*</span></label>
              <input type="time" name="waktu" id="meeting-time" class="form-control" 
                value="<?php echo $editMode ? $rapatEdit['waktu'] : ''; ?>" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-3">
              <label for="meeting-location" class="form-label">Lokasi / Platform <span class="text-danger">*</span></label>
              <input type="text" name="lokasi" id="meeting-location" class="form-control" 
                placeholder="Ruang 101 / Zoom / Teams" value="<?php echo $editMode ? $rapatEdit['lokasi'] : ''; ?>" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="meeting-status" class="form-label">Status <span class="text-danger">*</span></label>
              <select name="status" id="meeting-status" class="form-control">
                <option value="dijadwalkan" <?php echo ($editMode && $rapatEdit['status'] == 'dijadwalkan') ? 'selected' : ''; ?>>Dijadwalkan</option>
                <option value="selesai" <?php echo ($editMode && $rapatEdit['status'] == 'selesai') ? 'selected' : ''; ?>>Selesai</option>
                <option value="dibatalkan" <?php echo ($editMode && $rapatEdit['status'] == 'dibatalkan') ? 'selected' : ''; ?>>Dibatalkan</option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label for="peserta" class="form-label">Peserta <span class="text-danger">*</span></label>
              <select name="peserta[]" id="peserta" class="form-control" multiple="multiple" required>
                <?php 
                $dataPeserta = mysqli_query($mysqli, "SELECT * FROM tb_user WHERE role = 'peserta' ORDER BY nama ASC");
                while($row = mysqli_fetch_array($dataPeserta)) {
                    $selected = ($editMode && in_array($row['id_user'], $pesertaTerpilih)) ? 'selected' : '';
                ?>
                <option value="<?= $row['id_user'] ?>" <?= $selected ?>><?= $row['nama'] ?></option>
                <?php } ?>
              </select>
              <small class="form-text text-muted">Pilih satu atau lebih peserta</small>
            </div>
          </div>

          <?php if($editMode): ?>
          <div class="row">
            <div class="col-md-12 mb-3">
              <label for="notulen" class="form-label">Notulen Rapat</label>
              <textarea name="notulen" id="notulen" class="form-control" rows="5" 
                placeholder="Masukkan notulen/catatan hasil rapat..."><?php echo $editMode ? $rapatEdit['notulen'] : ''; ?></textarea>
              <small class="form-text text-muted">Field ini hanya tersedia saat mengedit rapat untuk menambahkan catatan hasil rapat</small>
            </div>
          </div>
          <?php endif; ?>

          <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn btn-primary">
              <?php echo $editMode ? '💾 Update Data' : '💾 Simpan Data'; ?>
            </button>
            <button type="button" class="btn btn-secondary" onclick="toggleForm()">❌ Batal</button>
          </div>

        </form>
        <?php endif; ?>
      </div>

      <!-- Manajemen Jadwal Rapat -->
      <div class="card">
        <div class="card-title">
          Manajemen Jadwal Rapat 
          <span class="badge bg-secondary"><?= mysqli_num_rows($dataRapat) ?> Data</span>
        </div>

        <div class="meeting-grid">
          <?php 
          if(mysqli_num_rows($dataRapat) > 0) {
            while($row = $dataRapat->fetch_array()){
              // Hitung jumlah peserta
              $id_rapat = $row['id_rapat'];
              $countPeserta = mysqli_query($mysqli, "SELECT COUNT(*) as total FROM tb_undangan WHERE id_rapat = '$id_rapat'");
              $jumlahPeserta = mysqli_fetch_array($countPeserta)['total'];
          ?>
          <div class="meeting-card">
            <div class="meeting-header"><?= $row['judul'] ?></div>
            <div class="meeting-body">
              <div class="meeting-detail">
                <i>📅</i> <?= date('d M Y', strtotime($row['tanggal'])) ?>, <?= date('H:i', strtotime($row['waktu'])) ?>
              </div>
              <div class="meeting-detail">
                <i>📍</i> <?= $row['lokasi'] ?>
              </div>
              <div class="meeting-detail">
                <i>👥</i> <?= $jumlahPeserta ?> Peserta
              </div>
              <div class="meeting-detail">
                <i>📊</i> Status: 
                <?php 
                $badgeClass = '';
                if($row['status'] == 'dijadwalkan') $badgeClass = 'bg-primary';
                elseif($row['status'] == 'selesai') $badgeClass = 'bg-success';
                elseif($row['status'] == 'dibatalkan') $badgeClass = 'bg-danger';
                ?>
                <span class="badge <?= $badgeClass ?>"><?= ucfirst($row['status']) ?></span>
              </div>
              <?php if(!empty($row['notulen'])): ?>
              <div class="meeting-detail">
                <i>📝</i> <strong>Notulen:</strong> <?= substr($row['notulen'], 0, 100) ?><?= strlen($row['notulen']) > 100 ? '...' : '' ?>
              </div>
              <?php endif; ?>
              <div class="button-group">
                <a href="?edit=<?= $row['id_rapat'] ?><?= !empty($filterTanggalDari) ? '&tanggal_dari='.$filterTanggalDari : '' ?><?= !empty($filterTanggalSampai) ? '&tanggal_sampai='.$filterTanggalSampai : '' ?><?= !empty($filterStatus) ? '&status='.$filterStatus : '' ?>" class="btn btn-primary">✏️ Edit</a>
                
                <?php if($row['status'] == 'selesai'): ?>
                <a href="?absensi=<?= $row['id_rapat'] ?>" class="btn btn-success">✅ Absensi</a>
                <?php endif; ?>
                
                <button class="btn btn-outline" onclick="hapusRapat(<?= $row['id_rapat'] ?>)">🗑️ Hapus</button>
              </div>
            </div>
          </div>
          <?php 
            }
          } else {
            echo '<div class="alert alert-warning text-center mb-0">
                    <i>⚠️</i> Tidak ada data rapat ditemukan dengan filter yang dipilih
                  </div>';
          }
          ?>
        </div>
      </div>

      <!-- Undangan & Konfirmasi Kehadiran -->
      <div class="card">
        <div class="card-title">Undangan & Konfirmasi Kehadiran</div>
        <ul class="meeting-list">
          <li class="meeting-item">
            <div>
              <div class="meeting-title">Rapat Akademik</div>
              <div class="meeting-time">28 Nov 2025, 09:00</div>
            </div>
            <span class="badge badge-success">Hadir</span>
          </li>
          <li class="meeting-item">
            <div>
              <div class="meeting-title">Rapat Penelitian</div>
              <div class="meeting-time">29 Nov 2025, 14:00</div>
            </div>
            <span class="badge badge-warning">Belum Konfirmasi</span>
          </li>
        </ul>
      </div>

      <!-- Notulen & Dokumentasi -->
      <div class="card">
        <div class="card-title">Notulen & Dokumentasi</div>
        <div class="meeting-grid">
          <div class="meeting-card">
            <div class="meeting-header">Rapat Akademik</div>
            <div class="meeting-body">
              <div class="meeting-detail"><i>📝</i> Notulen Tersedia</div>
              <div class="meeting-detail"><i>📎</i> Dokumen Pendukung</div>
              <div class="button-group">
                <button class="btn btn-primary">👁️ Lihat</button>
                <button class="btn btn-outline">⬇️ Download</button>
              </div>
            </div>
          </div>
          <div class="meeting-card">
            <div class="meeting-header">Rapat Penelitian</div>
            <div class="meeting-body">
              <div class="meeting-detail"><i>📝</i> Notulen Tersedia</div>
              <div class="meeting-detail"><i>📎</i> Dokumen Pendukung</div>
              <div class="button-group">
                <button class="btn btn-primary">👁️ Lihat</button>
                <button class="btn btn-outline">⬇️ Download</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- jQuery (harus dimuat sebelum Select2) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
  </script>
  
  <!-- Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    // Hamburger Menu
    const btn = document.getElementById("hamburgerBtn");
    const sidebar = document.querySelector(".sidebar");

    btn.addEventListener("click", () => {
      sidebar.classList.toggle("active");
    });

    // Toggle Form
    function toggleForm() {
      const formSection = document.getElementById('formSection');
      const btnText = document.getElementById('btnText');
      
      if(formSection.classList.contains('show')) {
        formSection.classList.remove('show');
        btnText.innerHTML = '➕ Tambah Data Rapat';
        // Reset form jika bukan mode edit
        <?php if(!$editMode): ?>
        document.getElementById('meeting-form').reset();
        $('#peserta').val(null).trigger('change');
        <?php endif; ?>
      } else {
        formSection.classList.add('show');
        btnText.innerHTML = '❌ Tutup Form';
        // Scroll ke form
        formSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    }

    // Inisialisasi Select2
    $(document).ready(function() {
      $('#peserta').select2({
        theme: 'bootstrap-5',
        placeholder: "-- Pilih Peserta --",
        allowClear: true,
        closeOnSelect: false,
        width: '100%',
        language: {
          noResults: function() {
            return "Tidak ada peserta ditemukan";
          },
          searching: function() {
            return "Mencari...";
          }
        }
      });
      
      // Toggle badge kehadiran saat checkbox diubah
      $('input[name="kehadiran[]"]').on('change', function() {
        const id = $(this).val();
        const badgeHadir = $('#badge_' + id);
        const badgeTidakHadir = $('#badge_tidak_' + id);
        
        if($(this).is(':checked')) {
          badgeHadir.show();
          badgeTidakHadir.hide();
        } else {
          badgeHadir.hide();
          badgeTidakHadir.show();
        }
      });
    });

    // Fungsi Hapus Rapat
    function hapusRapat(id) {
      if(confirm('Apakah Anda yakin ingin menghapus data rapat ini?')) {
        window.location.href = '../action/hapus_rapat.php?id=' + id;
      }
    }
    
    // Auto scroll ke form saat mode edit atau absensi
    <?php if($editMode || $absensiMode): ?>
    window.addEventListener('load', function() {
      document.getElementById('formSection').scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
    <?php endif; ?>
  </script>

</body>
</html>