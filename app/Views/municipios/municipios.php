<div class="container card my-4">
    <div>
        <h1 class="titulo_Vista text-center"><?php echo $titulo?></h1>
    </div>
    <div>
        <button type="button" class="btn btn-success" onclick="seleccionaPais(<?php echo 1 . ',' . 1 ?>);" data-bs-toggle="modal" data-bs-target="#MuniModal">Agregar</button>
        <button type="button" class="btn btn-secondary">Eliminados</button>
        <a href="<?php echo base_url('/principal'); ?>" class="btn btn-primary regresar_Btn">Regresar</a>
    </div>

    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-sm table-striped" id="tablePaises" width="100%" cellspacing="0">
            <thead>
                <tr style="color:#98040a;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Departamento</th>
                    <th>Estado</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody style="font-family:Arial;font-size:12px;">
                <?php foreach ($datos as $x => $valor) { ?>
                        <tr>
                            <th class="text-center"><?php echo $valor['id']; ?></th>
                            <th class="text-center"><?php echo $valor['nombre']; ?></th>
                            <th class="text-center"><?php echo $valor['Departamento']; ?></th>
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

    <form method="POST" action="<?php echo base_url('/paises/insertar'); ?>" autocomplete="off" class="needs-validation" novalidate>
      <div class="modal fade" id="MuniModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="tituloModal">Añadir Pais</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
              <label for="nombre" class="col-form-label">Pais:</label>
            <select name="pais" id="pais" class="form-select form-select-lg mb-3">
                <option value="">-Seleccione un País-</option>
                <?php foreach ($paises as $x => $valor) { ?>
                <option value="<?php echo $valor['id'] ?>" name="pais"><?php echo $valor['nombre'] ?></option>
                <?php } ?>
            </select>
            <label for="nombre" class="col-form-label">Departamento:</label>
            <select name="pais" id="pais" class="form-select form-select-lg mb-3">
                <option value="">-Seleccione un Departamento-</option>

            </select>
                <label for="nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
                <label for="codigo" class="col-form-label">Codigo:</label>
                <input type="text" class="form-control" pattern="[0-9]{4}" name="codigo" id="codigo">
                <input type="text" id="tp" name="tp" hidden>
                <input type="text" id="id" name="id" hidden>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="btn_Guardar">Guardar</button>
            </div>
          </div>
        </div>
      </div> 
    </form>

</div>