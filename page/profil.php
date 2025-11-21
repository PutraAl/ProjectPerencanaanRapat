<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perencanaan Rapat - Dashboard User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">

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
                    <a href="index.php">Dashboard</a>
                </li>

                <li class="menu-item">
                    <i>📨</i>
                    <a href="undangan.php">Undangan Rapat</a>
                </li>

                <li class="menu-item active">
                    <i>👤</i>
                    <a href="profil.php">Profil</a>
                </li>

                <li class="menu-item">
                    <i>🚪</i>
                    <a href="../action/logout.php">Keluar</a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <!-- Main Content -->
        <div class="main-content">

            <div class="profile-container">

                <div class="card profile-card">

                    <!-- Header Profil -->
                    <div class="profile-header">
                        <div class="profile-avatar">U</div>

                        <div class="profile-info">
                            <h2>User</h2>
                            <p>Leader</p>
                        </div>
                    </div>

                    <!-- Form Profil -->
                    <form>

                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" class="form-control" value="User">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" value="user.user@company.com">
                        </div>

                        <div class="form-group">
                            <label for="department">Departemen</label>
                            <input type="text" id="department" class="form-control" value="Teknik Informatika">
                        </div>

                        <div class="form-group">
                            <label for="position">Jabatan</label>
                            <input type="text" id="position" class="form-control" value="Ketua">
                        </div>

                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="tel" id="phone" class="form-control" value="081234567890">
                        </div>

                        <div class="form-group my-2">
                            <button type="submit" class="form-control btn-primary">Edit</button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
        <!-- End Main Content -->

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
