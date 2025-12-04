<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perencanaan Rapat - Profile Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
                <a href="dashboardnew.php">Dashboard</a>
            </li>
            <li class="menu-item">
                <i>📨</i>
                <a href="rapat.php">Rapat</a>
            </li>
            <li class="menu-item active">
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

    <!-- Main Content -->
    <div class="main-content">
        <div class="profile-container">
            <div class="card profile-card">

                <!-- Header -->
                <div class="header">
                    <h2 class="page-title">Profile</h2> 
                    <div class="user-info">
                        <span>Admin</span>
                        <div class="user-avatar">A</div>
                    </div>
                </div>

                <!-- Profil Card -->
                <div class="profile-card text-center mt-3">
                    <img src="https://via.placeholder.com/120" alt="Profile Picture" class="rounded-circle mb-2">
                    <h3 id="nameDisplay">Yoda Pratama</h3>
                    <p id="emailDisplay">Yodapratama@gmail.com</p>
                    <p id="positionDisplay">Staff</p>

                    <!-- Tombol Edit Profile -->
                    <button id="editProfileBtn" class="btn btn-primary mt-2">Edit Profile</button>
                </div>

            </div>
        </div>
    </div>
    <!-- End Main Content -->

</div>

<!-- Modal Edit Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <form id="editProfileForm">
                    <div class="mb-3">
                        <label for="nameInput" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nameInput" value="Yoda Pratama">
                    </div>
                    <div class="mb-3">
                        <label for="emailInput" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailInput" value="Yodapratama@gmail.com">
                    </div>
                    <div class="mb-3">
                        <label for="positionInput" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="positionInput" value="Staff">
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveProfileBtn">Simpan</button>
            </div>
            
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>

<!-- Custom JS -->
<script>
    // Hamburger Sidebar
    const btn = document.getElementById("hamburgerBtn");
    const sidebar = document.querySelector(".sidebar");
    btn.addEventListener("click", () => {
        sidebar.classList.toggle("active");
    });

    // Edit Profile Modal
    const editBtn = document.getElementById("editProfileBtn");
    const saveBtn = document.getElementById("saveProfileBtn");
    const nameDisplay = document.getElementById("nameDisplay");
    const emailDisplay = document.getElementById("emailDisplay");
    const positionDisplay = document.getElementById("positionDisplay");

    // Inisialisasi Bootstrap Modal
    const editProfileModal = new bootstrap.Modal(document.getElementById('editProfileModal'));

    // Tampilkan modal saat tombol diklik
    editBtn.addEventListener("click", () => {
        editProfileModal.show();
    });

    // Simpan perubahan dan update tampilan profil
    saveBtn.addEventListener("click", () => {
        nameDisplay.textContent = document.getElementById("nameInput").value;
        emailDisplay.textContent = document.getElementById("emailInput").value;
        positionDisplay.textContent = document.getElementById("positionInput").value;
        editProfileModal.hide();
    });
</script>

</body>
</html>
