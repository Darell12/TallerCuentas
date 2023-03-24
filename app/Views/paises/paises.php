<div class="container ">
  <div>
    <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
  </div>
  <div>
    <button type="button" onclick="seleccionaPais(<?php echo 1 . ',' . 1 ?>);" class="btn btn-outline-success " data-bs-toggle="modal" data-bs-target="#PaisModal"><i class="bi bi-plus-circle-fill"></i> Agregar</button>
    <a href="<?php echo base_url('/eliminados_paises'); ?>"><button type="button" class="btn btn-outline-secondary"><i class="bi bi-file-x"></i> Eliminados</button></a>
    <a href="<?php echo base_url('/principal'); ?>"><button class="btn btn-outline-primary"><i class="bi bi-arrow-return-left"></i> Regresar</button></a>
  </div>

  <br>
  <div class="table-responsive" style="overflow:scroll-vertical;overflow-y: scroll !important; height: 600px;">
    <table class="table table-bordered table-sm table-hover" id="tablePaises" width="100%" cellspacing="0">
      <thead class="table-dark">
        <tr>
          <th class="text-center">Id</th>
          <th class="text-center"><abbr title="Codigo Telefonico">Codigo</abbr></th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Estado</th>
          <th class="text-center" colspan="2">Acciones</th>
        </tr>
      </thead>
      <tbody style="font-family:Arial;font-size:12px;" class="table-group-divider">
        <?php foreach ($datos as $valor) { ?>
          <tr>
            <th class="text-center"><?php echo $valor['id']; ?></th>
            <th class="text-center">+<?php echo $valor['codigo']; ?></th>
            <th class="text-center"><?php echo $valor['nombre']; ?></th>
            <th class="text-center">
              <?php echo $valor['estado'] = 'A' ?  '<span class="text-success"> Activo </span>' : 'Inactivo'; ?>
            </th>
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
  <form method="POST" action="<?php echo base_url('/paises/insertar'); ?>" autocomplete="off" class="needs-validation" id="formulario" novalidate>
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
              <input type="text" class="form-control" name="nombre" id="nombre" maxlength="20" placeholder="Colombia" required>
              <div id="MensajeValidacionNombre">
                <!-- MENSAJE DINAMICO -->
              </div>
              <label for="codigo" class="col-form-label">Codigo:</label>
              <input type="text" class="form-control" pattern="[0-9]{4}" name="codigo" id="codigo" maxlength="4" placeholder="057">
              <div id="MensajeValidacionCodigo">

              </div>
              <input type="text" id="tp" name="tp" >
              <input type="text" id="id" name="id" >
              <input type="text" id="NombreValido">
              <input type="text" id="CodigoValido" >

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
  // !DECLACION DE VARIABLES
  const inputNombre = document.getElementById('nombre')
  const inputCodigo = document.getElementById('codigo')
  const NombreValido = document.getElementById('NombreValido');
  const CodigoVaido = document.getElementById('CodigoValido');
  const tpv = document.getElementById('tp')
  let id_registro = document.getElementById('id');
  
  //VAlIDACION NOMBRE
  inputNombre.addEventListener("input", function() {

    if (tpv.value == 1) {
      respuesta = validacionMejorada(inputNombre.value, 'nombre', NombreValido, 'Nombre', 'paises', '0');
    } else {
      respuesta = validacionMejorada(inputNombre.value, 'nombre', NombreValido, 'Nombre', 'paises', id_registro.value);
    }

  })

  inputCodigo.addEventListener('input', function() {
    if (tpv.value == 1) {
      respuesta = validacionMejorada(inputCodigo.value, 'codigo', CodigoVaido, 'Codigo', 'paises', '0');
    } else {
      respuesta = validacionMejorada(inputCodigo.value, 'codigo', CodigoVaido, 'Codigo', 'paises', id_registro.value);
    }
  })


  $('#modal-confirma').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  });

  
  $('#formulario').on('submit', function(e) {
    nombre = $("#nombre").val();
    codigo = $("#codigo").val();
    codigo_valido = $("#CodigoValido").val();
    nombre_valido = $("#NombreValido").val();

    if (nombre == "" || codigo == "" || codigo_valido == "" || nombre_valido == "") {
      e.preventDefault()
      return swal.fire({
        postition: 'top-end',
        icon: 'error',
        title: 'Error campos Invalidos',
        text: 'Debe llenar todos los campos y cumplir con las condicones',
        showConfirmButton: false,
        timer: 1500
      })
    }
  })



  function seleccionaPais(id, tp) {
    if (tp == 2) {
      dataURL = "<?php echo base_url('/paises/buscar_Pais'); ?>" + "/" + id;
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {
          $("#tp").val(2);
          $("#id").val(id)
          $("#codigo").val(rs[0]['codigo']);
          $("#nombre").val(rs[0]['nombre']);
          NombreValido.setAttribute('value', '1')
          CodigoVaido.setAttribute('value', '1')
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
      NombreValido.setAttribute('value', '')
      CodigoVaido.setAttribute('value', '')
      $("#btn_Guardar").text('Guardar');
      $("#tituloModal").text('Agregar Nuevo País');
      $("#PaisModal").modal("show");
    }
  }

  $('.close').click(function() {
    $("#modal-confirma").modal("hide");
  });
</script>
<script src="<?php echo base_url() ?>"></script>