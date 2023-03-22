<div class="container card my-4">
  <div>
    <h1 class="titulo_vista text-center"><?php echo $titulo; ?></h1>

  </div>
  <div>
    <button type="button" class="btn btn-outline-success" href="#" data-bs-toggle="modal" data-bs-target="#modalAgregar" onclick="seleccionarEmp(<?php echo 1 . ',' . 1 ?>);"><i class="bi bi-plus-circle-fill"></i> Agregar</button>
    <a href="<?php echo base_url('/eliminados_empleados'); ?>"><button type="button" class="btn btn-outline-secondary"><i class="bi bi-file-x"></i> Eliminados</button></a>
    <a href="<?php echo base_url('/principal'); ?>"><button class="btn btn-outline-primary"><i class="bi bi-arrow-return-left"></i> Regresar</button></a>
  </div>

  <div id="layoutSidenav_content">

    <br>

    <div class="table-responsive" style="overflow:scroll-vertical;overflow-y: scroll !important; height: 600px;">
      <table class="table table-bordered table-sm table-hover" id="tableEmpleados" width="100%" cellspacing="0">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Nacimiento</th>
            <th>Municipio</th>
            <th>Departamento</th>
            <th>País</th>
            <th>Cargo</th>
            <th>Salario</th>
            <th>Estado</th>
            <th colspan="2">Acciones</th>
          </tr>
        </thead>
        <tbody style="font-family:Arial;font-size:12px;">
          <?php foreach ($datos as $x => $valor) { ?>
            <tr>
              <th class="text-center"><?php echo $valor['id']; ?></th>
              <th class="text-center"><?php echo $valor['nombres']; ?></th>
              <th class="text-center"><?php echo $valor['apellidos']; ?></th>
              <th class="text-center"><?php echo $valor['nacimiento']; ?></th>
              <th class="text-center">
                <?php echo $valor['NMuni']; ?>
                <?php echo $valor['estadoMuni'] == 'E' ? '<span class="text-danger">  ~ Inactivo</span>' : '<span class="text-success"> ~ Activo </span>'; ?>

              </th>
              <th class="text-center">
                <?php echo $valor['dpto_nombre']; ?>
                <?php echo $valor['estadoDpto'] == 'E' ? '<span class="text-danger">  ~ Inactivo</span>' : '<span class="text-success"> ~ Activo </span>'; ?>
              </th>
              <th class="text-center">
                <?php echo $valor['pais_nombre']; ?>
                <?php echo $valor['estadoPais'] == 'E' ? '<span class="text-danger">  ~ Inactivo</span>' : '<span class="text-success"> ~ Activo </span>'; ?>
              </th>
              <th class="text-center">
                <?php echo $valor['NCargo']; ?>
                <?php echo $valor['estadoCargo'] == 'E' ? '<span class="text-danger">  ~ Inactivo</span>' : '<span class="text-success"> ~ Activo </span>'; ?>
              </th>
              <th class="text-center">$ <?php echo $valor['salario']; ?></th>
              <th class="text-center">
                <?php echo $valor['estado'] = 'A' ?  '<span class="text-success"> Activo </span>' : 'Inactivo'; ?>
              </th>
              <th class="grid grid text-center" colspan="2">
                <button class="btn btn-outline-primary" onclick="seleccionarEmp(<?php echo $valor['id'] . ',' . 2 ?>);"><i class="bi bi-pencil"></i></button>

                <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-href="<?php echo base_url('/empleados/cambiarEstado') . '/' . $valor['id'] . '/' . 'E'; ?>"><i class="bi bi-trash3"></i></button>


                <!-- <button class="btn btn-outline-danger">

                </button> -->
              </th>

            </tr>
          <?php } ?>

        </tbody>
      </table>
    </div>

    <!--   Modal agregar   --->
    <form method="POST" action="<?php echo base_url(); ?>/empleados/insertar" autocomplete="off" id="formulario">
      <div class="modal" tabindex="-1" role="dialog" id="modalAgregar">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Agregar Empleados</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="idcliente" class="col-form-label">Nombres</label>
                <input type="text" class="form-control" id="nombres" name="nombres">
                <div id="MensajeValidacionNombre">
                  <!-- MENSAJE DINAMICO -->
                </div>
                <label for="nombrecliente" class="col-form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos">
                <div class="mb-3">
                  <label for="periodo" class="col-form-label">Año de Nacimiento </label>
                  <div class="flex ">
                    <select class="form-select" name="nacimiento" aria-label="periodo" id="nacimiento">
                      <option id="Seleccionado">-- Seleccionar Año --</option>
                      <?php $years = range(strftime("%Y", time()), 1940); ?>
                      <?php foreach ($years as $year) : ?>
                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <label for="nombre" class="col-form-label">Pais:</label>
                <select name="pais" class="form-select form-select-lg mb-3" id="selectPais">
                  <option id="paisSeleccionado">-Seleccione un País-</option>
                  <?php foreach ($paises as $x => $valor) { ?>
                    <option value="<?php echo $valor['id'] ?>" name="pais"><?php echo $valor['nombre'] ?></option>
                  <?php } ?>
                </select>
                <label for="nombre" class="col-form-label">Departamento:</label>
                <select name="departamento" id="departamento" class="form-select form-select-lg mb-3">
                  <option id="departamentoSeleccionado">-Seleccione un Departamento</option>

                </select>

                <label for="nacimientoCliente" class="col-form-label">Municipio de Residencia</label>
                <select name="municipio" id="municipio" class="form-select form-select-lg mb-3">
                  <option id="MunicipioSeleccionado">-Seleccione un Municipio-</option>
                  <?php foreach ($municipios as $x => $valor) { ?>
                    <option value="<?php echo $valor['id'] ?>" name="municipio" id="municipio"><?php echo $valor['nombre'] ?></option>
                  <?php } ?>
                </select>
                <label for="cargo" class="col-form-label">Cargo</label>
                <select name="cargo" id="cargo" class="form-select form-select-lg mb-3">
                  <option id="CargoSeleccionado">-Seleccione un Cargo-</option>
                  <?php foreach ($cargos as $x => $valor) { ?>
                    <option value="<?php echo $valor['id'] ?>" name="cargo" id="cargo"><?php echo $valor['nombre'] ?></option>
                  <?php } ?>
                </select>

              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Salario $:</label>
                <div class="flex ">
                  <input type="number" name="salario" class="form-control" id="salario">
                </div>
              </div>
              <div class="mb-3">
                <label for="periodo" class="col-form-label">Periodo (Salario):</label>
                <div class="flex ">
                  <select class="form-select" name="periodo" aria-label="periodo" id="periodo">
                    <option id="PeriodoSeleccionado">-- Seleccionar Año --</option>
                    <?php $years = range(strftime("%Y", time()), 1940); ?>
                    <?php foreach ($years as $year) : ?>
                      <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <input type="text" id="salario_id" name="salario_id" hidden>
                  <input type="text" id="tp" name="tp" hidden>
                  <input type="text" id="id" name="id" hidden>
                  <input type="text" id="NombreValido" name="id" hidden>

                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-outline-primary">Guardar</button>
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
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
          <button type="button" class="btn btn-primary close" data-dismiss="modal">No</button>
          <a class="btn btn-danger btn-ok">Si</a>
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

  $(document).ready(function() {
    //Cambio del select paises
    $('#selectPais').on('change', () => {
      console.log("Inicio la funcion")
      pais = $('#selectPais').val()
      $.ajax({
        url: "<?php echo base_url('municipios/obtenerDepartamentosPais/'); ?>" + pais,
        type: 'POST',
        dataType: 'json',
        success: function(res) {
          console.log(res)
          var cadena
          cadena = `<option selected> ---Seleccionar Departamento---</option>`
          for (let i = 0; i < res.length; i++) {
            cadena += `<option value='${res[i].id}'>${res[i].nombre} </option>`
          }
          cadena += `</select>`
          $('#departamento').html(cadena)
        }
      })
    })

    $('#formulario').on('submit', function(e) {
      nombres = $("#nombres").val();
      apellidos = $("#apellidos").val();
      nacimiento = $("#nacimiento").val();
      pais = $("#selectPais").val();
      departamento = $("#departamento").val();
      municipio = $('#MunicipioSeleccionado').val();
      cargo = $('#cargo').val();
      periodo = $('#periodo').val();
      if ([nombres, apellidos, nacimiento, pais, departamento, municipio, cargo, periodo].includes('')) {
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

    const NombreVa = document.getElementById('NombreValido'); //Capturo el un input oculto para validar
    const nombres = document.getElementById('nombres'); //Capturo el un input Nombre para validar

    nombres.addEventListener("input", function() { //Por cada evento en el input la funcion se ejecuta
      console.log('Se llamo a la funcion')
      // validacion(nombres.value, 'nombres', 'Nombre');
    })


    function validacion(valor, columna, param) {

      if (!valor) { //En caso de que el input esta vacio El div de validacion queda vacio
        cadena = ``
        $('#MensajeValidacion' + param).html(cadena);
      } else {
        $.ajax({
          url: "<?php echo base_url('empleados/validar_Nombre/'); ?>" + valor + '/' + columna, //Consulto a la base de datos si hay paises con el mismo 
          type: 'POST',
          dataType: 'json',
          success: function(res) {

            if (res.length == 0) {
              cadena = `
            <span class="text-success" id="mensaje">Campo Valido</span>
                `
              NombreVa.setAttribute('value', "1")
              $('#MensajeValidacion' + param).html(cadena);
            } else {
              cadena = `
                  <span class="text-danger" id="mensaje">Campo Invalido</span>
                `
              NombreVa.setAttribute('value', "")
              $('#MensajeValidacion' + param).html(cadena);
            }
          }
        })
      }
    }

    $('#departamento').on('change', () => {
      console.log("Inicio la funcion")
      dpto = $('#departamento').val()
      $.ajax({
        url: "<?php echo base_url('municipios/obtenerMuniDpto/'); ?>" + dpto,
        type: 'POST',
        dataType: 'json',
        success: function(res) {
          console.log(res)
          var cadena
          cadena = `<option selected> ---Seleccionar Municipio---</option>`
          for (let i = 0; i < res.length; i++) {
            cadena += `<option value='${res[i].id}'>${res[i].nombre} </option>`
          }
          cadena += `</select>`
          $('#municipio').html(cadena)
        }
      })
    })
  })

  function seleccionarEmp(id, tp) {
    if (tp == 2) {
      dataURL = "<?php echo base_url('/empleados/buscar_Emp'); ?>" + "/" + id;
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {
          console.log(rs)
          $("#tp").val(2);
          $("#id").val(rs[0]['id'])
          $("#codigo").val(rs[0]['codigo']);
          $("#nombres").val(rs[0]['nombres']);
          $("#apellidos").val(rs[0]['apellidos']);
          $("#MunicipioSeleccionado").val(rs[0]['id_municipio']);
          $("#MunicipioSeleccionado").text(rs[0]['NMuni']);
          $("#Seleccionado").text(rs[0]['nacimiento']);
          $("#Seleccionado").val(rs[0]['nacimiento']);
          $("#CargoSeleccionado").val(rs[0]['id_cargo']);
          $("#CargoSeleccionado").text(rs[0]['NCargo']);
          $("#salario").val(rs[0]['salario']);
          $("#PeriodoSeleccionado").text(rs[0]['periodo']);
          $("#PeriodoSeleccionado").text(rs[0]['periodo']);
          $("#salario_id").val(rs[0]['salario_id']);
          $("#departamentoSeleccionado").val(rs[0]['dpto_id']);
          $("#departamentoSeleccionado").text(rs[0]['dpto_nombre']);
          $("#paisSeleccionado").val(rs[0]['pais_id']);
          $("#paisSeleccionado").text(rs[0]['pais_nombre']);

          $("#btn_Guardar").text('Actualizar');
          $("#tituloModal").text('Actualizar el país ' + rs[0]['nombre']);
          $("#modalAgregar").modal("show");
        }
      })
    } else {
      console.log("Else")
      $("#tp").val(1);
      $("#id").val("")
      $("#codigo").val("");
      $("#nombres").val("");
      $("#apellidos").val("");
      $("#MunicipioSeleccionado").val("");
      $("#Seleccionado").val("");
      $("#CargoSeleccionado").val("");
      $("#salario").val("");
      $("#PeriodoSeleccionado").val("");
      $("#salario_id").val("");
      $("#btn_Guardar").text('Guardar');
      $("#tituloModal").text('Agregar Nuevo País');
      $("#PaisModal").modal("show");
    }
  };

  $('.close').click(function() {
    $("#modal-confirma").modal("hide");
  });
</script>