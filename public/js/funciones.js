
function validacion(valor, columna, param, caja) {

    if (!valor) { //En caso de que el input esta vacio El div de validacion queda vacio
      cadena = ``
      $('#MensajeValidacion' + param).html(cadena);
    } else {
      $.ajax({
        url: "<?php echo base_url('empleados/validar/'); ?>" + valor + '/' + columna, //Consulto a la base de datos si hay paises con el mismo 
        type: 'POST',
        dataType: 'json',
        success: function(res) {

          if (res.length == 0 ) {
            cadena = `
          <span class="text-success" id="mensaje">Campo Valido</span>
              `
            caja.setAttribute('value', "1")
            $('#MensajeValidacion' + param).html(cadena);
          } else {
            cadena = `
                <span class="text-danger" id="mensaje">Campo Invalido</span>
              `
            caja.setAttribute('value', "")
            $('#MensajeValidacion' + param).html(cadena);
          }
        }
      })
    }
  }

export function validacion();