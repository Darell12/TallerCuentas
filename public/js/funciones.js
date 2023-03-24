function validacionMejorada(
  valor, // Valor ingresado en el input en la vista
  columna, // Nombre de la columna en la base de datos que se va a comparar con el valor ingresado
  valido, // Input oculto en el formulario que indica si el valor es válido (1) o no (0)
  caja, // Sufijo que se utiliza para diferenciar los contenedores donde se muestran los mensajes de validación
  tabla, // Nombre del controlador al que se dirige la consulta
  id_registro // Id del registro que se está editando (si se está realizando una edición)
) {
  // Si el valor está vacío, se limpia el contenedor de validación y se sale de la función
  if (!valor) {
    $("#MensajeValidacion" + caja).html("");
    return;
  }

  // Se realiza una petición ajax para validar el campo en la base de datos
  $.ajax({
    url: tabla + "/validar_Campo/" + valor + "/" + columna + "/" + id_registro,
    type: "POST",
    dataType: "json",
    success: function (res) {
      // Se definen 3 casos posibles según el tamaño del array que se recibe como respuesta de la consulta
      switch (res.length) {
        // Caso 1: no se encontraron coincidencias en la base de datos
        case 0:
          // Se muestra un mensaje de validación exitosa en el contenedor correspondiente
          $("#MensajeValidacion" + caja).html(
            '<span class="text-success" id="mensaje">Campo Válido</span>'
          );
          // Se asigna el valor 1 al input oculto para indicar que el valor es válido y permitir que la consulta SQL proceda
          valido.setAttribute("value", "1");
          break;
        // Caso 2: se encontró una coincidencia en la base de datos
        case 1:
          // Se muestra un mensaje de validación de error en el contenedor correspondiente
          $("#MensajeValidacion" + caja).html(
            '<span class="text-danger" id="mensaje">Campo Inválido</span>'
          );
          // Se asigna el valor 0 al input oculto para indicar que el valor es inválido y no permitir que la consulta SQL proceda
          valido.setAttribute("value", "0");
          break;
        // Caso 3: se encontró una coincidencia en la base de datos pero se está editando el registro correspondiente y el valor que se está validando es el valor original
        case 2:
          // Se obtiene el valor original de la base de datos
          let valorOriginal = res[1][columna];
          // Si el valor que se está validando es igual al valor original, se muestra un mensaje de validación exitosa en el contenedor correspondiente
          if (valor === valorOriginal) {
            $("#MensajeValidacion" + caja).html(
              '<span class="text-success" id="mensaje">Campo Válido</span>'
            );
            // Se asigna el valor 1 al input oculto para indicar que el valor es válido y permitir que la consulta SQL proceda
            valido.setAttribute("value", "1");
            // Si el valor que se está validando es distinto al valor original, se muestra un mensaje de validación de error en el
          }
      }
    },
  });
}
