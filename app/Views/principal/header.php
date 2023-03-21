<!DOCTYPE html>
<html lang="es">

<head>
  <title>Cuentas Claras</title>
  <link rel="icon" type="ima  ge/svg+xml" href="<?php echo base_url() ?>/favicon.ico" />
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?php echo base_url() ?>/css/header.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/bootstrap/bootstrap.min.css"> <!-- Bootstrap 5 hoja de estilos -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/bootstrap-icons/bootstrap-icons.css"> <!-- Bootstrap 5 hoja de estilos iconos -->
  <script src="<?php echo base_url() ?>/css/jquery-3.6.0.js"></script>
  <script src="<?php echo base_url() ?>/bootstrap/bootstrap.bundle.min.js"></script>





</head>

<header class="containerH">
  <a href="<?php echo base_url(); ?>" class="logosena">
    <img src="<?php echo base_url(); ?>img/cuentasclaras.png" alt="" class="">
  </a>

  <div class="titulo">
    <h1 style="text-align:center">Cuentas Claras</h1>
    <h6 style="text-align:center "><?php echo $nombre; ?></h2>
  </div>
  <a href="https://oferta.senasofiaplus.edu.co/sofia-oferta/" target="_blank" class="logosena">
    <img src="<?php echo base_url(); ?>img/sena.png" alt="">
  </a>

</header>

<!-- NAVBAR RENPONSIVE -->
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="<?php echo base_url() ?>">Inicio</a>
        </li>
        <li class="nav-item dropdown animate slideIn">
          <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Empleados
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?php echo base_url() ?>empleados">Administrar</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="cargos" class="nav-link text-light">Cargos</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ubicación
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?php echo base_url() ?>paises">Pais</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url() ?>departamentos">Departamentos</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url() ?>municipios">Municipios</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>