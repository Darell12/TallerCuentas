<div class="container card my-4">
  <div>
    <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>

  </div>
  <div>
    <button type="button" class="btn btn-outline-success " data-bs-toggle="modal" data-bs-target="#DptoModal" onclick="seleccionaDpto(<?php echo 1 . ',' . 1 ?>);"><i class="bi bi-plus-circle-fill"></i>Agregar</button>
    <a href="<?php echo base_url('/eliminados_departamentos'); ?>"><button type="button" class="btn btn-outline-secondary"><i class="bi bi-file-x"></i> Eliminados</button></a>
    <a href="<?php echo base_url('/principal'); ?>" class="btn btn-outline-primary regresar_Btn"><i class="bi bi-arrow-return-left"></i> Regresar</a>
  </div>

  <br>
  <div class="table-responsive" style="overflow:scroll-vertical;overflow-y: scroll !important; height: 600px;">
    <table class="table table-bordered table-sm table-hover" id="tablePaises" width="100%" cellspacing="0">
      <thead>
        <tr style="color:#98040a;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
          <th>Id</th>
          <th>Nombre</th>
          <th>País</th>
          <th>Estado</th>
          <th colspan="2">Acciones</th>
        </tr>
      </thead>
      <tbody style="font-family:Arial;font-size:12px;">
        <?php foreach ($datos as $x => $valor) { ?>
          <tr>
            <th class="text-center"><?php echo $valor['id']; ?></th>
            <th class="text-center"><?php echo $valor['nombre']; ?></th>
            <th class="text-center"><?php echo $valor['PNombre']; ?></th>
            <th class="text-center"><?php echo $valor['estado']; ?></th>
            <th class="grid grid text-center" colspan="2">
              <button class="btn btn-outline-primary" onclick="seleccionaDpto(<?php echo $valor['id'] . ',' . 2 ?>);" data-bs-toggle="modal" data-bs-target="#DptoModal">
                <i class="bi bi-pencil"></i></button>

              <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-href="<?php echo base_url('/departamentos/cambiarEstado') . '/' . $valor['id'] . '/' . 'E'; ?>"><i class="bi bi-trash3"></i></button>
            </th>

          </tr>
        <?php } ?>

      </tbody>
    </table>
  </div>

  <form method="POST" action="<?php echo base_url('/departamentos/insertar'); ?>" autocomplete="off" class="needs-validation" id="formulario" novalidate>
    <div class="modal fade" id="DptoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="tituloModal">Añadir Departamento</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="nombre" class="col-form-label">Pais:</label>
              <select name="pais" id="pais" class="form-select form-select-lg mb-3" required>
                <option id="Seleccionado" value="" selected>-Seleccione un País-</option>
                <?php foreach ($paises as $x => $valor) { ?>
                  <option value="<?php echo $valor['id'] ?>" name="pais"><?php echo $valor['nombre'] ?></option>
                <?php } ?>
              </select>
              <label for="nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" name="nombre" id="nombre" required>
              <input type="text" class="form-control" name="id" id="id" hidden>
              <input type="text" class="form-control" name="tp" id="tp" hidden>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-outline-primary" id="btn_Guardar">Agregar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Modal Confirma Eliminar -->
<div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div style="text-align:center;" class="modal-header">
        <h5 style="color:#98040a;font-size:20px;font-weight:bold;" class="modal-title" id="exampleModalLabel">Eliminación de Registro</h5>

      </div>
      <div style="text-align:center;font-weight:bold;" class="modal-body">
        <p>Seguro Desea Eliminar éste Registro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary close" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-outline-danger btn-ok">Confirmar</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal Elimina -->


<script>
  $('#modal-confirma').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  });

  $('#formulario').on('submit', function(e) {
    nombre = $("#nombre").val();
    pais = $('#pais').val()
    if ([nombre, pais].includes('')) {
      e.preventDefault()
      return swal.fire({
        postition: 'top-end',
        icon: 'error',
        title: 'Error campos incompletos',
        text: 'Debe llenar todos los campos',
        showConfirmButton: false,
        timer: 1500
      })
    }
  })

  function seleccionaDpto(id, tp) {
    if (tp == 2) {
      dataURL = "<?php echo base_url('/departamentos/buscar_Dpto'); ?>" + "/" + id;
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {
          console.log(rs)
          $("#tp").val(2);
          $("#id").val(rs[0]['id'])
          $("#Seleccionado").val(rs[0]['id_pais']);
          $("#Seleccionado").text(rs[0]['PNombre']);
          $("#nombre").val(rs[0]['nombre']);
          $("#btn_Guardar").text('Actualizar');
          $("#tituloModal").text('Actualizar el departamento ' + rs[0]['nombre']);
          $("#DptoModal").modal("show");
        }
      })
    } else {
      $("#tp").val(1);
      $("#id").val('');
      $("#nombre").val(null);
      $("#pais").val(null);
      $("#Seleccionado").val('');
      $("#Seleccionado").text('--Seleccione un País--');
      $("#btn_Guardar").text('Guardar');
      $("#tituloModal").text('Agregar Nuevo Dpto');
      $("#DptoModal").modal("show");
    }
  }


  $('.close').click(function() {
    $("#modal-confirma").modal("hide");
  });
</script>