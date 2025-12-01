<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perencanaan Rapat - Profile Admin</title>

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
                <li class="menu-item active">
                    <i>📊</i>
                    <a href="dashboardnew.php">Dashboard</a>
                </li>

                <li class="menu-item">
                    <i>📨</i>
                    <a href="rapatnew.php">Rapat</a>
                </li>

                <li class="menu-item">
                    <i>👤</i>
                    <a href="profilenew.php">Profil</a>
                </li>

                <li class="menu-item">
                    <i>👥</i>
                    <a href="usernew.php">User</a>
                </li>

                <li class="menu-item">
                    <i>🚪</i>
                    <a href="../action/logout.php">Keluar</a>
                </li>

            </ul>
        </div>
        <!-- End Sidebar -->
<style>
       <div class="main-content">

    <div class="content-header">
        <h2>Profil Pengguna</h2>
        <p>Kelola dan perbarui informasi akun Anda.</p>
    </div>

    <div class="profile-card">
        <h3>Informasi Dasar</h3>
        
        <form action="update_profil.php" method="POST">
            
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="Budi Santoso" readonly>
            </div>

            <div class="form-group">
                <label for="nim_nip">NIM/NIP</label>
                <input type="text" id="nim_nip" name="nim_nip" value="190401001" readonly>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="budi.santoso@polibatam.ac.id">
            </div>

            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" id="jabatan" name="jabatan" value="Dosen/Staff Admin" readonly>
            </div>

            <div class="form-group">
                <label for="unit">Unit/Jurusan</label>
                <input type="text" id="unit" name="unit" value="Jurusan Teknik Informatika" readonly>
            </div>

            <button type="button">Ubah Password</button>
            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
    </div>