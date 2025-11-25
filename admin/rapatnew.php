<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perencanaan Rapat - Dashboard Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/css/adminpagenew.css">
</head>

<body>

    <!-- Tombol Hamburger -->
    <button class="hamburger" id="hamburgerBtn">☰</button>

    <div class="container">

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
                    <a href="rapatnew.php">Rapat</a>
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
      <div class="user-avatar">U</div>
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

  <!-- Manajemen Jadwal Rapat -->
  <div class="card">
    <div class="card-title">Manajemen Jadwal Rapat</div>
    <div class="meeting-grid">
      <div class="meeting-card">
        <div class="meeting-header">Rapat Akademik</div>
        <div class="meeting-body">
          <div class="meeting-detail">
            <i>📅</i> 28 Nov 2025, 09:00 - 11:00
          </div>
          <div class="meeting-detail">
            <i>📍</i> Ruang 101
          </div>
          <div class="meeting-detail">
            <i>👥</i> Fakultas Teknik
          </div>
          <div class="button-group">
            <button class="btn btn-primary">Edit</button>
            <button class="btn btn-outline">Hapus</button>
          </div>
        </div>
      </div>

      <div class="meeting-card">
        <div class="meeting-header">Rapat Penelitian</div>
        <div class="meeting-body">
          <div class="meeting-detail">
            <i>📅</i> 29 Nov 2025, 14:00 - 16:00
          </div>
          <div class="meeting-detail">
            <i>💻</i> Zoom / Teams
          </div>
          <div class="meeting-detail">
            <i>👥</i> Fakultas Sains
          </div>
          <div class="button-group">
            <button class="btn btn-primary">Edit</button>
            <button class="btn btn-outline">Hapus</button>
          </div>
        </div>
      </div>
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
            <button class="btn btn-primary">Lihat</button>
            <button class="btn btn-outline">Download</button>
          </div>
        </div>
      </div>
      <div class="meeting-card">
        <div class="meeting-header">Rapat Penelitian</div>
        <div class="meeting-body">
          <div class="meeting-detail"><i>📝</i> Notulen Tersedia</div>
          <div class="meeting-detail"><i>📎</i> Dokumen Pendukung</div>
          <div class="button-group">
            <button class="btn btn-primary">Lihat</button>
            <button class="btn btn-outline">Download</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tindak Lanjut & Monitoring -->
  <div class="card">
    <div class="card-title">Tindak Lanjut & Monitoring</div>
    <ul class="meeting-list">
      <li class="meeting-item">
        <div>
          <div class="meeting-title">Tugas: Persiapan Proposal</div>
          <div class="meeting-time">Deadline: 30 Nov 2025</div>
        </div>
        <span class="badge badge-primary">Sedang</span>
      </li>
      <li class="meeting-item">
        <div>
          <div class="meeting-title">Tugas: Laporan Penelitian</div>
          <div class="meeting-time">Deadline: 05 Des 2025</div>
        </div>
        <span class="badge badge-warning">Belum Dikerjakan</span>
      </li>
      <li class="meeting-item">
        <div>
          <div class="meeting-title">Tugas: Review Notulen</div>
          <div class="meeting-time">Deadline: 27 Nov 2025</div>
        </div>
        <span class="badge badge-success">Selesai</span>
      </li>
    </ul>
  </div>

</div>

          <!-- JavaScript -->
    <script>
        const btn = document.getElementById("hamburgerBtn");
        const sidebar = document.querySelector(".sidebar");

        btn.addEventListener("click", () => {
            sidebar.classList.toggle("active");
        });
    </script>

</body>

</html>