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

  <link rel="stylesheet" href="../assets/css/adminpagenew.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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

      <li class="menu-item ">
        <i class="fa-solid fa-chart-line"></i>
        <a href="dashboard.php">Dashboard</a>
      </li>

      <li class="menu-item active">
        <i class="fa-solid fa-envelope"></i>
        <a href="rapat.php">Rapat</a>
      </li>

      <li class="menu-item">
        <i class="fa-solid fa-users"></i>
        <a href="user.php">User</a>
      </li>

      <li class="menu-item">
        <i class="fa-solid fa-file-lines"></i>
        <a href="contact.php">Contact</a>
      </li>

      <li class="menu-item">
        <i class="fa-solid fa-user"></i>
        <a href="profile.php">Profil</a>
      </li>

      <li class="menu-item">
        <i class="fa-solid fa-right-from-bracket"></i>
        <a href="../action/logout.php">Keluar</a>
      </li>
    </div>
    <!-- End Sidebar -->

    <div class="main-content">

      <!-- Header -->
      <div class="header">
        <div class="page-title">Pengelolaan Data Rapat</div>
        <div class="user-info">
          <span class="username"><?= htmlspecialchars($data['nama']) ?></span>

          <?php if (!empty($data['foto'])): ?>
            <img src="../assets//uploads/profile/<?= htmlspecialchars($data['foto']) ?>"
              class="user-avatar-img"
              alt="Avatar">
          <?php else: ?>
            <div class="user-avatar">
              <?= strtoupper(substr($data['nama'], 0, 1)) ?>
            </div>
          <?php endif; ?>
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
              <div class="col-md-2 mb-3">
                <label for="search" class="form-label">Cari Rapat</label>
                <input type="text" name="search" id="search" class="form-control"
                  placeholder="Judul, lokasi..." value="<?= htmlspecialchars($filterSearch ?? '') ?>">
              </div>
              <div class="col-md-2 mb-3">
                <label for="tanggal_dari" class="form-label">Tanggal Dari</label>
                <input type="date" name="tanggal_dari" id="tanggal_dari" class="form-control"
                  value="<?= $filterTanggalDari ?>">
              </div>
              <div class="col-md-2 mb-3">
                <label for="tanggal_sampai" class="form-label">Tanggal Sampai</label>
                <input type="date" name="tanggal_sampai" id="tanggal_sampai" class="form-control"
                  value="<?= $filterTanggalSampai ?>">
              </div>
              <div class="col-md-2 mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                  <option value="">Semua Status</option>
                  <option value="dijadwalkan" <?= $filterStatus == 'dijadwalkan' ? 'selected' : '' ?>>Dijadwalkan</option>
                  <option value="selesai" <?= $filterStatus == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                  <option value="dibatalkan" <?= $filterStatus == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                </select>
              </div>
              <div class="col-md-4 mb-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary flex-fill"><i class="fa-solid fa-filter"></i> Filter</button>
                <a href="rapat.php" class="btn btn-secondary flex-fill"><i class="fa-solid fa-rotate-left"></i> Reset</a>
              </div>
            </div>
          </form>

          <?php if (!empty($filterTanggalDari) || !empty($filterTanggalSampai) || !empty($filterStatus) || !empty($filterSearch)): ?>
            <div class="alert alert-info mt-3 mb-0">
              <strong>Filter Aktif:</strong>
              <?php if (!empty($filterSearch)): ?>
                Pencarian: <span class="badge bg-success"><?= htmlspecialchars($filterSearch) ?></span>
              <?php endif; ?>
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
                    <input type="date" name="tanggal" id="meeting-date" class="form-control" min="<?= date('Y-m-d') ?>" required>
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
        <div class="modal fade show" id="absensiModal" tabindex="-1" aria-labelledby="absensiLabel" aria-hidden="false" style="display: block;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="absensiLabel">✅ Absensi Rapat: <?= htmlspecialchars($rapatAbsensi['judul']) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="alert alert-info mb-3">
                  <strong>📅 Tanggal:</strong> <?= date('d M Y', strtotime($rapatAbsensi['tanggal'])) ?> |
                  <strong>⏰ Waktu:</strong> <?= date('H:i', strtotime($rapatAbsensi['waktu'])) ?> |
                  <strong>📍 Lokasi:</strong> <?= htmlspecialchars($rapatAbsensi['lokasi']) ?>
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
                        if ($dataPesertaRapat && mysqli_num_rows($dataPesertaRapat) > 0) {
                          while ($peserta = mysqli_fetch_assoc($dataPesertaRapat)) {
                            $checked = ($peserta['status_kehadiran'] == 'hadir') ? 'checked' : '';
                        ?>
                            <tr>
                              <td><?= $no++ ?></td>
                              <td><strong><?= htmlspecialchars($peserta['nama']) ?></strong></td>
                              <td><?= htmlspecialchars($peserta['email']) ?></td>
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
                        <?php
                          }
                        } else {
                          echo '<tr><td colspan="4" class="text-center text-muted">Tidak ada peserta untuk rapat ini</td></tr>';
                        }
                        ?>
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
        <div class="modal-backdrop fade show" id="absensiBackdrop"></div>
      <?php endif; ?>

      <!-- Meeting Schedule Card -->
      <div class="card mb-4">
        <div class="card-title">
          Manajemen Jadwal Rapat
          <span class="badge bg-secondary"><?= $totalData ?> Data</span>
        </div>

        <div class="meeting-grid">
          <?php
          if (mysqli_num_rows($dataRapat) > 0) {
            while ($row = $dataRapat->fetch_array()) {
              $id_rapat = $row['id_rapat'];
              $countPeserta = mysqli_query($mysqli, "SELECT COUNT(*) as total FROM tb_undangan WHERE id_rapat = '$id_rapat'");
              $jumlahPeserta = mysqli_fetch_array($countPeserta)['total'];

              $queryPeserta = mysqli_query($mysqli, "SELECT GROUP_CONCAT(CAST(id_peserta AS CHAR)) as peserta_ids FROM tb_undangan WHERE id_rapat = '$id_rapat'");
              $pesertaData = mysqli_fetch_assoc($queryPeserta);
              $peserta_ids = $pesertaData['peserta_ids'] ?: '';
          ?>
              <div class="meeting-card">
                <div class="meeting-header"><?= htmlspecialchars($row['judul']) ?></div>
                <div class="meeting-body">
                  <div class="meeting-detail">
                    <i class="fa-solid fa-calendar-days"></i>
                  <?= date('d M Y', strtotime($row['tanggal'])) ?>, <?= date('H:i', strtotime($row['waktu'])) ?>
                  </div>
                  <div class="meeting-detail">
                  <i class="fa-solid fa-map-location-dot"></i>
                   <?= htmlspecialchars($row['lokasi']) ?>
                  </div>
                  <div class="meeting-detail">
                    <i class="fa-solid fa-calendar-days"></i>
                  <?= $jumlahPeserta ?> Peserta
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
                    <i class="fa-solid fa-book"></i> 
                    <strong>Notulen:</strong>
                      <?= substr(htmlspecialchars($row['notulen']), 0, 80) ?><?= strlen($row['notulen']) > 80 ? '...' : '' ?>
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
                      data-peserta_ids="<?= htmlspecialchars($peserta_ids) ?>">
                      Edit
                    </button>

                    <?php if ($row['status'] == 'selesai'): ?>
                      <a href="<?= buildPaginationUrl($currentPage, $filterTanggalDari, $filterTanggalSampai, $filterStatus, $filterSearch) . '&absensi=' . $row['id_rapat'] ?>" class="btn btn-success">✅ Absensi</a>
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

        <!-- PAGINATION -->
        <?php if ($totalPages > 1): ?>
          <div class="pagination-container">
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                  <a class="page-link" href="<?= buildPaginationUrl(max(1, $currentPage - 1), $filterTanggalDari, $filterTanggalSampai, $filterStatus, $filterSearch) ?>">
                    ← Sebelumnya
                  </a>
                </li>

                <?php
                $startPage = max(1, $currentPage - 2);
                $endPage = min($totalPages, $currentPage + 2);

                if ($startPage > 1) {
                  echo '<li class="page-item"><a class="page-link" href="' . buildPaginationUrl(1, $filterTanggalDari, $filterTanggalSampai, $filterStatus, $filterSearch) . '">1</a></li>';
                  if ($startPage > 2) {
                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                  }
                }

                for ($page = $startPage; $page <= $endPage; $page++) {
                  $active = ($page === $currentPage) ? 'active' : '';
                  echo '<li class="page-item ' . $active . '"><a class="page-link" href="' . buildPaginationUrl($page, $filterTanggalDari, $filterTanggalSampai, $filterStatus, $filterSearch) . '">' . $page . '</a></li>';
                }

                if ($endPage < $totalPages) {
                  if ($endPage < $totalPages - 1) {
                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                  }
                  echo '<li class="page-item"><a class="page-link" href="' . buildPaginationUrl($totalPages, $filterTanggalDari, $filterTanggalSampai, $filterStatus, $filterSearch) . '">' . $totalPages . '</a></li>';
                }
                ?>
              </ul>
            </nav>

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

<?php 
include "../action/js_rapat.php";
?>

</body>

</html>