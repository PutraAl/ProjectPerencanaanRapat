<?php 
include "../middleware.php";
?>

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
                <li class="menu-item active">
                    <i>📊</i> 
                    <a href="index.php">Dashboard</a> 
                </li>
                <li class="menu-item">
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
            <div class="header">
                <h1 class="page-title">Dashboard</h1>
                <div class="user-info">
                    <div class="user-avatar">U</div>
                    <span>User</span>
                </div>
            </div>

<!-- Halaman Dashboard -->
            <div class="card mb-3 shadow-sm">
            <div class="row g-0">
            <div id="dashboard" class="page active">
                <div class="stats-container">
                    <div class="stat-card">
                        <span class="stat-label">Total Rapat</span>
                        <span class="stat-value">12</span>
                        <span>+2 dari bulan lalu</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-label">Rapat Mendatang</span>
                        <span class="stat-value">3</span>
                        <span>Dalam 7 hari ke depan</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-label">Kehadiran</span>
                        <span class="stat-value">85%</span>
                        <span>Rata-rata kehadiran</span>
                    </div>
                </div>

<!-- Rapat-Rapat -->
                <div class="card">
                    <h2 class="card-title">Rapat Mendatang</h2>
                    <ul class="meeting-list">
                        <li class="meeting-item">
                            <div>
                                <div class="meeting-title">Rapat Tim Pengembang</div>
                                <div class="meeting-time">Hari Ini, 10:00 - 11:30 • Ruang Rapat A</div>
                            </div>
                            <span class="badge badge-primary">Akan Datang</span>
                        </li>
                        <li class="meeting-item">
                            <div>
                                <div class="meeting-title">Review Proyek Q3</div>
                                <div class="meeting-time">Besok, 14:00 - 16:00 • Ruang Rapat B</div>
                            </div>
                            <span class="badge badge-primary">Akan Datang</span>
                        </li>
                        <li class="meeting-item">
                            <div>
                                <div class="meeting-title">Presentasi XYZ</div>
                                <div class="meeting-time">Jumat, 09:00 - 10:30 • Ruang Rapat C</div>
                            </div>
                            <span class="badge badge-primary">Akan Datang</span>
                        </li>
                    </ul>
                </div>

                <div class="card">
                    <h2 class="card-title">Rapat Terbaru</h2>
                    <ul class="meeting-list">
                        <li class="meeting-item">
                            <div>
                                <div class="meeting-title">Briefing Tim Marketing</div>
                                <div class="meeting-time">Senin, 02 Sep 2023, 13:00 - 14:00</div>
                            </div>
                            <span class="badge badge-success">Selesai</span>
                        </li>
                        <li class="meeting-item">
                            <div>
                                <div class="meeting-title">Rapat Koordinasi Divisi</div>
                                <div class="meeting-time">Jumat, 30 Agu 2023, 09:00 - 11:00</div>
                            </div>
                            <span class="badge badge-success">Selesai</span>
                        </li>
                    </ul>
                </div>
            </div>

 <!-- Halaman Undangan Rapat -->
            
            </div>
        </form>
        </div>
</body>
</html>