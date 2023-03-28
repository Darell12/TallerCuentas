function validacionMejorada(
  valor, // Valor es el texto que estamos ingresando en el input en la vista
  columna, // Columna es la Columna de la base de datos con la que vamos a comparar nuestro valor
  valido, // Valido es un input oculto dentro de el formulario en la vista donde segun si el valor es 1 / 0 definiremos si es valido para ser ingresado
  caja, // Caja es un sufijo con el cual diferenciaremos los contenedores donde mostraremos nuestros mensajes de validacion example: MensajeValidacion + Nombre
  tabla, // Tabla es el nombre del controlador al cual va dirigido nuestra consulta
  id_registro // En caso de estar realizando una edicion este será la id del registro que esta siendo editado
  ) {
    if (!valor) {
      //En caso de que el input esta vacio El div de validacion queda vacio
      cadena = ``;
      $("#MensajeValidacion" + caja).html(cadena);
    } else {
      $.ajax({
      url:
        tabla + "_validar/" + valor + "/" + columna + "/" + id_registro,
        type: "POST",
        dataType: "json",
        success: function (res) {
          // Se definen 3 casos posibles segun el tamaño del array que recibimos como respuesta de nuestra consulta
          switch (res.length) {
            case 0:
            //En esta caso el array recibido esta vacio
            //Esto quiere decir que no hay ninguna coincidencia entre nuestro input y los valores en la base de datos
            // console.log("Respuesta Vacia");
            // Cadena será el elemnto html que generaremos de forma dinamica en el contenedor designado por parametros
            cadena = `
            <span class="text-success" id="mensaje">Campo Valido</span>
            `;
            // Le asignamos al input oculto el valor de 1, lo que permitira que la cosulta SQL proceda
            valido.setAttribute("value", "1");
            // Definimos en que contenedor se debe introducir nuestro mensaje
            $("#MensajeValidacion" + caja).html(cadena);
            $(valido).val(1);
            break;
            case 1:
              // Cuando recibimos un array con datos quiere decir que la consulta encontro una coincidencia en nuestra base de datos por lo cual es invalido el campo actual
              // console.log("Respuesta: Coincidencia en el campo");
              // Cadena será el elemnto html que generaremos de forma dinamica en el contenedor designado por parametros
            cadena = `
            <span class="text-danger" id="mensaje">Campo Invalido</span>
            `;
            // Le asignamos al input oculto el valor de 1, lo que permitira que la cosulta SQL proceda
            valido.setAttribute("value", "");
            $(valido).val('');
            // Definimos en que contenedor se debe introducir nuestro mensaje
            $("#MensajeValidacion" + caja).html(cadena);
            break;
            case 2:
              // Este caso solo debería activarse en caso de que estemos editando un registro
              // Recibimos un array con 2 objetos
              // console.log("Respues}ta: Coincidencia en el campo edit");
              // console.log(res);
              // Primero concatenamos la variable columna con el prefijo res[1].
              // Esto para que la condicion sea dinamica y podamos comparar diferentes
              // Columnas dependiendo del contexto en el que se ejecute la funcion
              let editando = "res[1]." + columna;
              // editando nos trae el valor inical del registro que estamos modificando
              // Lo enfrentamos con valor_comparar
              // valor_comparar es la coincidencia que nos retorna la base de datos segun nuestro input en la vista
              
              // Al hacer esta comparacion le estamos permitiendo al programa que al momento de actualizar
              // Podamos ingresar nuevamente el valor inical que estamos validando sin que sea truncado
            // ejemplo editando = cartagena  & valor_comparar = editando
            // Al ser iguales se permite que el campo sea valido
            
            if (eval(editando) == res[0].valor_comparar) {
              // console.log("Nombres iguales con el campo edit");
              cadena = `
              <span class="text-success" id="mensaje">Campo Valido</span>
              `;
              valido.setAttribute("value", "1");
              $(valido).val(1);
              $("#MensajeValidacion" + caja).html(cadena);
            } else if ((res[0].valor_comparar = valor)) {
              // En esta condicion estamos comparando valor_comparar (La coincidencia de la bd), con valor (Lo que estamos escribiendo en el input)
              //Si son iguales quiere decir que estamos ingresando un valor repetido por lo cual se invalida el mismo
              // console.log("Campo Ya existente en la bd");
              cadena = `
              <span class="text-danger" id="mensaje">Campo Invalido</span>
              `;
              valido.setAttribute("value", "");
              $(valido).val('');
              $("#MensajeValidacion" + caja).html(cadena);
            }
            break;
            default:
            console.log("Ningún caso coincide");
          }
          
          console.log(res);
        },
    });
  }
}

// controlador +
// "/validar_Campo/" +
// valor +
// "/" +
// columna +
// "/" +
// id_registro,