<div class="container">
    <div class="container  mt-4 shadow rounded-4">
        <div>
            <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
        </div>
        <div>
            <button type="button" onclick="seleccionaUsuario(<?php echo 1 . ',' . 1 ?>);" class="btn btn-outline-success " data-bs-toggle="modal" data-bs-target="#UsuarioModal"><i class="bi bi-plus-circle-fill"></i> Agregar</button>
            <a href="<?php echo base_url('/eliminados_paises'); ?>"><button type="button" class="btn btn-outline-secondary"><i class="bi bi-file-x"></i> Eliminados</button></a>
            <a href="<?php echo base_url('/principal'); ?>"><button class="btn btn-outline-primary"><i class="bi bi-arrow-return-left"></i> Regresar</button></a>
        </div>

        <br>
        <div class="table-responsive" style="overflow:scroll-vertical;overflow-y: scroll !important; height: 600px;">
            <table class="table table-bordered table-sm table-hover" id="tablePaises" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Tipo Documento</th>
                        <th class="text-center">N°Documento</th>
                        <th class="text-center">Primer Nombre</th>
                        <th class="text-center">Segundo Nombre</th>
                        <th class="text-center">Primer Apellido</th>
                        <th class="text-center">Segundo Apellido</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center" colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody style="font-family:Arial;font-size:12px;" class="table-group-divider">
                    <?php foreach ($datos as $valor) { ?>
                        <tr>
                            <th class="text-center"><?php echo $valor['id_usuario']; ?></th>
                            <th class="text-center"><?php echo $valor['email']; ?></th>
                            <th class="text-center"><?php echo $valor['tipo_documento']; ?></th>
                            <th class="text-center"><?php echo $valor['n_documento']; ?></th>
                            <th class="text-center"><?php echo $valor['nombre_p']; ?></th>
                            <th class="text-center"><?php echo $valor['nombre_s']; ?></th>
                            <th class="text-center"><?php echo $valor['apellido_p']; ?></th>
                            <th class="text-center"><?php echo $valor['apellido_s']; ?></th>
                            <th class="text-center">
                                <?php echo $valor['estado'] == 'A' ?  '<span class="text-success"> Activo </span>' : 'Inactivo'; ?>
                            </th>
                            <th class="grid grid text-center" colspan="2">

                                <button class="btn btn-outline-primary" onclick="seleccionaUsuario(<?php echo $valor['id_usuario'] . ',' . 2 ?>);" data-bs-toggle="modal" data-bs-target="#UsuarioModal">

                                    <i class="bi bi-pencil"></i>

                                </button>
                                <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-href="<?php echo base_url('/estado_paises') . '/' . $valor['id_usuario'] . '/' . 'E'; ?>"><i class="bi bi-trash3"></i></button>
                            </th>

                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
        <!-- Modal -->
        <form method="POST" action="<?php echo base_url('/usuarios/insertar'); ?>" autocomplete="off" class="needs-validation" id="formulario" novalidate>
            <div class="modal fade" id="UsuarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="tituloModal">Añadir Usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <label class="col-form-label">Tipo de Documento:</label>
                                        <select class="form-select form-select" name="tipo_documento" id="cc" required>
                                            <option value="">Seleccione un Tipo</option>
                                            <option value="cc">Cedula de Ciudadania</option>
                                            <option value="ti">Tarjeta de Identidad</option>
                                            <option value="ce">Cedula de Extranjeria</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="nombre" class="col-form-label">Numéro de Documento:</label>
                                        <input type="number" class="form-control" name="n_documento" id="n_documento" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="nombre" class="col-form-label">Primer Nombre:</label>
                                        <input type="text" class="form-control" name="primer_nombre" id="primer_nombre" maxlength="20" placeholder="Digite el nombre de un país" pattern="[A-Za-z]+" required>
                                    </div>
                                    <div class="col">
                                        <label for="nombre" class="col-form-label">Segundo Nombre:</label>
                                        <input type="text" class="form-control" name="segundo_nombre" id="segundo_nombre" maxlength="20" placeholder="Digite el nombre de un país" pattern="[A-Za-z]+" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="nombre" class="col-form-label">Primer Apellido:</label>
                                        <input type="text" class="form-control" name="primer_apellido" id="primer_apellido" maxlength="20" placeholder="Digite el nombre de un país" pattern="[A-Za-z]+" required>
                                    </div>
                                    <div class="col">
                                        <label for="nombre" class="col-form-label">Segundo Apellido:</label>
                                        <input type="text" class="form-control" name="segundo_apellido" id="segundo_apellido" required>
                                    </div>
                                </div>
                                <div class="">
                                    <label id="email_label" for="email">Correo Electronico</label>
                                    <input id="email" name="email" type="email" class="form-control" required />
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label id="password_label" for="password">Contraseña</label>
                                        <input id="contraseña" name="contraseña" type="password" class="form-control" required />
                                    </div>
                                    <div class="col">
                                        <label id="password_label" for="password">Confirme Contraseña</label>
                                        <input id="confirmar_contraseña" name="confirmar_contraseña" type="password" class="form-control" required />
                                    </div>
                                </div>

                                <input type="text" id="CodigoValido" name="CodigoValido" hidden>
                                <input type="text" id="tp" name="tp" hidden>
                                <input type="text" id="id" name="id" hidden>
                                <input type="text" id="NombreValido" name="NombreValido" hidden>

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

</div>

<script>
    $('#modal-confirma').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    function seleccionaUsuario(id, tp) {
        if (tp == 2) {
            dataURL = "<?php echo base_url('/usuarios/buscarUsuario'); ?>" + "/" + id;
            $.ajax({
                type: "POST",
                url: dataURL,
                dataType: "json",
                success: function(rs) {
                    console.log(rs)
                    $("#tp").val(2);
                    $("#id").val(id)
                    $('#tipo_documento').val(rs[0]['tipo_documento']);
                    $('#n_documento').val(rs[0]['n_documento']);
                    $('#primer_nombre').val(rs[0]['nombre_p']);
                    $('#segundo_nombre').val(rs[0]['nombre_s']);
                    $('#primer_apellido').val(rs[0]['apellido_p']);
                    $('#segundo_apellido').val(rs[0]['apellido_s']);
                    $('#email').val(rs[0]['email']);
                    $('#contraseña').val(rs[0]['contraseña']);
                    $("#btn_Guardar").text('Actualizar');
                    $("#UsuarioModal").modal("show");
                }
            })
        } else {
            $("#tp").val(1);
            $('#tipo_documento').val('');
            $('#n_documento').val('');
            $('#primer_nombre').val('');
            $('#segundo_nombre').val('');
            $('#primer_apellido').val('');
            $('#segundo_apellido').val('');
            $('#email').val('');
            $('#contraseña').val('');
            $("#btn_Guardar").text('Guardar');
            $("#UsuarioModal").modal("show");
        }
    }

    $.validator.addMethod("soloLetras", function(value, element) {
        return this.optional(element) || /^[a-zA-ZñÑ\s]+$/.test(value);
    }, "Por favor ingrese solamente letras.");

    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });
    $("#formulario").validate({
        rules: {
            n_documento: {
                required: true,
                digits: true
            },
            primer_nombre: {
                required: true,
                soloLetras: true,
            },
            segundo_nombre: {
                required: true,
                soloLetras: true,
            },
            primer_apellido: {
                required: true,
                soloLetras: true,
            },
            segundo_apellido: {
                required: true,
                soloLetras: true,
            },
            email: {
                required: true,
                email: true
            },
            contraseña: {
                required: true,
            },
            confirmar_contraseña: {
                required: true,
                equalTo: '#contraseña'
            }
        },
        messages: {
            email: {
                required: "El Email es requerido",
                email: "Por favor ingrese un email valido",
            },
            contraseña: {
                required: "La Contraseña es requerida",
            },
            confirmar_contraseña: {
                required: "La Contraseña es requerida",
                equalTo: 'Debe coincidir'
            }
        }
    });
    $('.close').click(function() {
        $("#modal-confirma").modal("hide");
    });
</script>