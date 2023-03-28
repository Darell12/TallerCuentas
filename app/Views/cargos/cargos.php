<div class="container  mt-4 shadow rounded-4">
  <div>
    <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
  </div>
  <div>
    <button type="button" class="btn btn-outline-success " data-bs-toggle="modal" data-bs-target="#PaisModal" onclick="seleccionaCargo(<?php echo 1 . ',' . 1 ?>);"><i class="bi bi-plus-circle-fill"></i> Agregar</button>
    <a href="<?php echo base_url('/eliminados_cargos'); ?>"><button type="button" class="btn btn-outline-secondary"><i class="bi bi-file-x"></i> Eliminados</button></a>
    <a href="<?php echo base_url('/principal'); ?>"><button class="btn btn-outline-primary"><i class="bi bi-arrow-return-left"></i> Regresar</button></a>
  </div>

  <br>
  <div class="table-responsive">
    <table class="table table-bordered table-sm table-hover" id="tablePaises" width="100%" cellspacing="0">
      <thead class="table-dark">
        <tr>
          <th class="text-center">Id</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Estado</th>
          <th class="text-center" colspan="2">Acciones</th>
        </tr>
      </thead>
      <tbody style="font-family:Arial;font-size:12px;">
        <?php foreach ($datos as $x => $valor) { ?>
          <tr>
            <th class="text-center"><?php echo $valor['id']; ?></th>
            <th class="text-center"><?php echo $valor['nombre']; ?></th>
            <th class="text-center ">
              <?php echo $valor['estado'] = 'A' ?  '<span class="text-success"> Activo </span>' : 'Inactivo'; ?>

            </th>
            <th class="grid grid text-center" colspan="2">

              <button class="btn btn-outline-primary" onclick="seleccionaCargo(<?php echo $valor['id'] . ',' . 2 ?>);" data-bs-toggle="modal" data-bs-target="#PaisModal">
                <i class="bi bi-pencil"></i>
              </button>
              <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-href="<?php echo base_url('/estado_cargos') . '/' . $valor['id'] . '/' . 'E'; ?>"><i class="bi bi-trash3"></i></button>
            </th>

          </tr>
        <?php } ?>

      </tbody>
    </table>
  </div>

  <!-- Modal -->
  <form method="POST" action="<?php echo base_url('/cargos_insertar'); ?>" autocomplete="off" class="needs-validation" id="formulario" novalidate>
    <div class="modal fade" id="PaisModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="tituloModal">Añadir Cargo</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" name="nombre" id="nombre" required>
              <div id="MensajeValidacionNombre">
                <!-- Mensaje Generado Dinamicamente -->
              </div>
            </div>
            <input type="text" id="tp" name="tp" hidden>
            <input type="text" id="id" name="id" hidden>
            <input type="text" id="NombreValido" hidden>
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

  const inputNombre = document.getElementById('nombre')
  const NombreValido = document.getElementById('NombreValido');
  const tpv = document.getElementById('tp')
  const id_registro = document.getElementById('id');

  inputNombre.addEventListener("input", function() {
    if (tpv.value == 1) {
      respuesta = validacionMejorada(inputNombre.value, 'nombre', NombreValido, 'Nombre', 'cargos', '0');
    } else {
      respuesta = validacionMejorada(inputNombre.value, 'nombre', NombreValido, 'Nombre', 'cargos', id_registro.value);
    }
  })

  $('#formulario').on('submit', function(e) {
    let nombre = $("#nombre").val();
    let nombre_valido = $("#NombreValido").val();
    if (nombre == "" || nombre_valido == "") {
      e.preventDefault()
      return swal.fire({
        postition: 'top-end',
        icon: 'error',
        title: 'Error campos Invalidos',
        text: 'Todos los campos deben estar llenos y ser validos',
        showConfirmButton: false,
        timer: 1500
      })
    }
  })

  function seleccionaCargo(id, tp) {
    if (tp == 2) {
      dataURL = "<?php echo base_url('buscar_cargo/'); ?>" + "/" + id;
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {
          console.log(rs)
          $("#tp").val(2);
          $("#id").val(rs[0]['id'])
          $("#nombre").val(rs[0]['nombre']);
          $("#MensajeValidacionNombre").text('');
          $("#btn_Guardar").text('Actualizar');
          $("#tituloModal").text('Actualizar el Cargo ' + rs[0]['nombre']);
          $("#modalAgregar").modal("show");
        }
      })
    } else {
      console.log("Else")
      $("#tp").val(1);
      $("#id").val("")
      $("#nombre").val("");
      $("#MensajeValidacionNombre").text('');
      $("#btn_Guardar").text('Guardar');
      $("#tituloModal").text('Agregar Nuevo Cargo');
      $("#PaisModal").modal("show");
    }
  };

  $('.close').click(function() {
    $("#modal-confirma").modal("hide");
  });
</script>