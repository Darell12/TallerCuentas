<div class="container  mt-4 shadow rounded-4">
  <div>
    <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
  </div>
  <div>
    <a href="<?php echo base_url('/ver_empleados'); ?>"><button class="btn btn-outline-primary"><i class="bi bi-arrow-return-left"></i> Regresar</button></a>
  </div>

  <br>
  <div class="table-responsive" style="overflow:scroll-vertical;overflow-y: scroll !important; height: 600px;">
    <table class="table table-bordered table-sm table-hover" id="tablePaises" width="100%" cellspacing="0">
      <thead class="table-dark">
        <tr>
          <th class="text-center">ID</th>
          <th class="text-center">Nombres</th>
          <th class="text-center">Apellidos</th>
          <th class="text-center">Nacimiento</th>
          <th class="text-center">Municipio</th>
          <th class="text-center">Departamento</th>
          <th class="text-center">País</th>
          <th class="text-center">Cargo</th>

          <th class="text-center">Estado</th>
          <th class="text-center" colspan="2">Acciones</th>
        </tr>
      </thead>
      <tbody style="font-family:Arial;font-size:12px;" class="table-group-divider">
        <?php if ($datos == 'vacio') { ?>
          <tr>
            <th class="text-center h1" colspan=11">SIN REGISTROS ELIMINADOS</th>
          </tr>
        <?php } else { ?>
          <?php foreach ($datos as $x => $valor) { ?>
            <tr>
              <th class="text-center"><?php echo $valor['id']; ?></th>
              <th class="text-center"><?php echo $valor['nombres']; ?></th>
              <th class="text-center"><?php echo $valor['apellidos']; ?></th>
              <th class="text-center"><?php echo $valor['nacimiento']; ?></th>
              <th class="text-center">
                <?php echo $valor['NMuni']; ?>
                <?php echo $valor['estadoMuni'] == 'E' ? '<span class="text-danger">  ~ Inactivo</span>' : '<span class="text-success"> ~ Activo </span>'; ?>
              </th>
              <th class="text-center">
                <?php echo $valor['dpto_nombre']; ?>
                <?php echo $valor['estadoDpto'] == 'E' ? '<span class="text-danger">  ~ Inactivo</span>' : '<span class="text-success"> ~ Activo </span>'; ?>
              </th>
              <th class="text-center">
                <?php echo $valor['pais_nombre']; ?>
                <?php echo $valor['estadoPais'] == 'E' ? '<span class="text-danger">  ~ Inactivo</span>' : '<span class="text-success"> ~ Activo </span>'; ?>
              </th>
              <th class="text-center">
                <?php echo $valor['NCargo']; ?>
                <?php echo $valor['estadoCargo'] == 'E' ? '<span class="text-danger">  ~ Inactivo</span>' : '<span class="text-success"> ~ Activo </span>'; ?>
              </th>
              <th class="text-center">
                <?php echo $valor['estado'] = 'A' ?  '<span class="text-success"> Activo </span>' : 'Inactivo'; ?>
              </th>
              <th class="grid grid text-center" colspan="2">
                <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-href="<?php echo base_url('/estado_empleados') . '/' . $valor['id'] . '/' . 'A'; ?>" title="Restaurar"><i class="bi bi-arrow-clockwise"></i></button>
              </th>

            </tr>
          <?php } ?>
        <?php } ?>
      </tbody>
    </table>
  </div>


  <!-- Modal Confirma Eliminar -->
  <div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div style="text-align:center;" class="modal-header">
          <h5 style="color:#98040a;font-size:20px;font-weight:bold;" class="modal-title" id="exampleModalLabel">Restauración de Registro</h5>

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

  function Restaurar(id) {
    dataURL = "<?php echo base_url('/departamentos/buscar_Dpto'); ?>" + "/" + id;
    console.log(id)
    $.ajax({
      type: "POST",
      url: dataURL,
      dataType: "json",
      success: function(rs) {
        $("#idR").val(rs[0]['id'])
        $("#estado").val('A')
        $("#DptoRestaurar").text(rs[0]['nombre']);
        $("#Restaurar").modal("show");
      }
    })
  }

  $('.close').click(function() {
    $("#modal-confirma").modal("hide");
  });
</script>