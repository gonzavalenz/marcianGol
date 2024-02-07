<?php

include ("../php/session/validateSession.php");

?>

<!-- ARCHIVO CREADO COMO BASE PARA EL DISENO -->
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="../css/styles.css" rel="stylesheet">
  </head>
  <body>
    <!-- Barra de navegacion -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">MarcianGol</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../php/session/destroySession.php">Cerrar Sesión</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown link
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <!-- Foros -->
    <section>
      <div class="d-flex flex-wrap justify-content-center text-center">
        <div class="card m-3" style="width: 18rem;">
          <img src="../multimedia/river.png" class="card-img card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Foro Primera</h5>
            <p class="card-text">Descripcion de foro<p>
            <a href="foro1.html" target="_blank" rel="noopener noreferrer" class="btn-card btn btn-primary">Entrar</a>
          </div>
        </div>
        <div class="card m-3" style="width: 18rem;">
          <img src="../multimedia/realmadrid.png" class="card-img card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Foro Europa</h5>
            <p class="card-text">Descripcion de foro<p>
            <a href="foro2.html" target="_blank" rel="noopener noreferrer" class="btn-card btn btn-primary">Entrar</a>
          </div>
        </div>
      </div>
      
      

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>