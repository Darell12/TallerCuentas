<div class="container card my-4">
  <div>
    <h1 class="titulo_vista text-center"><?php echo $titulo; ?></h1>
    
  </div>
    <div>
          <button type="button" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar</button>
    <button type="button" class="btn btn-secondary">Eliminados</button>
    </div>

  <div id="layoutSidenav_content">

<br>

      <div class="table-responsive">
        <table class="table table-bordered table-sm table-striped" id="tableEmpleados" style="width:90%">
          <thead>
            <tr style="font-family:Arial;color:#purple;font-weight:300;text-align:center;font-size:14px;">
              <th>ID</th>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>Nacimiento</th>
              <th>Municipio</th>
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
                            <th class="text-center"><?php echo $valor['NMuni']; ?></th>
                            <th class="text-center"><?php echo $valor['NCargo']; ?></th>
                            <th class="text-center">$ <?php echo $valor['salario']; ?></th>
                            <th class="text-center"><?php echo $valor['estado']; ?></th>
                            <th class="grid grid text-center" colspan="2">
                                <button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
</svg></button>
                                <button class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
</svg>
</button>
                            </th>
                            
                        </tr>
                <?php } ?>

          </tbody>
        </table>
      </div>
          <!-- Modal Confirmar Eliminacion-->
    <div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div style="background: linear-gradient(90deg, #838da0, #b4c1d9);" class="modal-content">
                <div class="modal-header">
                    <h5 style="color:#98040a;font-size:20px;font-weight:bold;" class="modal-title" id="exampleModalLabel">Eliminación de Registro</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="text-align:center;font-weight:bold;" class="modal-body">

                    <p>Seguro Desea Eliminar el Registro ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>
                    <a class="btn btn-danger btn-ok">Si</a>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($validation)) { ?>
        <div class="alert alert-danger">
            <?php echo $validation->listErrors(); ?>
        </div>
    <?php } ?>
    <!--   Modal Editar   --->
    <form method="POST" action="<?php echo base_url(); ?>/clientes/actualizar" autocomplete="off">
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div style="background: linear-gradient(90deg, #b4c1d9 , #b4c1d9);" class="modal-content">
          <div class="modal-header">
            <h5 style="color:#98040a;font-size:20px;font-weight:bold;" class="modal-title" id="exampleModalLabel">Editar Cargos</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group col-12">
              <input type="hidden" id="id_Clientes" name="Id_clientes"/>
              <div class="row">
                <div class="col-12 col-sm-12">
                <label for="nombrecliente" class="col-form-label">Nombre del cliente</label>
                  <input type="text" class="form-control" id="nombrecliente" name="nombrecliente">
                  <label for="apellidocliente" class="col-form-label">Apellido</label>
                  <input type="text" class="form-control" id="apellidocliente"  name="apellidocliente">>
                  <label for="direccioncliente" class="col-form-label">Direccion</label>
                  <input type="text" class="form-control" id="direccioncliente" name="direccioncliente">
                  <label for="telefonocliente" class="col-form-label">Telefono</label>
                  <input type="text" class="form-control" id="telefonocliente" name="telefonocliente">
                  <label for="sexocliente" class="col-form-label">Sexo</label>
                  <input type="text" class="form-control" id="sexocliente" name="sexocliente">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="<?php echo base_url(); ?>/clientes" class="btn btn-primary">Regresar</a>
            <button type="submit" class="btn btn-success">Actualizar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
    <!--   Modal agregar   --->
    <form method="POST" action="<?php echo base_url(); ?>/empleados/insertar" autocomplete="off">
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
                  <label for="nombrecliente" class="col-form-label">Apellidos</label>
                  <input type="text" class="form-control" id="apellidos" name="apellidos">
                  <label for="apellidocliente" class="col-form-label">Fecha de Nacimiento</label>
                  <input type="text" class="form-control" id="nacimiento"  name="nacimineto">
                  <label for="nacimientoCliente" class="col-form-label">Municipio de Residencia</label>
                  <select name="municipio" id="municipio" class="form-select form-select-lg mb-3">
                    <option value="">-Seleccione un Municipio-</option>
                      <?php foreach ($municipios as $x => $valor) { ?>
                        <option value="<?php echo $valor['id'] ?>" name="municipio"><?php echo $valor['nombre'] ?></option>
                      <?php } ?>
                  </select>
                  <label for="cargo" class="col-form-label">Cargo</label>
                  <select name="cargo" id="cargo" class="form-select form-select-lg mb-3">
                    <option value="">-Seleccione un Cargo-</option>
                      <?php foreach ($cargos as $x => $valor) { ?>
                        <option value="<?php echo $valor['id'] ?>" name="cargo"><?php echo $valor['nombre'] ?></option>
                      <?php } ?>
                  </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Save changes</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>
    </form>
  </div>
  
</div>


