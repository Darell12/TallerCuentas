<head>
    <title>Cuentas Claras</title>
    <link rel="icon" href="<?php echo base_url() ?>/img/cuentasclaras.png" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="<?php echo base_url() ?>/css/hed.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"> <!-- Bootstrap 5 hoja de estilos -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/bootstrap-icons/bootstrap-icons.css"> <!-- Bootstrap 5 hoja de estilos iconos -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo base_url() ?>/css/jquery-3.6.0.js"></script>
    <script src="<?php echo base_url('/js/funcione.js'); ?>"></script>
    <script src="<?php echo base_url('/bootstrap/bootstrap.bundle.min.js'); ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>




</head>
<section class="vh-100 position-relative" style="background-color: #212529;">
<div class="position-absolute top-50 start-50 translate-middle">
<form method="post" action="<?php echo base_url('/usuarios/login'); ?>">
    <div class="card text-center" style="width: 26rem;">
        <div class="card-body">
            <h5 class="card-title">Iniciar Sesión</h5>
            <div>
                <label class="form-label" for="email">Correo electrónico</label>
                <input type="email" class="form-control border border-dark-subtle" name="email" id="email" value="<?= old('email') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Contraseña</label>
                <input type="password" class="form-control border border-dark-subtle" name="password" id="password">
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-outline-success" type="submit">Iniciar sesión</button>
            </div>
        </div>
    </div>
</form>
</div>
</section>