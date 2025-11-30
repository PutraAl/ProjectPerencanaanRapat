<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perencanaan Rapat - Logout</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/userpage.css">
</head>

<body>
<div id="logoutNotif" class="logout-notif">✔ Anda berhasil keluar... Mengalihkan halaman</div>

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
                    <a href="dashboard.php">Dashboard</a>
                </li>

                <li class="menu-item">
                    <i>📨</i>
                    <a href="undangan.php">Undangan Rapat</a>
                </li>

                <li class="menu-item">
                    <i>👤</i>
                    <a href="profil.php">Profil</a>
                </li>

                <li class="menu-item active">
                    <i>🚪</i>
                    <a href="logout.php">Keluar</a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <!-- Halaman Logout -->
        <div class="logout-container">
            <div class="logout-card" id="logoutCard">
                <h3>Keluar dari Akun?</h3>
                <p>Apakah yakin ingin mengakhiri sesi dan keluar dari sistem?</p>

                <div class="logout-actions">
                    <button onclick="logout()" class="btn-logout">Keluar</button>
                    <button onclick="batal()" class="btn-cancel">Batal</button>
                </div>
            </div>
        </div>

    </div>

    
<script>
function logout() {
    const card = document.getElementById('logoutCard');
    const notif = document.getElementById('logoutNotif');

    // animasi kartu menghilang
    card.classList.add('fade-out');

    // tampilkan notif
    setTimeout(() => {
        notif.classList.add('show');
    }, 300);

    // redirect setelah notif muncul
    setTimeout(() => {
        window.location.href = "../action/logout.php";
    }, 1800);
}

function batal() {
    window.location.href = "dashboard.php";
}
</script>


</body>
</html>
