<head>
  <link rel="stylesheet" href="<?php echo base_url('/css/vistas.css'); ?>">

</head>

<body>
  <h1 class="titulo"><?php echo "Administrar Departamentos"; ?></h1>

  <div>
  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AgregarDepartamento" onclick="seleccionaDepartamento(<?php echo 1 . ',' . 1 ?>);">Agregar</button>
  <a href="<?php echo base_url('eliminados_departamentos'); ?>"  class="btn btn-secondary regresar_Btn">Eliminados</a>
    <a href="<?php echo base_url('/principal'); ?>" class="btn btn-primary regresar_btn">Regresar</a>

  </div>
  <div class="table-responsive">
    <table class="table table-bordered table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr style="color:#342C6E;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
          <th>Id</th>
          <th>Pais</th>
          <th>Departamento</th>
          <th>Estados</th>
          <th colspan="2">Acciones</th>
        </tr>
      </thead>
      <tbody style="font-family:Arial;font-size:12px;">
        <?php foreach ($departamentos as $dato) { ?>
          <tr>
            <td><?php echo $dato['id']; ?></td>
            <td><?php echo $dato['nombre_pais']; ?></td>
            <td><?php echo $dato['nombre']; ?></td>
            <td><?php echo $dato['estado']; ?></td>
            <td><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AgregarDeparamento" onclick="seleccionaDepartamento(<?php echo $dato['id'] . ',' . 2 ?>);">editar</button>
            <button type="button" class="btn btn-secondary"  href="#" data-href="<?php echo base_url('/departamentos/eliminar') . '/' .$dato['id']. '/' .'E'; ?>"  data-bs-toggle="modal" data-bs-target="#modal-confirma">Eliminar</button></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

    <!-- Modal -->
    <form method="POST" action="<?php echo base_url('departamentos/insertar'); ?> " autocomplete="off">

<div class="modal fade" id="AgregarDepartamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo" >Agregar Departamento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Pais :</label>
            <select name="pais"  id="pais" class="form-select">
              <option selected>Seleccionar Pais</option>
              <?php foreach ($paises as $dato) { ?>
                <option value="<?php echo $dato['id']; ?>"><?php echo $dato['nombres']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" id="message-text">
            <input hidden  id="tp" name="tp"></>
            <input hidden id="id" name="id"></>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" id="btn_Guardar">Guardar</button>
      </div>
    </div>
  </div>
</div>
</form>

<script>
  function seleccionaDepartamento(id, tp) {
    if (tp == 2) {
      dataURL = "<?php echo base_url('/departamentos/buscar_Departamentos'); ?>" + "/" + id;
      $.ajax({
        type: "POST",
        url: dataURL,
        dataType: "json",
        success: function(rs) {      
          $("#tp").val(2);  
          $("#id").val(id);  
          $("#pais").val(rs[0]['id_pais']);
          $("#nombre").val(rs[0]['nombre']);
          $("#btn_Guardar").text('Actualizar');
          $("#titulo").text('Editar Departamento');
          $("#AgregarDepartamento").modal("show");
        }
      })
    }else {
      $("#tp").val(1);
      $("#nombre").val('');
      $("#btn_Guardar").text('Guardar');
      $("#titulo").text('Agregar Departamento');
         }

  };
</script>

<!-- Modal Confirma Eliminar -->

<div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div style="background: linear-gradient(90deg, #838da0, #b4c1d9);" class="modal-content">
                <div style="text-align:center;" class="modal-header">
                    <h5 style="color:#98040a;font-size:20px;font-weight:bold;" class="modal-title" id="exampleModalLabel">Eliminación de Registro</h5>
                   
                </div>
                <div style="text-align:center;font-weight:bold;" class="modal-body">
                    <p>Seguro Desea Eliminar éste Registro?</p>
                    <!-- <input hidden  id="estado" name="estado"></>
                    <input hidden id="id" name="id"></> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary close" data-bs-dismiss="modal"  >No</button>
                    <a class="btn btn-danger btn-ok" >Si</a>
                </div>
            </div>
        </div>
    </div>

       <!-- Modal Elimina -->

       <script>
           $('#modal-confirma').on('show.bs.modal', function(e) {
             $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
           });
        </script>

</body>