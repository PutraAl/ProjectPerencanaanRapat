 <?php 
 include "../connection/server.php";
 $id_user = $_SESSION['id_user'];

 $totalUndangan = mysqli_query($mysqli, "SELECT * FROM tb_undangan where id_peserta = $id_user");
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
                     <a href="dashboard.php">Dashboard</a>
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
                     <a href="">Keluar</a>
                 </li>
             </ul>

         </div>
         <!-- End Sidebar -->


         <!-- Main Content -->
         <div class="main-content">

             <div id="invitations" class="page">

                 <div class="card">
                     <h2 class="card-title">Undangan Rapat</h2>
                     <p>Anda memiliki <span id="invitation-count"><?= $totalUndangan->num_rows <= 0 ? "0" : $totalUndangan->num_rows ?></span> undangan rapat</p>
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
                                 <div class="meeting-detail"><i>Status :</i> <span><?= ucfirst($row['status']) ?></span></div>

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
                             <button class="toggle-button" onclick="toggleDetail('detail-wisuda-<?= $row['id_undangan'] ?>')">
                                 Tampilkan Detail
                             </button>
                            <?php } else {?>
 <button class="toggle-button" onclick="toggleDetail('detail-notulen-<?= $row['id_undangan'] ?>')">
                                 Lihat Notulen
                             </button>
                                <?php } ?>
                         </div>
                     </div>

                     <?php } ?>

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

                 card.style.display = (title.includes(filter) || body.includes(filter)) ?
                     "" :
                     "none";
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
             button.textContent = content.classList.contains('active') ?
                 'Sembunyikan Detail' :
                 'Tampilkan Detail';
         }
     </script>

 </body>

 </html>