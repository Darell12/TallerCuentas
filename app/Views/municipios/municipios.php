<div class="container">
  <div>
    <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
  </div>
  <div>
    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#MuniModal" onclick="seleccionarMuni(<?php echo 1 . ',' . 1 ?>);"><i class="bi bi-plus-circle-fill"></i> Agregar</button>
    <a href="<?php echo base_url('/eliminados_municipios'); ?>"><button type="button" class="btn btn-outline-secondary"><i class="bi bi-file-x"></i> Eliminados</button></a>
    <a href="<?php echo base_url('/principal'); ?>"><button class="btn btn-outline-primary"><i class="bi bi-arrow-return-left"></i> Regresar</button></a>
  </div>

  <br>
  <div class="table-responsive" style="overflow:scroll-vertical;overflow-y: scroll !important; height: 600px;">
    <table class="table table-bordered table-sm table-hover" id="tablePaises" width="100%" cellspacing="0">
      <thead class="table-dark">
        <tr>
          <th class="text-center">Id</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Departamento</th>
          <th class="text-center">País</th>
          <th class="text-center">Estado</th>
          <th class="text-center" colspan="2">Acciones</th>
        </tr>
      </thead>
      <tbody style="font-family:Arial;font-size:12px;">
        <?php foreach ($datos as $x => $valor) { ?>
          <tr>
            <th class="text-center"><?php echo $valor['id']; ?></th>
            <th class="text-center"><?php echo $valor['nombre']; ?></th>
            <th class="text-center">
              <?php echo $valor['Departamento']; ?>
              <?php echo $valor['estadoDpto'] == 'E' ? '<span class="text-danger">  ~ Inactivo</span>' : '<span class="text-success"> ~ Activo </span>'; ?></th>
            <th class="text-center">
              <?php echo $valor['PNombre']; ?>
              <?php echo $valor['estadoPais'] == 'E' ? '<span class="text-danger">  ~ Inactivo</span>' : '<span class="text-success"> ~ Activo </span>'; ?>
            </th>
            <th class="text-center">
              <?php echo $valor['estado'] = 'A' ?  '<span class="text-success"> Activo </span>' : 'Inactivo'; ?>
            </th>
            <th class="grid grid text-center" colspan="2">
              <button class="btn btn-outline-primary" onclick="seleccionarMuni(<?php echo $valor['id'] . ',' . 2 ?>);"><i class="bi bi-pencil"></i></button>
              <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-href="<?php echo base_url('/municipios/cambiarEstado') . '/' . $valor['id'] . '/' . 'E'; ?>"><i class="bi bi-trash3"></i></button>
            </th>

          </tr>
        <?php } ?>

      </tbody>
    </table>
  </div>

  <form method="POST" action="<?php echo base_url('/municipios/insertar'); ?>" autocomplete="off" class="needs-validation" id="formulario" novalidate>
    <div class="modal fade" id="MuniModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="tituloModal">Añadir Municipio</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="nombre" class="col-form-label">Pais:</label>
              <select name="pais" class="form-select form-select-lg mb-3" id="selectPais">
                <option value="">-Seleccione un País-</option>
                <?php foreach ($paises as $x => $valor) { ?>
                  <option value="<?php echo $valor['id'] ?>" name="pais" <?php echo $valor['estado'] != 'A' ? 'disabled' :  ''?>><?php echo $valor['estado'] != 'A' ? $valor['nombre'] . '~ Inactivo' : $valor['nombre'] ?></option>
                <?php } ?>
              </select>
              <label for="nombre" class="col-form-label">Departamento:</label>
              <select name="departamento" id="departamento" class="form-select form-select-lg mb-3">
                <option id="departamentoSeleccionado" value="0">--Seleccione un Dpto</option>

              </select>
              <label for="nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" name="nombre" id="nombre" required>
              <div id="MensajeValidacionNombre">
                <!-- MENSAJE DINAMICO -->
              </div>
              <input type="text" id="tp" name="tp" hidden>
              <input type="text" id="id" name="id" hidden>
              <input type="text" id="NombreValido" hidden>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="limpiar()">Cerrar</button>
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
  let id_registro = document.getElementById('id');
  const tpv = document.getElementById('tp')
  const inputNombre = document.getElementById('nombre')
  const NombreValido = document.getElementById('NombreValido');

  $('#modal-confirma').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  });

  $('#selectPais').on('change', () => {
    pais = $('#selectPais').val();
    obtenerDepartamentos(pais)
    console.log('esto')
  })

  inputNombre.addEventListener("input", function() {

    if (tpv.value == 1) {
      respuesta = validacionMejorada(inputNombre.value, 'nombre', NombreValido, 'Nombre', 'municipios', '0');
    } else {
      respuesta = validacionMejorada(inputNombre.value, 'nombre', NombreValido, 'Nombre', 'municipios', id_registro.value);
    }

  })


  function obtenerDepartamentos(pais, id_dpto) {
    $.ajax({
      url: "<?php echo base_url('municipios/obtenerDepartamentosPais/'); ?>" + pais,
      type: 'POST',
      dataType: 'json',
      success: function(res) {
        $('#departamento').empty();
        console.log(res)
        var cadena
        cadena = `<select name="departamento" id="departamento" class="form-select">
                               <option selected value="">Seleccionar Departamento</option>`
        for (let i = 0; i < res.length; i++) {
          cadena += `<option value='${res[i].id}' ${res[i].estado != 'A' ? 'disabled' :  ''} >${res[i].estado != 'A' ? res[i].nombre + ' ~ Inactivo' :  res[i].nombre}  </option>`
        }
        cadena += `</select>`
        $('#departamento').html(cadena)
        $('#departamento').val(id_dpto)
      }
    })
  }


  // function limpiar() {
  //   console.log('limpio')
  //   $("#nombre").val('');
  //   $("#departamentoSeleccionado").val(0);
  //   $("#paisSeleccionado").val('');
  //   $("#paisSeleccionado").text('-Seleccione un País-');
  //   $("#btn_Guardar").text('Guardar');
  //   $("#tituloModal").text('Agregar Nuevo Municipio');
  //   $("#MuniModal").modal("show");
  // }

  function seleccionarMuni(id, tp) {
    if (tp == 2) {
      dataURL = "<?php echo base_url('/municipios/buscar_Muni'); ?>" + "/" + id;
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {
          console.log(rs)
          $("#tp").val(2);
          $("#id").val(id)
          $("#NombreValido").val('1');
          $("#nombre").val(rs[0]['nombre']);
          $("#selectPais").val(rs[0]['id_pais']);
          obtenerDepartamentos(rs[0]['id_pais'], rs[0]['id_dpto']);
          $("#btn_Guardar").text('Actualizar');
          $("#tituloModal").text('Actualizar el Municipio ' + rs[0]['nombre']);
          $("#MuniModal").modal("show");
        }
      })
    } else {
      console.log("Else")
      $("#tp").val(1);
      $("#id").val('0');
      
      
      $("#nombre").val('');
      $("#departamento").val(0);

      $("#selectPais").val('');
      $("#btn_Guardar").text('Guardar');
      $("#tituloModal").text('Agregar Nuevo Municipio');
      $("#MuniModal").modal("show");
    }
  };

  $('#formulario').on('submit', function(e) {
    pais = $("#selectPais").val();
    dpto = $("#departamento").val();
    nombre = $("#nombre").val();
    nombre_valido = $("#NombreValido").val();
    if ([nombre, dpto, pais, nombre_valido].includes('')) {
      e.preventDefault()
      return swal.fire({
        postition: 'top-end',
        icon: 'error',
        title: 'Error campos Invalidos',
        text: 'Debe llenar todos los campos y cumplir con las condiciones',
        showConfirmButton: false,
        timer: 1500
      })
    }
  })

  $('.close').click(function() {
    $("#modal-confirma").modal("hide");
  });
</script>