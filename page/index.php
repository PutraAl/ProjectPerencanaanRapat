<?php 
include "../connection/server.php"

?>

<!-- landing Page -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengelolaan Rapat Politenik Negeri Batam</title>
  <!-- Fontawesome Icon CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <!-- Css Eksternal -->
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar py-3 navbar-expand-lg justify-content-between fixed-top bg-primary navbar-light">
    <div class="container">
      <a class="navbar-brand" href="#"><img id="MDB-logo" src="../assets/img/Polibatam.png" alt="MDB Logo"
          draggable="false" height="40" /></a>
      <button class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto  align-items-center">
          <li class="nav-item">
            <a class="nav-link mx-2" href="#!">Home</a>
          </li>

          <li class="nav-item">
            <i>|</i>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="#!" id="nav-center"></i>About</a>
          </li>
          <li class="nav-item">
            <i>|</i>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="#!" id="nav-home">Contact</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto  align-items-center">



          <li class="nav-item ms-3 ">
            <a class="btn btn-dark btn-rounded py-2 " href="../index.php"><i class="fa-solid fa-user"></i>Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar -->

  <!-- Website Utama -->
  <div class="row row-cols-12 " style="margin-top: 125px;">
    <div class="col-12 col-md-6">
      <h2 class="text-center py-2 overflow-hidden">Pengelolaan Rapat</h2>
      <p class="px-4 "">
       Politeknik Negeri Batam (Polibatam) terletak di Pulau Batam, kawasan perdagangan dan pelabuhan
        bebas yang strategis di perbatasan perairan internasional. Berdiri sejak tahun 2000 berdasarkan Akta Pendirian
        Notaris Soehendro Gautama, SH, Polibatam terus berkembang sebagai institusi pendidikan vokasi unggulan yang
        menghasilkan lulusan siap kerja dan berdaya saing global.
        <br>
        Dalam mendukung kegiatan akademik dan organisasi kemahasiswaan yang dinamis, Polibatam memerlukan sistem yang
        efisien untuk mengatur berbagai rapat dan koordinasi antar pihak. Oleh karena itu, Website Pengelolaan Rapat
        Mahasiswa Polibatam hadir sebagai solusi digital untuk membantu proses perencanaan, penjadwalan, pencatatan, dan
        dokumentasi rapat agar lebih terorganisir, transparan, dan mudah diakses oleh seluruh civitas akademika.
        <br>
        Melalui sistem ini, setiap kegiatan rapat — baik internal organisasi, program studi, maupun antar lembaga —
        dapat dikelola secara terstruktur, sehingga mendukung semangat profesionalisme dan efisiensi di lingkungan
        Politeknik Negeri Batam.</p>
    </div>
    <div class="col-12 col-md-6 justify-content-center align-content-center align-items-center">
      <img class="mx-auto d-block" src="../assets/img/Polibatam.png" height="250px" width="250px" alt="">
    </div>
  </div>

  <hr>

  <div class="image-wrap d-flex justify-content-around py-4">
    <img src="../assets/img/pol1.png" alt=""  srcset="">
    <img src="../assets/img/pol2.png" alt=""  srcset="">
    <img src="../assets/img/pol3.png" alt=""  srcset="">
    <img src="../assets/img/pol4.png" alt=""  srcset="">
  </div>

  <hr>

  <div class="container">


    <h1 class="text-center my-4">Tujuan Website</h1>
    <div class="row  justify-content-center g-4">


      <div class="col-12 py-4 col-md-4  px-5 px-md-3">
        <div class="card text-center">
          <div class="card-body">
            <img src="../assets/img/Polibatam.png" class="card-img-top img-fluid" alt="...">

            <h5 class="card-title">Meningkatkan Efisiensi dan Ketepatan Waktu Rapat</h5>
            <p class="card-text text-center">Website ini bertujuan untuk membantu mahasiswa dan pihak kampus dalam menjadwalkan serta mengelola rapat dengan lebih efisien. Melalui sistem digital, proses pemesanan waktu, pengiriman undangan, dan pengingat rapat dapat dilakukan secara otomatis sehingga meminimalkan keterlambatan dan bentrok jadwal.s
              content.</p>
          </div>
        </div>
      </div>
      <div class="col-12 py-4 col-md-4 px-5 px-md-3">
        <div class="card text-center">
          <div class="card-body">
            <img src="../assets/img/Polibatam.png" class="card-img-top img-fluid" alt="...">
            <h5 class="card-title">Mempermudah Mengelola Data Rapat</h5>
            <p class="card-text text-center">Sistem Pengelolaan Rapat ini berguna untuk mempermudah panitia untuk mengelola data-data rapat
              </p>
          </div>
        </div>
      </div>
      <div class="col-12 py-4 col-md-4 px-5 px-md-3">
        <div class="card text-center">
          <div class="card-body">
            <img src="../assets/img/Polibatam.png" class="card-img-top img-fluid" alt="...">

            <h5 class="card-title">Meningkatkan Koordinasi dan Transparansi antar Pihak</h5>
            <p class="card-text text-center">Website ini memfasilitasi komunikasi dan koordinasi antara mahasiswa, dosen pembimbing, dan pihak organisasi kampus dalam menyelenggarakan rapat. Informasi rapat dapat diakses secara terbuka oleh pihak yang berwenang, sehingga mendukung transparansi dan akuntabilitas kegiatan organisasi di lingkungan Politeknik Negeri Batam.</p>
          </div>
        </div>
      </div>


    </div>

  </div>

  <hr>


  <div class="contact" id="contact">

    <h1 class="text-center">Contact Us</h1>
    <p class="text-center">Ada masalah? isi data dibawah ini, semua nya akan kami jawab.</p>


    <form>
      <div class="wrap-contact">

        <div class="mb-3 mt-4 text-center">
          <label for="exampleInputEmail1" class="form-label fw-bold fs-4">Email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            placeholder="Masukkan Email Anda" required>

        </div>
        <div class="mb-3 text-center">
          <label for="nama" class="form-label fw-bold fs-4">Nama</label>
          <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Anda" required>
        </div>
        <div class="mb-3 text-center">
          <label for="nama" class="form-label fw-bold fs-4">Keluhan</label>
          <textarea name="" id="" class="form-control" placeholder="Apa keluhan anda?" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit</button>
      </div>
    </form>
  </div>


<footer class="footer my-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="footer-brand px-5">
                  <img src="../assets/img/Polibatam.png" alt="">
                </div>
             
            </div>

            <div class="col-md-6 text-md-end">
                <ul class="footer-links">
                  <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Terms</a></li>
                </ul>
            </div>
        </div>

        <div class="copyright text-center">
            © PBL Group 2
        </div>
    </div>
</footer>
  
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</html>