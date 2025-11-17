<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Rapat - Dashboard User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/userpage.css">

</head>
<body>
        <div class="hamburger" id="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Halaman sidebar -->
        <div class="container">
        <div class="sidebar">
        <div class="logo-section">
        <img src="../assets/img/poltek.png" alt="Logo" class="logo-img">
        <hr class="divider">
        </div>
            <div class="logo">Meeting Kampus</div>
            <ul class="menu">
              <li class="menu-item ">
                    <i>📊</i> 
                    <a href="index.php">Dashboard</a> 
                </li>
                <li class="menu-item active">
                    <i>📨</i> 
                    <a href="undangan.php">Undangan Rapat</a> 
                    
                </li>
                <li class="menu-item">
                    <i>👤</i> 
                    <a href="profil.php">Profil</a> 

                </li>
                <li class="menu-item">
                    <i>🚪</i> 
                    <a href="../action/logout.php">Keluar</a> 
                    
                </li>
            </ul>
        </div>

        <div class="main-content">

            <!-- search -->
<div class="search-wrapper">
    <div class="input-group mb-4" style="max-width: 400px;">
    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
    <input type="text" class="form-control" placeholder="Cari judul atau tanggal..." id="searchInput" onkeyup="searchRapat()">
    <span class="input-group-text bg-white"><i class="bi bi-calendar-event"></i></span>
            
            <!-- Notifikasi -->
<div class="position-relative me-4" style="cursor: pointer;">
    <i class="bi bi-bell fs-4"></i>

            <!-- Badge jumlah notifikasi -->
    <span id="notifCount"
          class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
          style="font-size: 12px;">2</span>
</div>
</div>

            <!-- Halaman Undangan Rapat -->
                <div id="invitations" class="page">
                <div class="card">
                    <h2 class="card-title">Undangan Rapat</h2>
                    <p>Anda memiliki <span id="invitation-count">2</span> undangan rapat</p>
                </div>
                    
                <div class="meeting-grid" id="invitations-grid">
                    <div class="meeting-card">
                    <div class="meeting-header">
                        <h3>Persiapan Wisuda Semester Ganjil</h3>
                    </div>
                    <div class="rapat-item" 
                        data-judul="<?= strtolower($r['Persiapan Wisuda Semester Ganjil']) ?>"
                        data-tanggal="<?= strtolower($r['02 sep 202...']) ?>"
                        style="width: 330px;">
                    </div>
                    <div class="meeting-body">
                            <div class="meeting-detail"><i>📅</i> <span>senin, 02 sep 202...</span></div>
                            <div class="meeting-detail"><i>⏰</i> <span>10:00 s/d 11:30 WIB</span></div>
                            <div class="meeting-detail"><i>📍</i> <span>Gedung Technopreneur</span></div>
                            <div class="meeting-detail"><i>👥</i> <span>Tim Pengembang</span></div>
                            <p>Rapat Persiapan Wisuda Semester Ganjil dilaksanakan untuk membahas dan memfinalisasi seluruh kebutuhan teknis serta non-teknis yang diperlukan dalam penyelenggaraan wisuda, termasuk susunan acara, penataan lokasi, koordinasi panitia, serta kesiapan logistik dan dokumentasi. Pertemuan ini bertujuan memastikan seluruh rangkaian kegiatan dapat berjalan tertib, lancar, dan sesuai standar pelaksanaan yang telah ditetapkan.</p>
                        </div>
                    </div>

                    <div class="meeting-card">
                    <div class="meeting-header">
                        <h3>Evaluasi Kinerja UKM Seni & Olahraga 2025</h3>
                    </div>
                    <div class="rapat-item" 
                        data-judul="<?= strtolower($r['Persiapan Wisuda Semester Ganjil']) ?>"
                        data-tanggal="<?= strtolower($r['02 sep 202...']) ?>"
                        style="width: 330px;">
                    </div>
                    <div class="meeting-body">
                            <div class="meeting-detail"><i>📅</i> <span>selasa, 10 sep 202...</span></div>
                            <div class="meeting-detail"><i>⏰</i> <span>14:00 s/d 15:30 WIB</span></div>
                            <div class="meeting-detail"><i>📍</i> <span>Gedung Utama</span></div>
                            <div class="meeting-detail"><i>👥</i> <span>Seluruh Anggota</span></div>
                            <p>Rapat Evaluasi Kinerja UKM Seni & Olahraga 2025 diselenggarakan untuk meninjau capaian program kerja yang telah dilaksanakan sepanjang tahun, mengevaluasi efektivitas kegiatan, serta mengidentifikasi kendala yang muncul dalam operasional UKM. Pertemuan ini juga bertujuan merumuskan rekomendasi perbaikan, peningkatan kinerja, serta rencana pengembangan kegiatan yang lebih optimal untuk periode selanjutnya.</p>
                    </div>
                   </div>
                </div>
            </div>

</body>
            <script>
const hamburger = document.getElementById("hamburger");
const navMenu = document.getElementById("navMenu");

hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
});

function searchRapat() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let items = document.getElementsByClassName("rapat-item");

    for (let i = 0; i < items.length; i++) {
        let judul = items[i].getAttribute("data-judul");
        let tanggal = items[i].getAttribute("data-tanggal");

        // Cocokkan pencarian dengan judul atau tanggal
        if (judul.includes(input) || tanggal.includes(input)) {
            items[i].style.display = "block"; // tampilkan
        } else {
            items[i].style.display = "none"; // sembunyikan
        }
    }
}

        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("active");
        }
</script>
</html>