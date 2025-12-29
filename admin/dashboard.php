<?php 
include "../connection/server.php";
require_once "../connection/middleware.php" ;
middlewareAdmin();
$id_user = $_SESSION['id_user'];
$data = mysqli_query($mysqli, "SELECT * FROM tb_user where id_user = $id_user")->fetch_array();
$allUser = mysqli_query($mysqli, "SELECT * FROM tb_user  ");
$allRapat = mysqli_query($mysqli, "SELECT * FROM tb_rapat ");
$allUndangan = mysqli_query($mysqli, "SELECT * FROM tb_undangan");
$rapatPerBulan = mysqli_query($mysqli, "
    SELECT MONTH(tanggal) AS bulan, COUNT(*) AS total FROM tb_rapat GROUP BY MONTH(tanggal) ORDER BY bulan
");

$bulan = [];
$totalRapat = [];

$namaBulan = [
    "", "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];

while ($row = mysqli_fetch_assoc($rapatPerBulan)) {
    $bulan[] = $namaBulan[$row['bulan']]; 
    $totalRapat[] = (int)$row['total'];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perencanaan Rapat - Dashboard Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/adminpagenew.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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

            <div class="logo fs-4 text-center fw-bold">Meeting Kampus</div>

            <!-- <ul class="menu"> -->   
                <li class="menu-item active">
                    <i class="fa-solid fa-chart-line"></i>
                    <a href="dashboard.php">Dashboard</a>
                </li>

                <li class="menu-item">
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
            <!-- </ul> -->
        </div>
        <!-- End Sidebar -->

        <!-- Main Content: Pengelolaan Data Rapat -->
        <div class="main-content">

            <!-- Header -->
            <div class="header">
                <h2 class="page-title">Dashboard Admin</h2>

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

            <!-- Stats -->
            <div class="stats-container">
                <a href="user.php" style="text-decoration: none;">
                    <div class="stat-card">
                        <div class="stat-value" id="todayMeetingCount"><?= $allUser->num_rows ?></div>
                        <div class="stat-label">Total User</div>
                    </div>
                </a>
                <a href="rapat.php" style="text-decoration: none;">
                    <div class="stat-card">
                        <div class="stat-value" id="weekMeetingCount"><?= $allRapat->num_rows ?></div>
                        <div class="stat-label">Total Rapat</div>
                    </div>
                </a>
                <a href="rapat.php" style="text-decoration: none;">
                    <div class="stat-card">
                        <div class="stat-value" id="totalInvitation"><?= $allUndangan->num_rows ?></div>
                        <div class="stat-label">Total User Berhasil Diundang</div>
                    </div>
                </a>
            </div>


            <canvas id="myChart" width="400" height="200" class="my-4"></canvas>
            <canvas id="bulanChart" width="400" height="200"></canvas>

        </div>



        <!-- JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="../assets/js/sidebar.js"></script>
        <script>
            const totalUser = <?= $allUser -> num_rows ?> ;
            const totalRapat = <?= $allRapat -> num_rows ?> ;
            const totalUndangan = <?= $allUndangan -> num_rows ?> ;
            const labelBulan = <?= json_encode($bulan) ?>;
            const dataRapat = <?= json_encode($totalRapat) ?>;
            // Buat chart
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Total User', 'Total Rapat', 'Total Undangan'],
                    datasets: [{
                        label: 'Statistik Total',
                        data: [totalUser, totalRapat, totalUndangan],
                    }]
                }
            });

          

            new Chart(document.getElementById('bulanChart'), {
                type: 'line',
                data: {
                    labels: labelBulan,
                    datasets: [{
                        label: 'Jumlah Rapat per Bulan',
                        data: dataRapat,
                        fill: false,
                        borderWidth: 2
                    }]
                }
            });
        </script>

</body>

</html>