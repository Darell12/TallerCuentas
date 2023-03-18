<div class="container card my-4">
  <div>
    <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
  </div>
  <div>
    <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#DptoModal" onclick="seleccionaDpto(<?php echo 1 . ',' . 1 ?>);">Agregar</button>
    <a href="<?php echo base_url('/departamentos/eliminados'); ?>"><button type="button" class="btn btn-secondary">Eliminados</button></a>
    <a href="<?php echo base_url('/principal'); ?>" class="btn btn-primary regresar_Btn">Regresar</a>
  </div>

  <br>
  <div class="table-responsive">
    <table class="table table-bordered table-sm table-striped" id="tablePaises" width="100%" cellspacing="0">
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

              <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#DeptoEliminar" onclick="EliminarValid(<?php echo $valor['id'] ?>);">
                <i class="bi bi-trash3"></i>
              </button>
            </th>

          </tr>
        <?php } ?>

      </tbody>
    </table>
  </div>

  <form method="POST" action="<?php echo base_url('/departamentos/insertar'); ?>" autocomplete="off" class="needs-validation" novalidate>
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
              <select name="pais" id="pais" class="form-select form-select-lg mb-3">
                <option id="Seleccionado">-Seleccione un País-</option>
                <?php foreach ($paises as $x => $valor) { ?>
                  <option value="<?php echo $valor['id'] ?>" name="pais"><?php echo $valor['nombre'] ?></option>
                <?php } ?>
              </select>
              <label for="nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" name="nombre" id="nombre" required>
              <input type="text" class="form-control" name="id" id="id" hidden>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" id="btn_Guardar">Agregar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<form method="POST" action="<?php echo base_url('/departamentos/cambiarEstado'); ?>" class="form-check-inline">
  <div class="modal fade" id="DptoModalEliminar" tabindex="-1" aria-labelledby="DptoModalEliminar" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">¿Estás seguro de eliminar este Dpto?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <span>
            <h3 class="text-center" id="DptoEliminar"></h3>
          </span>
          <input type="text" id="idE" name="id" hidden>
          <input type="text" id="estado" name="estado" hidden>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </div>
  </div>
</form>
</div>

<script>
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
      $("#nombre").val('');
      $("#Seleccionado").val('');
      $("#Seleccionado").text('');
      $("#btn_Guardar").text('Guardar');
      $("#tituloModal").text('Agregar Nuevo Dpto');
      $("#DptoModal").modal("show");
    }
  };

  function EliminarValid(id) {
    dataURL = "<?php echo base_url('/departamentos/buscar_Dpto'); ?>" + "/" + id;
    console.log(id)
    $.ajax({
      type: "POST",
      url: dataURL,
      dataType: "json",
      success: function(rs) {
        $("#idE").val(rs[0]['id'])
        $("#estado").val('I');
        $("#DptoEliminar").text(rs[0]['nombre']);
        $("#DptoModalEliminar").modal("show");
      }
    })
  }
</script>