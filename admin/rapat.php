<?php
include "../connection/server.php";
require_once "../action/data_rapat.php";
require_once "../connection/middleware.php";
middlewareAdmin();
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

  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> -->

  <link rel="stylesheet" href="../assets/css/adminpagenew.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <style>
  
  </style>
</head>

<body>

  <!-- Hamburger Button -->
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
        <li class="menu-item">
          <i class="fa-solid fa-chart-line"></i>
          <a href="dashboard.php">Dashboard</a>
        </li>

        <li class="menu-item active">
          <i class="fa-solid fa-envelope"></i>
          <a href="rapat.php">Rapat</a>
        </li>

        <li class="menu-item">
          <i class="fa-solid fa-user"></i>
          <a href="profile.php">Profil</a>
        </li>

        <li class="menu-item">
          <i class="fa-solid fa-user"></i>
          <a href="user.php">User</a>
        </li>

        <li class="menu-item">
          <i class="fa-solid fa-right-from-bracket"></i>
          <a href="../action/logout.php">Keluar</a>
        </li>
      <!-- </ul> -->
    </div>
    <!-- End Sidebar -->

    <div class="main-content">

      <!-- Header -->
      <div class="header">
        <div class="page-title">Pengelolaan Data Rapat</div>
        <div class="user-info">
          <span>Admin</span>          
          <div class="user-avatar">A</div>
        </div>
      </div>

      <!-- Stats Section -->
      <div class="stats-container">
        <div class="stat-card">
          <div class="stat-value"><?= $rapatToday->num_rows ?></div>
          <div class="stat-label">Rapat Hari Ini</div>
        </div>
        <div class="stat-card">
          <div class="stat-value"><?= $rapatMinggu->num_rows ?></div>
          <div class="stat-label">Rapat Minggu Ini</div>
        </div>
        <div class="stat-card">
          <div class="stat-value"><?= $rapatMendatang->num_rows ?></div>
          <div class="stat-label">Rapat Mendatang</div>
        </div>
        <div class="stat-card">
          <div class="stat-value"><?= $rapatBelumSelesai->num_rows ?></div>
          <div class="stat-label">Rapat Belum Selesai</div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="mb-3 d-flex gap-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formRapatModal" 
          onclick="resetFormRapat()">
          ➕ Tambah Data Rapat
        </button>
        <?php if ($absensiMode): ?>
        <a href="rapat.php" class="btn btn-secondary">❌ Batal</a>
        <?php endif; ?>
      </div>

      <!-- Filter Card -->
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="mb-3">Filter & Pencarian Rapat</h5>
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
                <button type="submit" class="btn btn-primary flex-fill"> Filter</button>
                <a href="rapat.php" class="btn btn-secondary flex-fill"> Reset</a>
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

      <!-- Modal Form Rapat (Tambah/Edit) -->
      <div class="modal fade" id="formRapatModal" tabindex="-1" aria-labelledby="formRapatLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="formRapatLabel">Tambah Data Rapat Baru</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="../action/tambah_rapat.php" method="POST" id="meeting-form">
                <input type="hidden" name="id_rapat" id="id_rapat_hidden" value="">

                <div class="mb-3">
                  <label for="meeting-title" class="form-label">Judul Rapat <span class="text-danger">*</span></label>
                  <input type="text" name="judul" id="meeting-title" class="form-control" 
                    placeholder="Masukkan judul rapat" required>
                </div>

                <div class="mb-3">
                  <label for="meeting-desc" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                  <textarea name="deskripsi" id="meeting-desc" class="form-control" rows="3"
                    placeholder="Masukkan deskripsi rapat" required></textarea>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="meeting-date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" id="meeting-date" class="form-control" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="meeting-time" class="form-label">Waktu <span class="text-danger">*</span></label>
                    <input type="time" name="waktu" id="meeting-time" class="form-control" required>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="meeting-location" class="form-label">Lokasi / Platform <span class="text-danger">*</span></label>
                  <input type="text" name="lokasi" id="meeting-location" class="form-control"
                    placeholder="Ruang 101 / Zoom / Teams" required>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="meeting-status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" id="meeting-status" class="form-control">
                      <option value="dijadwalkan">Dijadwalkan</option>
                      <option value="selesai">Selesai</option>
                      <option value="dibatalkan">Dibatalkan</option>
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="peserta" class="form-label">Peserta <span class="text-danger">*</span></label>
                    <div class="peserta-selector-container">
                      <div class="peserta-input-field" id="pesertaInputField">
                        <div class="peserta-tags" id="pesertaTags"></div>
                        <i class="fas fa-chevron-down" id="pesertaChevron" style="color: #999;"></i>
                      </div>
                      
                      <div class="peserta-dropdown" id="pesertaDropdown">
                        <div class="peserta-search">
                          <input type="text" id="pesertaSearch" placeholder="Cari peserta...">
                        </div>

                        <div class="peserta-actions">
                          <button type="button" class="btn-select-all" id="btnSelectAll">
                            <i class="fas fa-check"></i> Pilih Semua
                          </button>
                          <button type="button" class="btn-deselect-all" id="btnDeselectAll" style="display: none;">
                            <i class="fas fa-times"></i> Hapus Semua
                          </button>
                        </div>

                        <div class="peserta-list" id="pesertaList"></div>

                        <div class="peserta-empty" id="pesertaEmpty" style="display: none;">
                          Tidak ada peserta tersedia
                        </div>

                        <div class="peserta-add-new">
                          <button type="button" id="btnAddNewPeserta">
                            <i class="fas fa-plus"></i> Tambah Peserta Baru
                          </button>
                        </div>
                      </div>
                    </div>

                    <div class="peserta-selected-count" id="pesertaSelectedCount">
                      Pilih satu atau lebih peserta
                    </div>
                    <div class="peserta-selected-list" id="pesertaSelectedList"></div>

                    <input type="hidden" name="peserta" id="peserta-hidden" value="">
                  </div>
                </div>

                <div class="mb-3" id="notulenContainer" style="display: none;">
                  <label for="notulen" class="form-label">Notulen Rapat</label>
                  <textarea name="notulen" id="notulen" class="form-control" rows="4"
                    placeholder="Masukkan notulen/catatan hasil rapat..."></textarea>
                  <small class="form-text text-muted">Field ini hanya tersedia saat mengedit rapat</small>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" form="meeting-form" class="btn btn-primary" id="submitBtnModal">
                 Simpan Data
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Absensi -->
      <?php if ($absensiMode): ?>
      <div class="modal fade show" id="absensiModal" tabindex="-1" aria-labelledby="absensiLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="absensiLabel">✅ Absensi Rapat: <?= $rapatAbsensi['judul'] ?></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="alert alert-info mb-3">
                <strong>📅 Tanggal:</strong> <?= date('d M Y', strtotime($rapatAbsensi['tanggal'])) ?> |
                <strong>⏰ Waktu:</strong> <?= date('H:i', strtotime($rapatAbsensi['waktu'])) ?> |
                <strong>📍 Lokasi:</strong> <?= $rapatAbsensi['lokasi'] ?>
              </div>

              <form action="../action/konfirmasi_kehadiran.php" method="POST" id="absensi-form">
                <input type="hidden" name="id_rapat" value="<?= $rapatAbsensi['id_rapat'] ?>">

                <h6 class="mb-3">Daftar Peserta</h6>
                <p class="text-muted mb-3">Centang peserta yang hadir pada rapat ini</p>

                <div class="table-responsive">
                  <table class="table table-hover table-sm">
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
                        while ($peserta = mysqli_fetch_array($dataPesertaRapat)) {
                          $checked = ($peserta['status_kehadiran'] == 'hadir') ? 'checked' : '';
                      ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><strong><?= $peserta['nama'] ?></strong></td>
                        <td><?= $peserta['email'] ?></td>
                        <td class="text-center">
                          <div class="form-check form-switch d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" name="kehadiran[]"
                              value="<?= $peserta['id_undangan'] ?>" id="kehadiran_<?= $peserta['id_undangan'] ?>"
                              <?= $checked ?>>
                            <label class="form-check-label ms-2" for="kehadiran_<?= $peserta['id_undangan'] ?>">
                              <span class="badge bg-success" id="badge_<?= $peserta['id_undangan'] ?>"
                                style="<?= !$checked ? 'display:none;' : '' ?>">Hadir</span>
                              <span class="badge bg-danger" id="badge_tidak_<?= $peserta['id_undangan'] ?>"
                                style="<?= $checked ? 'display:none;' : '' ?>">Tidak Hadir</span>
                            </label>
                          </div>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <a href="rapat.php" class="btn btn-secondary">Batal</a>
              <button type="submit" form="absensi-form" name="absen_admin" class="btn btn-success">
                 Simpan Absensi
              </button>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>

      <!-- Meeting Schedule Card -->
      <div class="card mb-4">
        <div class="card-title">
          Manajemen Jadwal Rapat
          <span class="badge bg-secondary"><?= mysqli_num_rows($dataRapat) ?> Data</span>
        </div>

        <div class="meeting-grid">
          <?php
          if (mysqli_num_rows($dataRapat) > 0) {
            while ($row = $dataRapat->fetch_array()) {
            $id_rapat = $row['id_rapat'];
            $countPeserta = mysqli_query($mysqli, "SELECT COUNT(*) as total FROM tb_undangan WHERE id_rapat = '$id_rapat'");
            $jumlahPeserta = mysqli_fetch_array($countPeserta)['total'];
            
            // Dapatkan peserta IDs
            $queryPeserta = mysqli_query($mysqli, "SELECT GROUP_CONCAT(CAST(id_peserta AS CHAR)) as peserta_ids FROM tb_undangan WHERE id_rapat = '$id_rapat'");
            $pesertaData = mysqli_fetch_assoc($queryPeserta);
            $peserta_ids = $pesertaData['peserta_ids'] ?: '';
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
                <i></i> Status:
                <?php
                    $badgeClass = '';
                    if ($row['status'] == 'dijadwalkan') $badgeClass = 'bg-primary';
                    elseif ($row['status'] == 'selesai') $badgeClass = 'bg-success';
                    elseif ($row['status'] == 'dibatalkan') $badgeClass = 'bg-danger';
                    ?>
                <span class="badge <?= $badgeClass ?>"><?= ucfirst($row['status']) ?></span>
              </div>
              <?php if (!empty($row['notulen'])): ?>
              <div class="meeting-detail">
                <i>📝</i> <strong>Notulen:</strong>
                <?= substr($row['notulen'], 0, 80) ?><?= strlen($row['notulen']) > 80 ? '...' : '' ?>
              </div>
              <?php endif; ?>
              <div class="button-group">
                 <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formRapatModal"
                onclick="loadEditDataFromButton(this)"
                data-id_rapat="<?= $row['id_rapat'] ?>"
                data-judul="<?= htmlspecialchars($row['judul']) ?>"
                data-deskripsi="<?= htmlspecialchars($row['deskripsi']) ?>"
                data-tanggal="<?= $row['tanggal'] ?>"
                data-waktu="<?= $row['waktu'] ?>"
                data-lokasi="<?= htmlspecialchars($row['lokasi']) ?>"
                data-status="<?= $row['status'] ?>"
                data-notulen="<?= htmlspecialchars($row['notulen'] ?: '') ?>"
                 data-peserta_ids="<?= $peserta_ids ?>">
                 Edit
            </button>

                <?php if ($row['status'] == 'selesai'): ?>
                <a href="?absensi=<?= $row['id_rapat'] ?>" class="btn btn-success">✅ Absensi</a>
                <?php endif; ?>

                <button class="btn btn-outline" onclick="hapusRapat(<?= $row['id_rapat'] ?>)"> Hapus</button>
              </div>
            </div>
          </div>
          <?php
            }
          } else {
            echo '<div class="alert alert-warning text-center mb-0">⚠️ Tidak ada data rapat ditemukan</div>';
          }
          ?>
        </div>
      </div>
 
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
              // Tentukan range halaman yang ditampilkan
              $startPage = max(1, $currentPage - 2);
              $endPage = min($totalPages, $currentPage + 2);

              // Tampilkan halaman pertama jika tidak termasuk range
              if ($startPage > 1) {
                echo '<li class="page-item"><a class="page-link" href="' . buildPaginationUrl(1, $filterTanggalDari, $filterTanggalSampai, $filterStatus) . '">1</a></li>';
                if ($startPage > 2) {
                  echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                }
              }

              // Tampilkan range halaman
              for ($page = $startPage; $page <= $endPage; $page++) {
                $active = ($page === $currentPage) ? 'active' : '';
                echo '<li class="page-item ' . $active . '"><a class="page-link" href="' . buildPaginationUrl($page, $filterTanggalDari, $filterTanggalSampai, $filterStatus) . '">' . $page . '</a></li>';
              }

              // Tampilkan halaman terakhir jika tidak termasuk range
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
          <div class="pagination-info text-center mt-3 text-muted">
            Menampilkan data <?= (($currentPage - 1) * $itemsPerPage) + 1 ?> - 
            <?= min($currentPage * $itemsPerPage, $totalData) ?> 
            dari <?= $totalData ?> data
          </div>
        </div>
        <?php endif; ?>

      </div>
    

    </div>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const sidebar = document.querySelector('.sidebar');
    const formRapatModal = new bootstrap.Modal(document.getElementById('formRapatModal'));
    const meetingForm = document.getElementById('meeting-form');

    // Data Peserta dari Database
    let allPeserta = [
      <?php 
        $dataPeserta = mysqli_query($mysqli, "SELECT * FROM tb_user WHERE role = 'peserta' ORDER BY nama ASC");
        $pesertaArray = [];
        while ($row = mysqli_fetch_assoc($dataPeserta)) {
          $pesertaArray[] = "{ id: {$row['id_user']}, nama: '{$row['nama']}' }";
        }
        echo implode(',', $pesertaArray);
      ?>
    ];

    let selectedPesertaIds = [];
    const pesertaInputField = document.getElementById('pesertaInputField');
    const pesertaDropdown = document.getElementById('pesertaDropdown');
    const pesertaTags = document.getElementById('pesertaTags');
    const pesertaSearch = document.getElementById('pesertaSearch');
    const pesertaList = document.getElementById('pesertaList');
    const pesertaEmpty = document.getElementById('pesertaEmpty');
    const btnSelectAll = document.getElementById('btnSelectAll');
    const btnDeselectAll = document.getElementById('btnDeselectAll');
    const btnAddNewPeserta = document.getElementById('btnAddNewPeserta');
    const pesertaSelectedCount = document.getElementById('pesertaSelectedCount');
    const pesertaSelectedList = document.getElementById('pesertaSelectedList');
    const pesertaHidden = document.getElementById('peserta-hidden');

    // Hamburger Menu
    hamburgerBtn?.addEventListener('click', () => {
      sidebar.classList.toggle('active');
      document.addEventListener('click', (e) => {
        if (!sidebar.contains(e.target) && !hamburgerBtn.contains(e.target)) {
          sidebar.classList.remove('active');
        }
      });
    });

    // Peserta Selector Functions
    function renderPesertaList() {
      pesertaList.innerHTML = '';
      const searchTerm = pesertaSearch.value.toLowerCase();
      const availablePeserta = allPeserta.filter(p => 
        !selectedPesertaIds.includes(p.id) && 
        p.nama.toLowerCase().includes(searchTerm)
      );

      if (availablePeserta.length === 0) {
        pesertaEmpty.style.display = 'block';
      } else {
        pesertaEmpty.style.display = 'none';
        availablePeserta.forEach(peserta => {
          const item = document.createElement('div');
          item.className = 'peserta-item';
          item.innerHTML = `
            <input type="checkbox" id="peserta_${peserta.id}" value="${peserta.id}">
            <label for="peserta_${peserta.id}">${peserta.nama}</label>
          `;
          item.querySelector('input').addEventListener('change', () => togglePeserta(peserta.id));
          pesertaList.appendChild(item);
        });
      }
    }

    function togglePeserta(pesertaId) {
      const index = selectedPesertaIds.indexOf(pesertaId);
      if (index > -1) {
        selectedPesertaIds.splice(index, 1);
      } else {
        selectedPesertaIds.push(pesertaId);
      }
      updatePesertaDisplay();
    }

    function updatePesertaDisplay() {
      // Update tags
      pesertaTags.innerHTML = '';
      selectedPesertaIds.forEach(id => {
        const peserta = allPeserta.find(p => p.id === id);
        if (peserta) {
          const tag = document.createElement('div');
          tag.className = 'peserta-tag';
          tag.innerHTML = `
            ${peserta.nama}
            <span class="remove-btn" onclick="removePeserta(${id})">✕</span>
          `;
          pesertaTags.appendChild(tag);
        }
      });

      // Update count
      if (selectedPesertaIds.length === 0) {
        pesertaSelectedCount.textContent = 'Pilih satu atau lebih peserta';
        pesertaSelectedList.innerHTML = '';
      } else {
        pesertaSelectedCount.innerHTML = `<strong>${selectedPesertaIds.length}</strong> peserta dipilih`;
        pesertaSelectedList.innerHTML = '';
        selectedPesertaIds.forEach(id => {
          const peserta = allPeserta.find(p => p.id === id);
          if (peserta) {
            const badge = document.createElement('span');
            badge.className = 'peserta-badge';
            badge.textContent = `✓ ${peserta.nama}`;
            pesertaSelectedList.appendChild(badge);
          }
        });
      }

      // Update hidden input
      pesertaHidden.value = selectedPesertaIds.join(',');

      // Update button visibility
      if (selectedPesertaIds.length > 0) {
        btnDeselectAll.style.display = 'flex';
      } else {
        btnDeselectAll.style.display = 'none';
      }

      renderPesertaList();
    }

    function removePeserta(pesertaId) {
      togglePeserta(pesertaId);
    }

    // Peserta Input Field Click
    pesertaInputField.addEventListener('click', () => {
      pesertaDropdown.classList.toggle('open');
      pesertaInputField.classList.toggle('active');
      if (pesertaDropdown.classList.contains('open')) {
        pesertaSearch.focus();
      }
    });

    // Search Filter
    pesertaSearch.addEventListener('input', renderPesertaList);

    // Select All Button
    btnSelectAll.addEventListener('click', (e) => {
      e.preventDefault();
      const searchTerm = pesertaSearch.value.toLowerCase();
      const availablePeserta = allPeserta.filter(p => 
        !selectedPesertaIds.includes(p.id) && 
        p.nama.toLowerCase().includes(searchTerm)
      );
      availablePeserta.forEach(p => {
        if (!selectedPesertaIds.includes(p.id)) {
          selectedPesertaIds.push(p.id);
        }
      });
      updatePesertaDisplay();
    });

    // Deselect All Button
    btnDeselectAll.addEventListener('click', (e) => {
      e.preventDefault();
      selectedPesertaIds = [];
      updatePesertaDisplay();
    });

    // Add New Peserta
    btnAddNewPeserta.addEventListener('click', (e) => {
      e.preventDefault();
      const newName = prompt('Masukkan nama peserta baru:');
      if (newName && newName.trim()) {
        const newId = Math.max(...allPeserta.map(p => p.id), 0) + 1;
        allPeserta.push({ id: newId, nama: newName.trim() });
        renderPesertaList();
      }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
      if (!e.target.closest('.peserta-selector-container')) {
        pesertaDropdown.classList.remove('open');
        pesertaInputField.classList.remove('active');
      }
    });

    // Reset Form Rapat (Tambah Baru)
    function resetFormRapat() {
      meetingForm.action = '../action/tambah_rapat.php';
      document.getElementById('id_rapat_hidden').value = '';
      document.getElementById('formRapatLabel').textContent = 'Tambah Data Rapat Baru';
      document.getElementById('submitBtnModal').innerHTML = '💾 Simpan Data';
      document.getElementById('notulenContainer').style.display = 'none';
      meetingForm.reset();
      selectedPesertaIds = [];
      pesertaSearch.value = '';
      updatePesertaDisplay();
    }

    // Load Edit Data dari Button
    function loadEditDataFromButton(button) {
      const data = {
        id_rapat: button.getAttribute('data-id_rapat'),
        judul: button.getAttribute('data-judul'),
        deskripsi: button.getAttribute('data-deskripsi'),
        tanggal: button.getAttribute('data-tanggal'),
        waktu: button.getAttribute('data-waktu'),
        lokasi: button.getAttribute('data-lokasi'),
        status: button.getAttribute('data-status'),
        notulen: button.getAttribute('data-notulen'),
        peserta_ids: button.getAttribute('data-peserta_ids')
      };
      
      // Isi form dengan data
      document.getElementById('id_rapat_hidden').value = data.id_rapat;
      document.getElementById('meeting-title').value = data.judul;
      document.getElementById('meeting-desc').value = data.deskripsi;
      document.getElementById('meeting-date').value = data.tanggal;
      document.getElementById('meeting-time').value = data.waktu;
      document.getElementById('meeting-location').value = data.lokasi;
      document.getElementById('meeting-status').value = data.status;
      document.getElementById('notulen').value = data.notulen;
      
      // Set action form untuk update
      meetingForm.action = '../action/proses_edit_rapat.php';
      document.getElementById('formRapatLabel').textContent = 'Edit Data Rapat';
      document.getElementById('submitBtnModal').innerHTML = '💾 Update Data';
      document.getElementById('notulenContainer').style.display = 'block';
      
      // Set peserta yang dipilih
      selectedPesertaIds = data.peserta_ids ? data.peserta_ids.split(',').map(id => parseInt(id)) : [];
      pesertaSearch.value = '';
      updatePesertaDisplay();
    }

    // Delete Meeting
    function hapusRapat(id) {
      if (confirm('Yakin ingin menghapus rapat ini?')) {
        window.location.href = '../action/hapus_rapat.php?id=' + id;
      }
    }

    // Auto show absensi modal
    <?php if ($absensiMode): ?>
    const absensiModal = new bootstrap.Modal(document.getElementById('absensiModal'));
    absensiModal.show();
    <?php endif; ?>
  </script>

</body>
</html>