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
  <nav class="navbar navbar-expand-lg justify-content-between fixed-top bg-light navbar-light">
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
            <a class="btn btn-dark btn-rounded py-2 " href="#!"><i class="fa-solid fa-user"></i>Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar -->

  <!-- Website Utama -->
  <div class="row row-cols-12 " style="margin-top: 125px;">
    <div class="col-12 col-md-6">
      <h2 class="text-center">Pengelolaan Rapat</h2>
      <p class="px-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio nulla reiciendis accusantium
        delectus laborum molestias dignissimos eius eveniet minus officiis sapiente, voluptate quidem iusto aliquam amet
        exercitationem commodi. Provident labore neque ut adipisci totam, voluptatum tempora ex rem quidem quos qui
        minus, voluptas reprehenderit, molestias corporis. Cupiditate ullam nisi perspiciatis laborum nostrum iste?
        <br>
        Maxime accusantium laboriosam iste nam sint est ea sequi impedit molestiae consectetur temporibus numquam ut,
        dolorum reprehenderit vero doloribus. Sed sequi nobis nam neque. Necessitatibus cum, suscipit esse tenetur omnis
        veritatis optio eveniet illo natus atque. Sint natus nulla non ducimus perspiciatis dolores ab cupiditate fuga
        dolorum.</p>
    </div>
    <div class="col-12 col-md-6 justify-content-center align-content-center align-items-center">
      <img class="mx-auto d-block" src="../assets/img/Polibatam.png" height="250px" width="250px" alt="">
    </div>
  </div>

  <hr>

  <div class="image-wrap d-flex justify-content-around py-4">
    <img src="../assets/img/Polibatam.png" alt="" width="100px" height="100px" srcset="">
    <img src="../assets/img/Polibatam.png" alt="" width="100px" height="100px" srcset="">
    <img src="../assets/img/Polibatam.png" alt="" width="100px" height="100px" srcset="">
    <img src="../assets/img/Polibatam.png" alt="" width="100px" height="100px" srcset="">
  </div>

  <hr>

  <div class="container">


    <h1 class="text-center my-4">Tujuan Website</h1>
    <div class="row justify-content-center g-4">


      <div class="col-12 col-md-4">
        <div class="card text-center">
          <div class="card-body">
            <img src="../assets/img/Polibatam.png" class="card-img-top img-fluid" alt="...">

            <h5 class="card-title">Card 1</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s
              content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>

          </div>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="card text-center">
          <div class="card-body">
            <img src="../assets/img/Polibatam.png" class="card-img-top img-fluid" alt="...">

            <h5 class="card-title">Card 1</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s
              content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>

          </div>
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="card text-center">
          <div class="card-body">
            <img src="../assets/img/Polibatam.png" class="card-img-top img-fluid" alt="...">

            <h5 class="card-title">Card 1</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s
              content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>

          </div>
        </div>
      </div>


    </div>

  </div>

  <hr>


  <div class="contact">

    <h1 class="text-center">Contact Us</h1>
    <p>Lapor Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet est fugit quod, libero autem ullam
      recusandae quasi laborum natus velit corporis! Vitae iure suscipit impedit voluptatum architecto? Corrupti unde,
      molestias placeat, eum odit delectus, nisi soluta officia voluptates esse asperiores accusamus ratione quis
      voluptatum quam excepturi ab sequi in animi.</p>


    <form>
      <div class="wrap-contact">

        <div class="mb-3 mt-4 text-center">
          <label for="exampleInputEmail1" class="form-label fw-bold fs-3">Email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Email Anda" required>
          
        </div>
        <div class="mb-3 text-center">
          <label for="nama" class="form-label fw-bold fs-3">Nama</label>
          <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Anda" required>
        </div>
        <div class="mb-3 text-center">
          <label for="nama" class="form-label fw-bold fs-3">Keluhan</label>
          <textarea name="" id="" class="form-control" placeholder="Apa keluhan anda?" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
  </div>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</html>