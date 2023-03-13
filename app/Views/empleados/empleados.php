<div class="container card my-4">
  <div>
    <h1 class="titulo_vista text-center"><?php echo $titulo; ?></h1>
  </div>
    <div>
          <button type="button" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar</button>
    <button type="button" class="btn btn-danger">Eliminados</button>
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
              <th>Codigo Municipio</th>
              <th>Codigo Cargo</th>
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
                            <th class="text-center"><?php echo $valor['id_municipio']; ?></th>
                            <th class="text-center"><?php echo $valor['id_cargo']; ?></th>
                            <th class="text-center"><?php echo $valor['estado']; ?></th>
                            <th class="grid grid" colspan="2">
                                <button class="btn btn-primary">Editar</button>
                                <button class="btn btn-danger">Eliminar</button>
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
    <form method="POST" action="<?php echo base_url(); ?>/clientes/insertar" autocomplete="off">
      <div class="modal" tabindex="-1" role="dialog" id="modalAgregar">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Agregar CLientes</h4>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                  <label for="idcliente" class="col-form-label">Id Cliente</label>
                  <input type="text" class="form-control" id="idcliente" name="idcliente">
                  <label for="nombrecliente" class="col-form-label">Nombres</label>
                  <input type="text" class="form-control" id="nombrecliente" name="nombrecliente">
                  <label for="apellidocliente" class="col-form-label">Apellidos</label>
                  <input type="text" class="form-control" id="apellidocliente"  name="apellidocliente">
                  <label for="nacimientoCliente" class="col-form-label">Fecha de Nacimiento  </label>
                  <input type="text" class="form-control" id="nacimientoCliente" name="nacimientoCliente">
                  <label for="cargo" class="col-form-label">Cargo</label>
                  <input type="text" class="form-control" id="cargo" name="cargo">
                  <label for="Municipio" class="col-form-label">Municipio</label>
                  <input type="text" class="form-control" id="Municipio" name="Municipio">
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


