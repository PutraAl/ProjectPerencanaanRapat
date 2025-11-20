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
<!-- Tombol Hamburger -->
    <button class="hamburger" id="hamburgerBtn">☰</button>

<!-- Halaman sidebar -->
        <div class="container">
        <div class="sidebar" id="sidebar">
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
<div class="search-wrapper" id="search-bar">
    <div class="input-group mb-4" style="max-width: 400px;">
    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
    <input type="text" id="searchInput" placeholder="Cari judul atau tanggal..." onkeyup="filterUndangan()">
            
            <!-- Notifikasi -->
<div class="position-relative me-4" style="cursor: pointer;">
    <i class="bi bi-bell fs-4"></i>
    <div class="notification-area">
    <a href="#" id="notificationBell">
    <i class="fas fa-bell"></i>
    <span class="badge">2</span></a></div>

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
                        <div class="meeting-detail-visible">
                            <div class="meeting-detail"><i>📅</i> <span>senin, 02 sep 202...</span></div>
                            <div class="meeting-detail"><i>⏰</i> <span>10:00 s/d 11:30 WIB</span></div>
                            <div class="meeting-detail"><i>📍</i> <span>Gedung Technopreneur</span></div>
                            <div class="meeting-detail"><i>👥</i> <span>Tim Pengembang</span></div>

                            <div class="content-hidden" id="detail-wisuda-1">
                            <p>Rapat Persiapan Wisuda Semester Ganjil dilaksanakan untuk membahas dan memfinalisasi seluruh kebutuhan teknis serta non-teknis yang diperlukan dalam penyelenggaraan wisuda, termasuk susunan acara, penataan lokasi, koordinasi panitia, serta kesiapan logistik dan dokumentasi. Pertemuan ini bertujuan memastikan seluruh rangkaian kegiatan dapat berjalan tertib, lancar, dan sesuai standar pelaksanaan yang telah ditetapkan.</p>
                            </div>
                        </div>

                        <button class="toggle-button" onclick="toggleDetail('detail-wisuda-1')">Tampilkan Detail</button>
                    </div>
                </div>


                    <div class="meeting-card">
                    <div class="meeting-header">
                        <h3>Evaluasi Kinerja UKM Seni & Olahraga 2025</h3>
                    </div>
                    <div class="rapat-item" 
                        data-judul="<?= strtolower($r['Evaluasi Kinerja UKM Seni & Olahraga 2025']) ?>"
                        data-tanggal="<?= strtolower($r['10 sep 202...']) ?>"
                        style="width: 330px;">
                    </div>
                    <div class="meeting-body">
                        <div class="meeting-detail-visible">
                            <div class="meeting-detail"><i>📅</i> <span>selasa, 10 sep 202...</span></div>
                            <div class="meeting-detail"><i>⏰</i> <span>14:00 s/d 15:30 WIB</span></div>
                            <div class="meeting-detail"><i>📍</i> <span>Gedung Utama</span></div>
                            <div class="meeting-detail"><i>👥</i> <span>Seluruh Anggota</span></div>

                            <div class="content-hidden" id="detail-UKM-1">
                            <p>Rapat Evaluasi Kinerja UKM Seni & Olahraga 2025 diselenggarakan untuk meninjau capaian program kerja yang telah dilaksanakan sepanjang tahun, mengevaluasi efektivitas kegiatan, serta mengidentifikasi kendala yang muncul dalam operasional UKM. Pertemuan ini juga bertujuan merumuskan rekomendasi perbaikan, peningkatan kinerja, serta rencana pengembangan kegiatan yang lebih optimal untuk periode selanjutnya.</p>
                            </div>

                            <button class="toggle-button" onclick="toggleDetail('detail-UKM-1')">Tampilkan Detail</button>
                        </div>
                    </div>
                </div>
            

</body>
<script>
// responsive hamburger
    const btn = document.getElementById("hamburgerBtn");
    const sidebar = document.querySelector(".sidebar");

    btn.addEventListener("click", () => {
        sidebar.classList.toggle("active");
    });

// sidebar
function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("active");
}

// search undangan
function filterUndangan() {
    // 1. Ambil nilai yang diketik pengguna dan ubah menjadi huruf kecil (case-insensitive)
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    
    // 2. Ambil kontainer grid dan semua kartu undangan di dalamnya
    const grid = document.getElementById('invitations-grid');
    const cards = grid.getElementsByClassName('meeting-card');
    
    // 3. Iterasi setiap kartu dan periksa kecocokan
    for (let i = 0; i < cards.length; i++) {
        const card = cards[i];
        
        // Ambil teks Judul Rapat (Persiapan Wisuda...) dan Detail Tanggal/Waktu
        // Asumsi Judul ada di H3 di dalam .meeting-card
        const titleElement = card.querySelector('h3'); 
        
        // Asumsi detail rapat (termasuk tanggal) ada di dalam .meeting-body
        const bodyElement = card.querySelector('.meeting-body');
        
        if (titleElement || bodyElement) {
            let textValue = '';

            // Gabungkan teks judul dan detail agar pencarian mencakup keduanya
            if (titleElement) {
                textValue += titleElement.textContent || titleElement.innerText;
            }
            if (bodyElement) {
                textValue += ' ' + (bodyElement.textContent || bodyElement.innerText);
            }
            
            // Periksa apakah teks kartu mengandung kata kunci pencarian
            if (textValue.toLowerCase().includes(filter)) {
                // Jika cocok: Tampilkan kartu
                card.style.display = ""; 
            } else {
                // Jika tidak cocok: Sembunyikan kartu
                card.style.display = "none";
            }
        }
    }
}

// detail undangan
function toggleDetail(id) {
    const content = document.getElementById(id); 
    const button = event.target; 

    // Mengganti kelas 'active'
    content.classList.toggle('active');

    // Mengganti teks tombol
    if (content.classList.contains('active')) {
        button.textContent = 'Sembunyikan Detail';
    } else {
        button.textContent = 'Tampilkan Detail';
    }
}
</script>
</html>