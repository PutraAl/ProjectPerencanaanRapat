<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Rapat - Dashboard User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/userpage.css">

</head>
<body>
<!-- Bagian Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand me-4" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.808 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                </svg>
            </a>

            <form class="d-flex me-auto" role="search">
                <div class="input-group">
                    <input class="form-control" type="search" placeholder="Cari..." aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.085.122l3.08 3.08a1 1 0 0 0 1.414-1.414l-3.08-3.08q-.062-.041-.122-.084m-5.492.541a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11"/>
                        </svg>
                    </button>
                </div>
            </form>
            
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a></li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">About</a></li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Services</a></li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a></li>
                </ul>
            </div>

            <a class="nav-link text-dark ms-3" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.205-5.3"/>
                </svg>
            </a>
        </div>
    </nav>

<!-- Halaman sidebar -->
    <div class="container">
        <div class="sidebar">
            <div class="logo">Meeting Kampus</div>
            <ul class="menu">
              <li class="menu-item ">
                    <i>📊</i> 
                    <a href="index.php">Dashboard</a> 
                </li>
                <li class="menu-item ">
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

        <div class="main-content">
        <div class="profile-container">
            <div class="card profile-card">
            <div class="profile-header">
            <div class="profile-avatar">U</div>
            <div class="profile-info">
                <h2>User</h2>
                <p>Ketua Rapat</p>
            </div>
        </div>
        
            <form>
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" class="form-control" value="User">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" value="user.user@perusahaan.com">
                </div>
                <div class="form-group">
                    <label for="department">Departemen</label>
                    <input type="text" id="department" class="form-control" value="Peserta Rapat">
                </div>
                <div class="form-group">
                    <label for="position">Jabatan</label>
                    <input type="text" id="position" class="form-control" value="Ketua Rapat">
                </div>
                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="tel" id="phone" class="form-control" value="081234567890">
                </div>
                <div class="form-group my-2">
                    <button type="submit" class="form-control btn-primary">Edit</button>
                </div>
            </div>
            <!-- <div id="Preferensi" class="page">
                <div class="card profile-card">
                <h2 class="card-title">Preferensi Rapat</h2>
                    <div class="form-group">
                        <label><input type="checkbox" checked> Notifikasi email untuk undangan rapat</label>
                    </div>
                    <div class="form-group">
                        <label><input type="checkbox" checked> Pengingat 15 menit sebelum rapat</label>
                    </div>
                    <div class="form-group">
                    
                </div>
            </div> -->
        </form>
        </div>
</body>
</html>