<!DOCTYPE html>
<html lang="es">

<head>
  <title>Cuentas Claras</title>
  <link rel="icon" href="<?php echo base_url() ?>/img/cuentasclaras.png" />
  <meta charset="utf-8" />
  <link rel="stylesheet" href="<?php echo base_url() ?>/css/hed.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"> <!-- Bootstrap 5 hoja de estilos -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/bootstrap-icons/bootstrap-icons.css"> <!-- Bootstrap 5 hoja de estilos iconos -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?php echo base_url() ?>/css/jquery-3.6.0.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script> -->
  <script src="<?php echo base_url('/js/funcione.js'); ?>"></script>
  <script src="<?php echo base_url('/bootstrap/bootstrap.bundle.min.js'); ?>"></script>

  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> -->




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
<nav class="navbar navbar-expand-lg" data-bs-theme="dark">
  <div class="container-fluid" id="fondo-nav" style="background-color: #16161a;">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo base_url() ?>">
            <i class="bi bi-house"></i>
            Inicio
          </a>
        </li>
        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle  text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-workspace"></i>
            Empleados
          </a>
          <ul class="dropdown-menu animate slideIn" aria-labelledby="navbarDropdown">
            <li class="animate slideIn "><a class="dropdown-item" href="<?php echo base_url() ?>ver_empleados">Administrar</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url() ?>ver_cargos" class="nav-link text-light">
            <i class="bi bi-person-vcard-fill"></i>
            Cargos
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url() ?>usuarios" class="nav-link text-light">
            <i class="bi bi-person-vcard-fill"></i>
            Usuarios
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-globe-americas"></i>
            Ubicación
          </a>
          <ul class="dropdown-menu animate slideIn" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item " href="<?php echo base_url() ?>ver_paises">Pais</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url() ?>ver_dptos">Departamentos</a></li>
            <li><a class="dropdown-item " href="<?php echo base_url() ?>ver_munis">Municipios</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>