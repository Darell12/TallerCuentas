<div class="container card my-4">
  <div>
    <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
  </div>
  <div>
    <button type="button" onclick="seleccionaPais(<?php echo 1 . ',' . 1 ?>);" class="btn btn-outline-success " data-bs-toggle="modal" data-bs-target="#PaisModal">Agregar</button>
    <a href="<?php echo base_url('/eliminados_paises'); ?>"><button type="button" class="btn btn-outline-secondary">Eliminados</button></a>
    <a href="<?php echo base_url('/principal'); ?>" class="btn btn-outline-primary regresar_Btn">Regresar</a>
  </div>

  <br>
  <div class="table-responsive">
    <table class="table table-bordered table-sm" id="tablePaises" width="100%" cellspacing="0">
      <thead>
        <tr style="color:#98040a;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
          <th>Id</th>
          <th><abbr title="Codigo Telefonico">Codigo</abbr></th>
          <th>Nombre</th>
          <th>Estado</th>
          <th colspan="2">Acciones</th>
        </tr>
      </thead>
      <tbody style="font-family:Arial;font-size:12px;" class="table-group-divider">
        <?php foreach ($datos as $x => $valor) { ?>
          <tr>
            <th class="text-center"><?php echo $valor['id']; ?></th>
            <th class="text-center">+<?php echo $valor['codigo']; ?></th>
            <th class="text-center"><?php echo $valor['nombre']; ?></th>
            <th class="text-center"><?php echo $valor['estado']; ?></th>
            <th class="grid grid text-center" colspan="2">

              <button class="btn btn-outline-primary" onclick="seleccionaPais(<?php echo $valor['id'] . ',' . 2 ?>);" data-bs-toggle="modal" data-bs-target="#PaisModal">

                <i class="bi bi-pencil"></i>

              </button>
              <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-href="<?php echo base_url('/paises/cambiarEstado') . '/' . $valor['id'] . '/' . 'E'; ?>"><i class="bi bi-trash3"></i></button>
            </th>

          </tr>
        <?php } ?>

      </tbody>
    </table>
  </div>
  <!-- Modal -->
  <form method="POST" action="<?php echo base_url('/paises/insertar'); ?>" autocomplete="off" class="needs-validation" novalidate>
    <div class="modal fade" id="PaisModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="tituloModal">Añadir Pais</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" name="nombre" id="nombre" required>
              <label for="codigo" class="col-form-label">Codigo:</label>
              <input type="text" class="form-control" pattern="[0-9]{4}" name="codigo" id="codigo">
              <input type="text" id="tp" name="tp" hidden>
              <input type="text" id="id" name="id" hidden>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-outline-primary" id="btn_Guardar">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>


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
</div>


<script>
  $('#modal-confirma').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  });

  function seleccionaPais(id, tp) {
    if (tp == 2) {
      dataURL = "<?php echo base_url('/paises/buscar_Pais'); ?>" + "/" + id;
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {
          $("#tp").val(2);
          $("#id").val(rs[0]['id'])
          $("#codigo").val(rs[0]['codigo']);
          $("#nombre").val(rs[0]['nombre']);
          $("#btn_Guardar").text('Actualizar');
          $("#tituloModal").text('Actualizar el país ' + rs[0]['nombre']);
          $("#PaisModal").modal("show");
        }
      })
    } else {
      $("#tp").val(1);
      $("#id").val('');
      $("#codigo").val('');
      $("#nombre").val('');

      $("#btn_Guardar").text('Guardar');
      $("#tituloModal").text('Agregar Nuevo País');
      $("#PaisModal").modal("show");
    }
  }

  $('.close').click(function() {
    $("#modal-confirma").modal("hide");
  });
</script>