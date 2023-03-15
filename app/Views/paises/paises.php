
<div class="container card my-4">
    <div>
        <h1 class="titulo_Vista text-center"><?php echo $titulo?></h1>
    </div>
    <div>
        <button type="button" onclick="seleccionaPais(<?php echo 1 . ',' . 1 ?>);" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#PaisModal">Agregar</button>
        <a href="<?php echo base_url('/paises/eliminados'); ?>"><button type="button" class="btn btn-secondary">Eliminados</button></a>
        <a href="<?php echo base_url('/principal'); ?>" class="btn btn-primary regresar_Btn">Regresar</a>
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
                             
                            <button class="btn btn-outline-primary" onclick="seleccionaPais(<?php echo $valor['id'] . ',' . 2 ?>);" data-bs-toggle="modal" data-bs-target="#PaisModal" >
                            
                              <i class="bi bi-pencil"></i>
                                                      
                            </button>
                            
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#PaisModalElimiar" onclick="EliminarValid(<?php echo $valor['id']?>);"><i class="bi bi-trash3"></i></button>
                            </th>
                            
                        </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <form method="POST" action="<?php echo base_url('/paises/insertar'); ?>" autocomplete="off" class="needs-validation" novalidate>
      <div class="modal fade" id="PaisModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="tituloModal">Añadir Pais</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
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

<!-- MODAL ELIMINAR PAIS -->
<form method="PUT" action="<?php echo base_url('/paises/cambiarEstado/'); ?><?php echo $valor['id'];?>" class="form-check-inline">
<div class="modal fade" id="PaisModalElimiar" tabindex="-1" aria-labelledby="PaisModalElimiar" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">¿Estás seguro de eliminar este pais?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span><h3 class="text-center" id="PaisEliminar"></h3></span>
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


<script>
  function seleccionaPais(id, tp) {
    if (tp == 2) {
      dataURL = "<?php echo base_url('/paises/buscar_Pais'); ?>" + "/" + id;
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {        
          $("#tp").val(2);  
          $("#id").val(rs[0]['id'])  
          $("#codigo").val(rs[0]['codigo']);
          $("#nombre").val(rs[0]['nombre']);
          $("#btn_Guardar").text('Actualizar');
          $("#tituloModal").text('Actualizar el país ' + rs[0]['nombre']);
          $("#PaisModal").modal("show");
        }
      })
    }else{
      $("#tp").val(1);
          $("#id").val('');
          $("#codigo").val('');
          $("#nombre").val('');
          $("#btn_Guardar").text('Guardar');
           $("#tituloModal").text('Agregar Nuevo País');
          $("#PaisModal").modal("show");
    }
  };

  function EliminarValid(id){
 dataURL = "<?php echo base_url('/paises/buscar_Pais'); ?>" + "/" + id;
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {        
          $("#id").val(rs[0]['id'])  
          $("#PaisEliminar").text(rs[0]['nombre']);
          $("#PaisModalElimiar").modal("show");
        }
      })
  }
</script>