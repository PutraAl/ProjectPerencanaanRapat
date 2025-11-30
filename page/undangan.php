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
                    <a href="user.php">Dashboard</a>
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
                    <a href="logout.php">Keluar</a>
                </li>
            </ul>

</div>
        <!-- End Sidebar -->


        <!-- Main Content -->
        <div class="main-content">

            <div id="invitations" class="page">

                <div class="card">
                    <h2 class="card-title">Undangan Rapat</h2>
                    <p>Anda memiliki <span id="invitation-count">2</span> undangan rapat</p>
                </div>

                <!-- Search + Notif -->
                <div class="top-bar">

                    <div class="search-box">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" id="searchInput" placeholder="Cari judul atau tanggal..."
                            onkeyup="filterUndangan()">
                    </div>

                    <div class="notif-icon">
                        <i class="bi bi-bell"></i>
                        <span class="notif-count">2</span>
                    </div>

                </div>
                <!-- End Search + Notif -->

                <!-- Grid Undangan -->
                <div class="meeting-grid" id="invitations-grid">

                    <!-- Card 1 -->
                    <div class="meeting-card">

                        <div class="meeting-header">
                            <h3>Persiapan Wisuda Semester Ganjil</h3>
                        </div>

                        <div class="rapat-item"
                            data-judul="<?= strtolower($r['Persiapan Wisuda Semester Ganjil']) ?>"
                            data-tanggal="<?= strtolower($r['02 sep 2025']) ?>"
                            style="width: 330px;">
                        </div>

                        <div class="meeting-body">
                            <div class="meeting-detail-visible">

                                <div class="meeting-detail"><i>📅</i> <span>senin, 02 sep 2025</span></div>
                                <div class="meeting-detail"><i>⏰</i> <span>10:00 s/d 11:30 WIB</span></div>
                                <div class="meeting-detail"><i>📍</i> <span>Gedung Technopreneur</span></div>
                                <div class="meeting-detail"><i>👥</i> <span>Tim Pengembang</span></div>

                                <div class="content-hidden" id="detail-wisuda-1">
                                    <p>
                                        Rapat Persiapan Wisuda Semester Ganjil dilaksanakan untuk membahas dan memfinalisasi seluruh kebutuhan teknis serta non-teknis yang diperlukan dalam penyelenggaraan wisuda, termasuk susunan acara, penataan lokasi, koordinasi panitia, serta kesiapan logistik dan dokumentasi. Pertemuan ini bertujuan memastikan seluruh rangkaian kegiatan dapat berjalan tertib, lancar, dan sesuai standar pelaksanaan yang telah ditetapkan.
                                    </p>
                                </div>

                            </div>

                            <button class="toggle-button" onclick="toggleDetail('detail-wisuda-1')">
                                Tampilkan Detail
                            </button>

                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="meeting-card">

                        <div class="meeting-header">
                            <h3>Evaluasi Kinerja UKM Seni & Olahraga 2025</h3>
                        </div>

                        <div class="rapat-item"
                            data-judul="<?= strtolower($r['Evaluasi Kinerja UKM Seni & Olahraga 2025']) ?>"
                            data-tanggal="<?= strtolower($r['10 sep 2025']) ?>"
                            style="width: 330px;">
                        </div>

                        <div class="meeting-body">
                            <div class="meeting-detail-visible">

                                <div class="meeting-detail"><i>📅</i> <span>selasa, 10 sep 2025</span></div>
                                <div class="meeting-detail"><i>⏰</i> <span>14:00 s/d 15:30 WIB</span></div>
                                <div class="meeting-detail"><i>📍</i> <span>Gedung Utama</span></div>
                                <div class="meeting-detail"><i>👥</i> <span>Seluruh Anggota</span></div>

                                <div class="content-hidden" id="detail-UKM-1">
                                    <p>
                                        Rapat Evaluasi Kinerja UKM Seni & Olahraga 2025 diselenggarakan untuk meninjau capaian program kerja yang telah dilaksanakan sepanjang tahun, mengevaluasi efektivitas kegiatan, serta mengidentifikasi kendala yang muncul dalam operasional UKM. Pertemuan ini juga bertujuan merumuskan rekomendasi perbaikan, peningkatan kinerja, serta rencana pengembangan kegiatan yang lebih optimal untuk periode selanjutnya.
                                    </p>
                                </div>

                            </div>

                            <button class="toggle-button" onclick="toggleDetail('detail-UKM-1')">
                                Tampilkan Detail
                            </button>

                        </div>
                    </div>

                </div>
                <!-- End Grid -->

            </div>
        </div>

    </div> <!-- End Container -->

    <!-- JavaScript -->
    <script>
        // responsive hamburger
        const btn = document.getElementById("hamburgerBtn");
        const sidebar = document.querySelector(".sidebar");

        btn.addEventListener("click", () => {
            sidebar.classList.toggle("active");
        });

        // filter search
        function filterUndangan() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const cards = document.querySelectorAll('.meeting-card');

            cards.forEach(card => {
                const title = card.querySelector('h3').innerText.toLowerCase();
                const body = card.querySelector('.meeting-body').innerText.toLowerCase();

                card.style.display = (title.includes(filter) || body.includes(filter))
                    ? ""
                    : "none";
            });
        }

        // sidebar toggle
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("active");
        }

        // detail toggle
        function toggleDetail(id) {
            const content = document.getElementById(id);
            const button = event.target;

            content.classList.toggle('active');
            button.textContent = content.classList.contains('active')
                ? 'Sembunyikan Detail'
                : 'Tampilkan Detail';
        }
    </script>

</body>

</html>
