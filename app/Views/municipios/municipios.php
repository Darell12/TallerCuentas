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
                <option id="paisSeleccionado">-Seleccione un País-</option>
                <?php foreach ($paises as $x => $valor) { ?>
                  <option value="<?php echo $valor['id'] ?>" name="pais"><?php echo $valor['nombre'] ?></option>
                <?php } ?>
              </select>
              <label for="nombre" class="col-form-label">Departamento:</label>
              <select name="departamento" id="departamento" class="form-select form-select-lg mb-3">
                <option id="departamentoSeleccionado"></option>

              </select>
              <label for="nombre" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" name="nombre" id="nombre" required>
              <div id="MensajeValidacionNombre">
                <!-- MENSAJE DINAMICO -->
              </div>
              <input type="text" id="tp" name="tp" hidden>
              <input type="text" id="id" name="id" hidden>
              <input type="text" id="NombreValido" name="id" hidden>
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
  })

  const NombreVa = document.getElementById('NombreValido'); //Capturo el un input oculto para validar
  const NombreP = document.getElementById('nombre'); //Capturo el un input Nombre para validar
  const id = document.getElementById('id'); //Capturo el
  NombreP.addEventListener("input", function() { //Por cada evento en el input la funcion se ejecuta
    let valor = NombreP.value; // tomo el valor del input de nombre
    let cadena
    console.log(id.value)
    if (!valor) { //En caso de que el input esta vacio El div de validacion queda vacio
      cadena = ``
      $('#MensajeValidacionNombre').html(cadena);
    } else {
      $.ajax({
        url: "<?php echo base_url('municipios/validar_Nombre/'); ?>" + valor + '/' + id.value, //Consulto a la base de datos si hay paises con el mismo 
        type: 'POST',
        dataType: 'json',
        success: function(res) {
          console.log(res)
          if (res.length == 0 || res[1].nombre == res[0].nombre ) {
            // console.log(res[1].nombre == res[0].nombre)
            cadena = `
            <span class="text-success" id="mensaje">Nombre Valido</span>
                `
            NombreVa.setAttribute('value', "1")
            $('#MensajeValidacionNombre').html(cadena);
          } else {
            cadena = `
                  <span class="text-danger" id="mensaje">Nombre Invalido</span>
                `
            NombreVa.setAttribute('value', "")
            $('#MensajeValidacionNombre').html(cadena);
          }
        }
      })
    }
  })

  // Ejemplo de valor de tp y valor del input
  // const inputVal = "valor del input";
  // const tp = document.getElementById('tp');
  // NombreP.addEventListener('input', function() {
  //   let valor = NombreP.value; // tomo el valor del input de nombre
  //   let cadena
  //   let tpv = tp.value;
  //   console.log(tpv)
  //   if (!valor) {
  //     console.log('primer if')
  //     cadena = ``
  //     $('#MensajeValidacionNombre').html(cadena);
  //   } else {
  //     console.log('campo lleno')
  //     if (tpv === 1) {
  //       console.log('Tp 1 Funcion')
  //       // Realizar consulta y verificar si la respuesta tiene un length igual a 0
  //       $.ajax({
  //         url: '<?php echo base_url('municipios/validar_Nombre/'); ?>' + valor,
  //         type: 'POST',
  //         dataType: 'json',
  //         success: function(res) {
  //           console.log(res)
  //           if (res.length == 0) {
  //             console.log('if res vacio')
  //             cadena = `
  //           <span class="text-success" id="mensaje">Nombre Valido</span>
  //               `
  //             NombreVa.setAttribute('value', "1")
  //             $('#MensajeValidacionNombre').html(cadena);
  //           } else {
  //             cadena = `
  //                 <span class="text-danger" id="mensaje">Nombre Invalido</span>
  //               `
  //             NombreVa.setAttribute('value', "")
  //             $('#MensajeValidacionNombre').html(cadena);
  //           }
  //         }
  //       })
  //     } else {
  //       console.log('Tp 2 Funcion')
  //       // Realizar consulta y comparar valor del input con valor recibido en respuesta
  //       $.ajax({
  //         url: '<?php echo base_url('municipios/validar_Nombre/'); ?>' + valor,
  //         type: 'POST',
  //         dataType: 'json',
  //         success: function(res) {
  //           console.log(res)
  //           if (valor === res[0].nombre) {
  //             cadena = `
  //           <span class="text-success" id="mensaje">Nombre Valido</span>
  //               `
  //             NombreVa.setAttribute('value', "1")
  //             $('#MensajeValidacionNombre').html(cadena);
  //           } else if (res.length > 0) {
  //             console.log('else if')
  //             cadena = `
  //                 <span class="text-danger" id="mensaje">Nombre Invalido</span>
  //               `
  //             NombreVa.setAttribute('value', "")
  //             $('#MensajeValidacionNombre').html(cadena);
  //           }
  //         }
  //       })
  //     }


  //   }
  // })





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

  function limpiar() {
    console.log('limpio')
    $("#nombre").val('');
    $("#departamentoSeleccionado").val('');
    $("#departamentoSeleccionado").text('');
    $("#paisSeleccionado").val('');
    $("#paisSeleccionado").text('-Seleccione un País-');
    $("#btn_Guardar").text('Guardar');
    $("#tituloModal").text('Agregar Nuevo Municipio');
    $("#MuniModal").modal("show");
  }

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
          $("#nombre").val(rs[0]['nombre']);
          $("#departamentoSeleccionado").val(rs[0]['id_dpto']);
          $("#departamentoSeleccionado").text(rs[0]['Departamento']);
          $("#paisSeleccionado").val(rs[0]['pais_id']);
          $("#paisSeleccionado").text(rs[0]['PNombre']);

          $("#btn_Guardar").text('Actualizar');
          $("#tituloModal").text('Actualizar el Municipio ' + rs[0]['nombre']);
          $("#MuniModal").modal("show");
        }
      })
    } else {
      console.log("Else")
      $("#tp").val(1);
      $("#id").val('0')
      $("#nombre").val('');
      $("#departamentoSeleccionado").val('');
      $("#departamentoSeleccionado").text('');
      $("#paisSeleccionado").val('');
      $("#paisSeleccionado").text('-Seleccione un País-');
      $("#btn_Guardar").text('Guardar');
      $("#tituloModal").text('Agregar Nuevo Municipio');
      $("#MuniModal").modal("show");
    }
  };

  $('.close').click(function() {
    $("#modal-confirma").modal("hide");
  });
</script>