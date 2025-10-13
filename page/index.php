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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg justify-content-between fixed-top bg-light navbar-light">
  <div class="container">
    <a class="navbar-brand" href="#"><img id="MDB-logo"
        src="../assets/img/Polibatam.png" alt="MDB Logo"
        draggable="false" height="40" /></a>
    <button class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto  align-items-center">
        <li class="nav-item" >
          <a class="nav-link mx-2" href="#!" ><i class="fas fa-bell pe-2" ></i>Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link "><i class="fas fa-bell pe-2" disabled></i>|</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2" href="#!" id="nav-center"><i class="fas fa-heart pe-2" ></i>About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link "><i class="fas fa-bell pe-2" disabled></i>|</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2" href="#!" id="nav-home"><i class="fas fa-heart pe-2"></i>Contact</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto  align-items-center">
      

    
        <li class="nav-item ms-3">
          <a class="btn btn-dark btn-rounded" href="#!">Sign in</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Navbar -->

<!-- Website Utama -->
<div class="row row-cols-12" style="margin-top: 125px;">
  <div class="col-12 col-md-6">
  <h2 class="text-center">Pengelolaan Rapat</h2>
  <p class="px-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio nulla reiciendis accusantium delectus laborum molestias dignissimos eius eveniet minus officiis sapiente, voluptate quidem iusto aliquam amet exercitationem commodi. Provident labore neque ut adipisci totam, voluptatum tempora ex rem quidem quos qui minus, voluptas reprehenderit, molestias corporis. Cupiditate ullam nisi perspiciatis laborum nostrum iste?
  <br>
  Maxime accusantium laboriosam iste nam sint est ea sequi impedit molestiae consectetur temporibus numquam ut, dolorum reprehenderit vero doloribus. Sed sequi nobis nam neque. Necessitatibus cum, suscipit esse tenetur omnis veritatis optio eveniet illo natus atque. Sint natus nulla non ducimus perspiciatis dolores ab cupiditate fuga dolorum.</p>
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


<h1 class="text-center">Tujuan Website</h1>
<div class="row row-cols-12 justify-content-around mx-auto">
  
  <div class="col-12 col-md-4 ">
      <div class="card" style="width: 18rem;">
    <img src="../assets/img/Polibatam.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
  </div>
  <div class="col-12 col-md-4">
<div class="card" style="width: 18rem;">
  <img src="../assets/img/Polibatam.png" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
  </div>
  <div class="col-12 col-md-4">
<div class="card" style="width: 18rem;">
  <img src="../assets/img/Polibatam.png" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
  </div>

</div>

<hr>

<h1 class="text-center">Contact Us</h1>
<p>Lapor Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet est fugit quod, libero autem ullam recusandae quasi laborum natus velit corporis! Vitae iure suscipit impedit voluptatum architecto? Corrupti unde, molestias placeat, eum odit delectus, nisi soluta officia voluptates esse asperiores accusamus ratione quis voluptatum quam excepturi ab sequi in animi.</p>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>