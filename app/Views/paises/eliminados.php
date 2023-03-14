
<div class="container card my-4">
    <div>
        <h1 class="titulo_Vista text-center"><?php echo $titulo?></h1>
    </div>
    <div>
        <a href="<?php echo base_url('/paises'); ?>" class="btn btn-primary regresar_Btn">Regresar</a>
    </div>

    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-sm table-striped" id="tablePaises" width="100%" cellspacing="0">
            <thead>
                <tr style="color:#98040a;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
                    <th>Id</th>
                    <th><abbr title="Codigo Telefonico">Codigo</abbr></th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody style="font-family:Arial;font-size:12px;" class="table-group-divider">
                <?php foreach ($datos as $x => $valor) { ?>
                        <tr>
                            <th class="text-center"><?php echo $valor['id']; ?></th>
                            <th class="text-center">+<?php echo $valor['codigo']; ?></th>
                            <th class="text-center"><?php echo $valor['nombre']; ?></th>
                            <th class="text-center"><?php echo $valor['estado']; ?></th>
                            <th class="grid grid text-center" colspan="2">
                            <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#PaisRestaurar"><i class="bi bi-arrow-clockwise"></i></button>
                            </th>
                            
                        </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

    <form method="PUT" action="<?php echo base_url('/paises/cambiarEstado/'); ?><?php echo $valor['id'];?>" class="form-check-inline">
<div class="modal fade" id="PaisModalElimiar" tabindex="-1" aria-labelledby="PaisModalElimiar" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">¿Estás seguro de eliminar este pais?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span><h3 class="text-center"><?php echo $valor['nombre'];?></h3></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div> 
</form>

</div>
