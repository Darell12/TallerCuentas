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
     <link rel="stylesheet" href="<?php echo base_url() ?>/bootstrap/bootstrap.min.css">
     <script src="<?php echo base_url() ?>/bootstrap/bootstrap.bundle.min.js"></script>
</head>

<header class="containerH">
        <img src="<?php echo base_url(); ?>img/cuentasclaras.png" alt="">

    <div class="titulo">
        <h1 style="text-align:center"><?php echo $titulo; ?></h1>
        <h6 style="text-align:center "><?php echo $nombre; ?></h2>   
    </div>
        <a href="https://oferta.senasofiaplus.edu.co/sofia-oferta/" target="_blank" class="logosena">
            <img src="<?php echo base_url(); ?>img/sena.png" alt="">
        </a>
        
</header>



<!-- Barra de Navegacion -->
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <div class="container-fluid">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-light">
      <!-- <li class="nav-item">
          <a class="nav-link text-light" href="#">Paises</a>
        </li>
      <li class="nav-item">
          <a class="nav-link text-light" href="#">Municipios</a>
        </li>
      <li class="nav-item">
          <a class="nav-link text-light" href="#">Departamentos</a>
        </li>
      <li class="nav-item">
          <a class="nav-link text-light" href="#">Empleados</a>
        </li>
      <li class="nav-item">
          <a class="nav-link text-light disable" href="#">Cargos</a>
        </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Empleados
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="empleados">Administrar</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link text-light disabled">Cargos</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ubicación
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="paises">Pais</a></li>
            <li><a class="dropdown-item" href="departamentos">Departamentos</a></li>
            <li><a class="dropdown-item" href="municipios">Municipios</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
