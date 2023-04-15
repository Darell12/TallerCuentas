<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>

<body>
    <h1>Iniciar sesión</h1>


    <form method="post" action="<?php echo base_url('/usuarios/login'); ?>">
        <div>
            <label for="email">Correo electrónico:</label>
            <input type="email" name="email" id="email" value="<?= old('email') ?>">
        </div>

        <div>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password">
        </div>

        <button type="submit">Iniciar sesión</button>
    </form>

</body>

</html>