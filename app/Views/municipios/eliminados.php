<head>
  <meta charset="utf-8" />


</head>

<body>

  <div class="card" style="width:72rem;">
    <div>
      <h1 class="titulo_Vista">Municipios Eliminados</h1>
    </div>
    <div class="card-body">

      <div class="row col-sm-12" >
      <div class="col-md-5ths col-lg-5ths col-xs-6 col-sm-5"></div>
      <div class="col-md-5ths col-lg-5ths col-xs-6 col-sm-2">        
        <a href="<?php echo base_url('/municipios'); ?>" class="btn btn-primary regresar_Btn">Regresar</a>
      </div>
      </div>

      <br>
      <div class="table-responsive">
        <table class="table table-bordered table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr style="color:#98040a;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
              <th>Id</th>
              <th>Pais</th>
              <th>Departamento</th>
              <th>Municipio</th>
              <th>Estado</th>
              <th></th>
            </tr>
          </thead>
          <tbody style="font-family:Arial;font-size:12px;">
            <?php foreach ($municipios as $dato) { ?>
              <tr>
                  <td><?php echo $dato ['id'];?></td>
                  <td><?php echo $dato ['nombre_pais'];?></td>
                  <td><?php echo $dato ['nombre_dpto'];?></td>
                  <td><?php echo $dato ['nombre'];?></td>
                  <td><?php echo $dato ['estado'];?></td>

                 <td><button type="button" class="btn btn-secondary"  href="#" data-href="<?php echo base_url('/municipios/eliminar') . '/' .$dato['id']. '/' .'A'; ?>"  data-bs-toggle="modal" data-bs-target="#modal-confirma">Activar</button></td>

              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      
      <!-- Modal Confirma Eliminar -->
      <div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div style="background: linear-gradient(90deg, #838da0, #b4c1d9);" class="modal-content">
                <div style="text-align:center;" class="modal-header">
                    <h5 style="color:#98040a;font-size:20px;font-weight:bold;" class="modal-title" id="exampleModalLabel">Activación de Registro</h5>
                    
                </div>
                <div style="text-align:center;font-weight:bold;" class="modal-body">
                    <p>Seguro Desea Activar éste Registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary close" data-dismiss="modal">No</button>
                    <a class="btn btn-danger btn-ok">Si</a>
                </div>
            </div>
        </div>
    </div>
       <!-- Modal Elimina -->
    

</body>
<script>
    $('#modal-confirma').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
  
  // function eliminarPaises(id) {     
  //     $("#id").val(id);
  //     dataURL = "<?php echo base_url('elimina_Municipios'); ?>" + "/" + id + "/" + 'A';
  //     $.ajax({
  //       type: "POST",
  //       url: dataURL,
  //       dataType: "json",
  //       success: function(rs) {
  //       },
  //       error: function() {
  //               alert("No se ha Podido Activar El Registro");
  //           }
  //     })

  // };
 
  $('.close').click(function() {$("#modal-confirma").modal("hide");});
</script>