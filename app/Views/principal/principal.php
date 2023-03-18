<body bgcolor="black">
  <h1 style="text-align:center;"><?php echo $titulo; ?></h1>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>/clientes">Clientes</a>
          <a class="nav-link " aria-current="page" href="<?php echo base_url(); ?>/monedas">Tipo de Moneda</a>
          <a class="nav-link " aria-current="page" href="<?php echo base_url(); ?>/prestamos">Prestamos</a>
        </div>
      </div>
    </div>
  </nav>

</body>