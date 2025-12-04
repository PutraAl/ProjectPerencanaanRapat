<?php 
include "../connection/server.php";
$dataRapat = mysqli_query($mysqli, "SELECT * FROM tb_rapat ORDER BY tanggal DESC, waktu DESC");

// Cek apakah ada mode edit
$editMode = false;
$rapatEdit = null;
$pesertaTerpilih = [];

if(isset($_GET['edit'])) {
    $editMode = true;
    $id_edit = mysqli_real_escape_string($mysqli, $_GET['edit']);
    $queryEdit = mysqli_query($mysqli, "SELECT * FROM tb_rapat WHERE id_rapat = '$id_edit'");
    $rapatEdit = mysqli_fetch_array($queryEdit);
    
    // Ambil peserta yang sudah terpilih
    $queryPesertaTerpilih = mysqli_query($mysqli, "SELECT * FROM tb_undangan WHERE id_rapat = '$id_edit'");
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
          <a href="profil.php">User</a>
        </li>

        <li class="menu-item">
          <i>👤</i>
          <a href="profil.php">Profil</a>
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
          <?php echo $editMode ? '✏️ Edit Data Rapat' : '➕ Tambah Data Rapat'; ?>
        </span>
      </button>
      
      <?php if($editMode): ?>
      <a href="rapat.php" class="btn btn-secondary btn-toggle">❌ Batal Edit</a>
      <?php endif; ?>

      <!-- Form Tambah/Edit Rapat (Collapsible) -->
      <div class="form-section <?php echo $editMode ? 'show' : ''; ?>" id="formSection">
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
                <option value="<?= $row['id_user'] ?>" <?=  $selected ?>><?= $row['nama'] ?></option>
                <?php } ?>
              </select>
              <small class="form-text text-muted">Pilih satu atau lebih peserta</small>
            </div>
          </div>

          <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn btn-primary">
              <?php echo $editMode ? '💾 Update Data' : '💾 Simpan Data'; ?>
            </button>
            <button type="button" class="btn btn-secondary" onclick="toggleForm()">❌ Batal</button>
          </div>

        </form>
      </div>

      <!-- Manajemen Jadwal Rapat -->
      <div class="card">
        <div class="card-title">Manajemen Jadwal Rapat</div>

        <div class="meeting-grid">
          <?php 
          if(mysqli_num_rows($dataRapat) > 0) {
            while($row = $dataRapat->fetch_array()){
              // Hitung jumlah peserta
              $id_rapat = $row['id_rapat'];
              $countPeserta = mysqli_query($mysqli, "SELECT COUNT(*) as total FROM tb_rapat WHERE id_rapat = '$id_rapat'");
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
                <i>📊</i> Status: <strong><?= ucfirst($row['status']) ?></strong>
              </div>
              <div class="button-group">
                <a href="?edit=<?= $row['id_rapat'] ?>" class="btn btn-primary">✏️ Edit</a>
                <button class="btn btn-outline" onclick="hapusRapat(<?= $row['id_rapat'] ?>)">🗑️ Hapus</button>
              </div>
            </div>
          </div>
          <?php 
            }
          } else {
            echo '<p class="text-center">Tidak ada data rapat</p>';
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
    });

    // Fungsi Hapus Rapat
    function hapusRapat(id) {
      if(confirm('Apakah Anda yakin ingin menghapus data rapat ini?')) {
        window.location.href = 'hapus_rapat.php?id=' + id;
      }
    }
    
    // Auto scroll ke form saat mode edit
    <?php if($editMode): ?>
    window.addEventListener('load', function() {
      document.getElementById('formSection').scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
    <?php endif; ?>
  </script>

</body>
</html>