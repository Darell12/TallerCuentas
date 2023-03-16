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
                                <button class="btn btn-outline-primary"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-outline-danger">
                                <i class="bi bi-trash3"></i>
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
                  <div class="mb-3">
                            <label for="periodo" class="col-form-label">Periodo (Salario):</label>
                            <div class="flex ">
                                <select class="form-select" name="nacimiento" aria-label="periodo" id="nacimiento">
                                    <option selected>-- Seleccionar Año --</option>
                                    <?php $years = range(strftime("%Y", time()), 1940); ?>
                                    <?php foreach ($years as $year) : ?>
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
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
                  <div class="mb-3">
                            <label for="message-text" class="col-form-label">Salario:</label>
                            <div class="flex ">
                                <label for="salario">$</label>
                                <input type="number" name="salario" class="form-control" id="salario">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="periodo" class="col-form-label">Periodo (Salario):</label>
                            <div class="flex ">
                                <select class="form-select" name="periodo" aria-label="periodo" id="periodo">
                                    <option selected>-- Seleccionar Año --</option>
                                    <?php $years = range(strftime("%Y", time()), 1940); ?>
                                    <?php foreach ($years as $year) : ?>
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
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


