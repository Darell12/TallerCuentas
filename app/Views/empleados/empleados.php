<div class="container mt-4 shadow rounded-4">
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
            <th class="text-center">ID</th>
            <th class="text-center">Nombres</th>
            <th class="text-center">Apellidos</th>
            <th class="text-center">Nacimiento</th>
            <th class="text-center">Municipio</th>
            <th class="text-center">Departamento</th>
            <th class="text-center">País</th>
            <th class="text-center">Cargo</th>
            <th class="text-center">Salario</th>
            <th class="text-center">Estado</th>
            <th class="text-center" colspan="2">Acciones</th>
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
              <th class="text-center">
                <button type="button" class="btn btn-outline-success" onclick="salarios_empleados(<?php echo $valor['id'] ?>, 'A');">
                  <i class="bi bi-cash-coin"></i>
                </button>
              </th>
              <th class="text-center">
                <?php echo $valor['estado'] = 'A' ?  '<span class="text-success"> Activo </span>' : 'Inactivo'; ?>
              </th>
              <th class="grid grid text-center" colspan="2">
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                  <button class="btn btn-outline-primary" onclick="seleccionarEmp(<?php echo $valor['id'] . ',' . 2 ?>);"><i class="bi bi-pencil"></i></button>

                  <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-href="<?php echo base_url('/estado_empleados') . '/' . $valor['id'] . '/' . 'E'; ?>"><i class="bi bi-trash3"></i></button>
                </div>
              </th>

            </tr>
          <?php } ?>

        </tbody>
      </table>
    </div>

    <!--   Modal agregar   --->
    <form method="POST" action="<?php echo base_url(); ?>/empleados_insertar" autocomplete="off" id="formulario">
      <div class="modal fade" tabindex="-1" role="dialog" id="modalAgregar" data-bs-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="tituloModal">Agregar Empleados</h4>
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

                <label for="periodo" class="col-form-label">Año de Nacimiento </label>
                <div class="flex ">
                  <select class="form-select" name="nacimiento" aria-label="periodo" id="nacimiento">
                    <option id="Seleccionado" value="0">-- Seleccionar Año --</option>
                    <?php $years = range(strftime("%Y", time()), 1940); ?>
                    <?php foreach ($years as $year) : ?>
                      <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <label for="nombre" class="col-form-label">Pais:</label>
                <select name="pais" class="form-select form-select" id="selectPais">
                  <option value="">-Seleccione un País-</option>
                  <?php foreach ($paises as $x => $valor) { ?>
                    <option value="<?php echo $valor['id'] ?>" name="pais" <?php echo $valor['estado'] != 'A' ? 'disabled' :  '' ?>><?php echo $valor['estado'] != 'A' ? $valor['nombre'] . '~ Inactivo' : $valor['nombre'] ?></option>
                  <?php } ?>
                </select>
                <label for="nombre" class="col-form-label">Departamento:</label>
                <select name="departamento" id="departamento" class="form-select">
                  <option value="">-Seleccione un Departamento</option>

                </select>

                <label for="nacimientoCliente" class="col-form-label">Municipio de Residencia</label>
                <select name="municipio" id="municipio" class="form-select form-select ">
                  <option value="">-Seleccione un Municipio-</option>

                </select>
                <label for="cargo" class="col-form-label">Cargo</label>
                <select name="cargo" id="cargo" class="form-select form-select">
                  <option id="CargoSeleccionado" value="0">-Seleccione un Cargo-</option>
                  <?php foreach ($cargos as $x => $valor) { ?>
                    <option value="<?php echo $valor['id'] ?>" name="cargo" id="cargo"><?php echo $valor['nombre'] ?></option>
                  <?php } ?>
                </select>

              </div>
              <div class="mb-3">
                <div class="flex ">
                  <input type="text" id="salario_id" name="salario_id" hidden>
                  <input type="text" id="tp" name="tp" hidden>
                  <input type="text" id="id" name="id" hidden>

                </div>
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
  </div>

  <!-- Modal Confirma Eliminar Empleados-->
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
          <a class="btn btn-outline-danger btn-ok">Aceptar</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Elimina -->

  <!-- Modal Admin Salarios -->
  <div id="ModalSalarios" class="modal">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title" id="titulo_salario"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="btn-group mb-3" id="btn-group-salarios" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalAgregarSalario" id="btn-agregar-salario">
              <i class="bi bi-plus-circle-fill"></i> Agregar</button>

            <button type="button" class="btn btn-outline-secondary" id="btn-eliminados-salarios">
              <i class="bi bi-file-x"></i> Eliminados</button>

            <button class="btn btn-outline-primary" id="btn-regresar"><i class="bi bi-arrow-return-left"></i> Regresar</button>

          </div>

          <div class="table-responsive" style="overflow:scroll-vertical;overflow-y: scroll !important; height: 600px;">
            <table class="table table-bordered table-sm table-hover" id="tableEmpleados" width="100%" cellspacing="0">
              <thead class="table-dark">
                <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Salario</th>
                  <th class="text-center">Periodo</th>
                  <th class="text-center">Estado</th>
                  <th class="text-center" colspan="2">Acciones</th>
                </tr>
              </thead>
              <tbody style="font-family:Arial;font-size:12px;" id="tabla_salario">

              </tbody>
            </table>
          </div>

        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>

  <!-- Modal Confirma Eliminar  Salario-->
  <div class="modal fade" id="modal-confirma-salario" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div style="text-align:center;" class="modal-header">
          <h5 style="color:#98040a;font-size:20px;font-weight:bold;" class="modal-title" id="exampleModalLabel">Eliminación de Salario</h5>
        </div>
        <div style="text-align:center;font-weight:bold;" class="modal-body">
          <p>Seguro Desea Eliminar éste Registro?</p>
        </div>
        <input type="text" id="id_almacenar" hidden>
        <input type="text" id="id_almacenar_empleado" hidden>
        <input type="text" id="id_almacenar_estado" hidden>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary close" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-outline-danger btn-ok-salario" id="btnEliminar">Aceptar</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Elimina -->

  <!-- MODAL AGREGAR SALARIO -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modalAgregarSalario" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="titulo_salario_modal">Agregar Salario</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="message-text" class="col-form-label">Salario $:</label>
            <div class="flex ">
              <input type="number" name="salario_modal" class="form-control" id="salario_modal">
            </div>
          </div>
          <div class="mb-3">
            <label for="periodo" class="col-form-label">Periodo (Salario):</label>
            <div class="flex ">
              <select class="form-select" name="periodo_modal" aria-label="periodo" id="periodo_modal">
                <option id="PeriodoSeleccionado" value="0">-- Seleccionar Año --</option>
                <?php $years = range(strftime("%Y", time()), 1940); ?>
                <?php foreach ($years as $year) : ?>
                  <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                <?php endforeach; ?>
              </select>
              <input type="text" id="id_empleado" name="id_empleado" hidden>
              <input type="text" id="tp_salario" name="tp_salario" hidden>
              <input type="text" id="id_salario" name="id_salario" hidden>


            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-primary" id="btnInsertar">Guardar</button>
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>



</div>


<script>
  $('#modal-confirma').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  });

  $('#modal-confirma-salario').on('show.bs.modal', function(e) {
    console.log('modal salario')
    $(this).find('.btn-ok-salario').attr('href', $(e.relatedTarget).data('href'));
  });

  $('#selectPais').on('change', () => {
    pais = $('#selectPais').val();
    console.log('Obtener muncicipios')
    obtenerDepartamentos(pais)
  })

  $('#departamento').on('change', () => {
    departamento = $('#departamento').val();
    obtenerMunicipios(departamento)
  })

  function obtenerDepartamentos(pais, id_dpto, id_municipio) {
    $.ajax({
      url: "<?php echo base_url('buscar_dptos_muni/'); ?>" + pais,
      type: 'POST',
      dataType: 'json',
      success: function(res) {
        $('#departamento').empty();
        var cadena
        cadena = `<select name="departamento" id="departamento" class="form-select">
        <option selected value="">Seleccionar Departamento</option>`
        for (let i = 0; i < res.length; i++) {
          cadena += `<option value='${res[i].id}' ${res[i].estado != 'A' ? 'disabled' :  ''} >${res[i].estado != 'A' ? res[i].nombre + ' ~ Inactivo' :  res[i].nombre}  </option>`
        }
        cadena += `</select>`
        $('#departamento').html(cadena)
        $('#departamento').val(id_dpto)
        municipio = $('#municipio').val();
      }
    })
  }

  function obtenerMunicipios(id_dpto, id_municipio) {
    $.ajax({
      url: "<?php echo base_url('buscar_muni_dptos/'); ?>" + id_dpto,
      type: 'POST',
      dataType: 'json',
      success: function(res) {
        $('#municipio').empty();
        var cadena
        cadena = `<select name="municipio" id="municipio" class="form-select">
                               <option selected value="">Seleccionar Municipio</option>`
        for (let i = 0; i < res.length; i++) {
          cadena += `<option value='${res[i].id}' ${res[i].estado != 'A' ? 'disabled' :  ''}>${res[i].estado != 'A' ? res[i].nombre + ' ~ Inactivo' :  res[i].nombre} </option>`
        }
        cadena += `</select>`
        $('#titulo_salario').text(`Administrar Salarios sfd ${res[0].nombre_empleado}`)
        $('#municipio').html(cadena)
        $('#municipio').val(id_municipio)
      }
    })
  }

  $('#formulario').on('submit', function(e) {
    nombres = $("#nombres").val();
    apellidos = $("#apellidos").val();
    nacimiento = $("#nacimiento").val();
    pais = $("#selectPais").val();
    departamento = $("#departamento").val();
    municipio = $('#MunicipioSeleccionado').val();
    cargo = $('#cargo').val();
    periodo = $('#periodo').val();
    console.log("swal antes del if")
    if (nombres == "" || apellidos == "" || nacimiento == "" || pais == "" || departamento == "" || municipio == "" || cargo == "" || periodo == "") {
      e.preventDefault()
      console.log("swal despues del if")
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

  function salarios_empleados(id, estado) {
    console.log('Funcionando. salarios X empleado.')

    dataURL = estado == 'E' ?
      "<?php echo base_url('/salarios_eliminado'); ?>" + "/" + id :
      "<?php echo base_url('/salarios_empleado'); ?>" + "/" + id

    if (estado == 'E') {
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {
          $('#tabla_salario').empty();
          var contenido = '';
          if (!$(rs).length == 0) {
            for (let i = 0; i < rs.length; i++) {
              contenido += `
                  <tr>
                  <th class="text-center"> ${rs[i].id}</th>
                  <th class="text-center"> ${rs[i].sueldo}</th>
                  <th class="text-center"> ${rs[i].periodo}</th>
                  <th class="text-center text-danger"> ${rs[i].estado == 'A' ? 'Activo' : 'Inactivo'}</th>
                  <th class="text-center">
    
                  <button class="btn btn-outline-warning" data-bs-toggle="modal" hidden-bs-modal(#modal) data-bs-target="#modal-confirma-salario" onclick="almacenarId(${rs[i].id},${rs[i].id_empleado}, 'A')" ?><i class="bi bi-arrow-clockwise"></i></button>
                  </th>
                  </tr>
                  `
            }
            $('#titulo_salario').html('Administrar salarios eliminados de ' + rs[0].nombre_empleado);
          } else {
            contenido = '<tr><th class="text-center h1" colspan="5">SIN SALARIOS ELIMINADOS</th></tr>'
            console.log(rs)
          }

          $('#tabla_salario').html(contenido);
          $('#btn-regresar').attr('onclick', 'salarios_empleados(' + id + ',' + '"A")');
          $('#btn-eliminados-salarios').hide();
          $('#btn-regresar').show();
          $('#btn-agregar-salario').hide();
          $('#ModalSalarios').modal('show');
        }
      })
    } else {
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {
          var contenido = '';
          if (!$(rs).length == 0) {
            for (let i = 0; i < rs.length; i++) {
              console.log(rs);
              contenido += `
                <tr>
                <th class="text-center"> ${rs[i].id}</th>
                <th class="text-center"> ${rs[i].sueldo}</th>
                <th class="text-center"> ${rs[i].periodo}</th>
                <th class="text-center text-success"> ${rs[i].estado == 'A' ? 'Activo' : 'Inactivo'}</th>
                <th class="text-center">
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button class="btn btn-outline-primary" onclick="seleccionarSalario( ${rs[i].id} ,2 );"><i class="bi bi-pencil"></i></button>
      
                <button class="btn btn-outline-danger" data-bs-toggle="modal" hidden-bs-modal(#modal) data-bs-target="#modal-confirma-salario" onclick="almacenarId(${rs[i].id},${rs[i].id_empleado}, 'E')"><i class="bi bi-trash3"></i></button>
                </div>
                </th>
                </tr>
                `
              // data - href = "<?php echo base_url('/salarios/cambiarEstado/') ?>${rs[i].id}/E"
            }
            $('#titulo_salario').html('Administrar salarios de ' + rs[0].nombre_empleado);

          } else {
            contenido = '<tr><th class="text-center h1" colspan="5">SIN SALARIOS ASIGNADO</th></tr>'
            console.log(rs)
          }
          $('#titulo_salario').html('Administrar salarios');
          $('#btn-eliminados-salarios').attr('onclick', 'salarios_empleados(' + id + ',' + '"E")');
          $('#btn-agregar-salario').show();
          $('#tabla_salario').empty();
          $('#tabla_salario').html(contenido);
          $('#btn-agregar-salario').attr('onclick', 'seleccionarSalario(' + id + ',' + '1)');
          $('#btn-eliminados-salarios').show();
          $('#btn-regresar').hide();
          $('#ModalSalarios').modal('show');
        }
      })
    }
  }

  function seleccionarEmp(id, tp) {
    if (tp == 2) {
      dataURL = "<?php echo base_url('/buscar_empleado'); ?>" + "/" + id;
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {
          $("#tp").val(2);
          $("#id").val(rs[0]['id'])
          $("#codigo").val(rs[0]['codigo']);
          $("#nombres").val(rs[0]['nombres']);
          $("#apellidos").val(rs[0]['apellidos']);
          $("#nacimiento").val(rs[0]['nacimiento']);
          $("#CargoSeleccionado").val(rs[0]['id_cargo']);
          $("#CargoSeleccionado").text(rs[0]['NCargo']);
          $("#salario").val(rs[0]['salario']);
          $("#nacimiento").val(rs[0]['nacimiento']);
          $("#PeriodoSeleccionado").text(rs[0]['periodo']);
          $("#PeriodoSeleccionado").text(rs[0]['periodo']);
          $("#salario_id").val(rs[0]['salario_id']);
          $("#selectPais").val(rs[0]['pais_id']);
          $("#municipio").val(rs[0]['id_municipio']);
          $("#departamento").val(rs[0]['dpto_id']);
          obtenerDepartamentos(rs[0]['pais_id'], rs[0]['dpto_id']);
          obtenerMunicipios(rs[0]['dpto_id'], rs[0]['id_municipio']);


          $("#btn_Guardar").text('Actualizar');
          $("#tituloModal").text('Actualizar el empleado ' + rs[0]['nombres']);
          $("#modalAgregar").modal("show");
        }
      })
    } else {
      $("#tp").val(1);
      $("#id").val("")
      $("#codigo").val("");
      $("#nombres").val("");
      $("#apellidos").val("");

      $("#municipio").val("");
      $("#departamento").val("");
      $("#selectPais").val("");
      $("#nacimiento").val(0);
      $("#cargo").val(0);
      $("#salario").val("");
      $("#periodo").val("");
      $("#salario_id").val("");
      $("#btn_Guardar").text('Guardar');
      $("#tituloModal").text('Agregar Nuevo Empleado');
      $("#modalAgregar").modal("show");
    }
  };

  function seleccionarSalario(id, tp) {
    console.log('Funcion seleciconar salario')
    if (tp == 2) {
      dataURL = "<?php echo base_url('/salario_empleado'); ?>" + "/" + id;
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {
          $("#tp_salario").val(2)
          $("#id_salario").val(id)
          console.log(rs)
          $("#id_empleado").val(rs.id_empleado)
          $('#salario_modal').val(rs.sueldo);
          $('#periodo_modal').val(rs.periodo);


          $("#btn_Guardar").text('Actualizar');
          $("#titulo_salario_modal").text('Actualizar el salario de ' + rs.nombre_empleado + ' en el periodo ' + rs.periodo);
          $("#modalAgregarSalario").modal("show");
        }
      })
    } else {
      $("#tp_salario").val(1);
      $("#id_empleado").val(id)
      $('#salario_modal').val('');
      $('#periodo_modal').val(0);
      $("#btn_Guardar").text('Guardar');
      $("#titulo_salario_modal").text('Agregar nuevo salario');
      $("#modalAgregarSalario").modal("show");
    }
  }

  function almacenarId(id_salario, id_empleado, estado) {
    $("#id_almacenar").val(id_salario);
    $("#id_almacenar_empleado").val(id_empleado);
    $("#id_almacenar_estado").val(estado);
    console.log('Funcion almacenar')
    $("#modal-confirma-salario").modal('show');
  }

  $('#btnInsertar').click(function() {
    var data = {
      tp_salario: $('#tp_salario').val(),
      salario_modal: $('#salario_modal').val(),
      id_empleado: $('#id_empleado').val(),
      periodo_modal: $('#periodo_modal').val(),
      id_salario: $('#id_salario').val()
    };
    console.log(data.periodo_modal)
    if (data.salario_modal == "" || data.periodo_modal == 0) {
      return swal.fire({
        postition: 'top-end',
        icon: 'error',
        title: 'Error campos incompletos',
        text: 'Debe llenar todos los campos',
        showConfirmButton: false,
        timer: 1500
      })
    }
    $.post("<?php echo base_url('/salarios_insertar'); ?>", data, function(response) {
      // Actualiza el contenido de la página
      salarios_empleados(data.id_empleado, 'A')
      $("#modalAgregarSalario").modal('hide');
      console.log('Funciono')
    });
  });

  $('#btnEliminar').click(function() {
    console.log('Funcion cambiar estado')
    var data = {
      id_salario: $('#id_almacenar').val(),
      estado: $('#id_almacenar_estado').val(),
      id_empleado: $('#id_almacenar_empleado').val()
    };
    $.post("<?php echo base_url('/estado_salarios'); ?>", data, function(response) {
      // Actualiza el contenido de la página
      salarios_empleados(data.id_empleado, data.estado == 'A' ? 'E' : 'A')
      $("#modal-confirma-salario").modal('hide');
      console.log('Funciono')
    });
  });


  $('.close').click(function() {
    $("#modal-confirma").modal("hide");
  });
  $('.close').click(function() {
    $("#modal-confirma-salario").modal("hide");
  });
</script>