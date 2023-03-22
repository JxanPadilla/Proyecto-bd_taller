<head>
  <link rel="stylesheet" href="<?php echo base_url('/css/vistas.css'); ?>">

</head>

<body>
  <h1 class="titulo"><?php echo "Administrar Empleados"; ?></h1>

  <div>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AgregarEmpleados" onclick="seleccionaEmpleado(<?php echo 1 . ',' . 1 ?>);">Agregar</button>
    <a href="<?php echo base_url('eliminados_empleados'); ?>" class="btn btn-secondary regresar_Btn">Eliminados</a>
    <a href="<?php echo base_url('/principal'); ?>" class="btn btn-primary regresar_btn">Regresar</a>

  </div>
  <div class="table-responsive">
    <table class="table table-bordered table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr style="color:#342C6E;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
          <th>Id</th>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>Pais</th>
          <th>Departmanto</th>
          <th>Municipio</th>
          <th>Nacimiento</th>
          <th>Cargo</th>
          <th>Salario</th>
          <th>Estado</th>
          <th colspan="2">Acciones</th>
        </tr>
      </thead>
      <tbody style="font-family:Arial;font-size:12px;">
        <?php foreach ($empleados as $dato) { ?>
          <input id="id_salario" name="id_salario" value="<?php echo $dato['id_salario']; ?>" hidden></>
          <tr>
            <td><?php echo $dato['id']; ?></td>
            <td><?php echo $dato['nombres']; ?></td>
            <td><?php echo $dato['apellidos']; ?></td>
            <td><?php echo $dato['nombrePais']; ?></td>
            <td><?php echo $dato['nombre_dpto']; ?></td>
            <td><?php echo $dato['nombreMuni']; ?></td>
            <td><?php echo $dato['nacimiento']; ?></td>
            <td><?php echo $dato['nombreCargo']; ?></td>
            <td><?php echo $dato['salario']; ?></td>
            <td><?php echo $dato['estado']; ?></td>
            <td><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AgregarEmpleados" onclick="seleccionaEmpleado(<?php echo $dato['id'] . ',' . 2 ?>);">editar</button>
              <button type="button" class="btn btn-secondary" href="#" data-href="<?php echo base_url('/empleados/eliminar') . '/' . $dato['id'] . '/' . 'E'; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma">Eliminar</button>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <!-- Modal -->
  <form method="POST" action="<?php echo base_url('empleados/insertar'); ?> " autocomplete="off">

    <div class="modal fade" id="AgregarEmpleados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="titulo">Agregar Empleado</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" id="message-text">
                <input hidden id="sal" name="sal"></>
                <input hidden id="tp" name="tp"></>
                <input hidden id="id" name="id"></>
              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Apellido:</label>
                <input type="text" name="apellido" id="apellido" class="form-control" id="message-text">
              </div>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Pais :</label>
                <select name="paiselect"  id="paiselect" class="form-select">
                  <option id="pais">Seleccionar Pais</option>
                  <?php foreach ($paises as $dato) { ?>
                    <option value="<?php echo $dato['id']; ?>"><?php echo $dato['nombres']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Departamento:</label>
                <select name="dptoselect" id="dptoselect" class="form-select">
                  <option selected id='dpto'>Seleccionar Departamento</option>
                  <?php foreach ($departamentos as $dato) { ?>
                    <option value="<?php echo $dato['id']; ?>"><?php echo $dato['nombre']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Municipio:</label>
                <select name="muni" id="muni" class="form-select">
                  <option selected>Seleccionar Municipio</option>
                  <?php foreach ($municipios as $dato) { ?>
                    <option value="<?php echo $dato['id']; ?>"><?php echo $dato['nombre']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Año:</label>
                <select class="form-select" name="nacimiento" id="nacimiento">
                  <option selected>Seleccionar Año</option>
                  <?php $years = range(strftime("%Y", time()), 1940); ?>
                  <?php foreach ($years as $year) : ?>
                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Cargo:</label>
                <select name="cargo" id="cargo" class="form-select">
                  <option selected>Seleccionar Cargo</option>
                  <?php foreach ($cargos as $dato) { ?>
                    <option value="<?php echo $dato['id']; ?>"><?php echo $dato['nombre']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Salario:</label>
                <input type="number" name="salario" id="salario" class="form-control" id="message-text">
              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Periodo:</label>
                <input type="text" name="periodo" id="periodo" class="form-control" id="message-text">
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
     $('#paiselect').on('change', () => {
    pais = $('#paiselect').val()
    $.ajax({
      url: "<?php echo base_url('/empleados/buscar_dptoPais'); ?>" + "/" + pais,
      type: 'POST',
      dataType: 'json',
      success: function(res) {
        var obtener 
        obtener = `<option selected>Seleccionar Departamento</option>`
        for (let i=0; i < res.length; i++) {
          obtener += `<option value='${res[i].id}'>${res[i].nombre}</option>`
        }
        obtener += `</select>`
        $('#dptoselect').html(obtener)
      }
    })
  })

     $('#dptoselect').on('change', () => {
       departamento = $('#dptoselect').val()
       $.ajax({
         url: "<?php echo base_url('/empleados/buscar_paisMuni'); ?>" + "/" + departamento,
         type: 'POST',
         dataType: 'json',
         success: function(res) {
           var obtenerm
           obtenerm = `<option selected>Seleccionar Municipio</option>`
           for (let i = 0; i < res.length; i++) {
             obtenerm += `<option value='${res[i].id}'>${res[i].nombre}</option>`
           }
           obtenerm += `</select>`
           $('#muni').html(obtenerm)
         }
       })
     })



    function seleccionaEmpleado(id, tp) {

      if (tp == 2) {

        dataURL = "<?php echo base_url('/empleados/buscar_Empleados'); ?>" + "/" + id;
        $.ajax({
          type: "POST",
          url: dataURL,
          dataType: "json",
          success: function(rs) {
            $("#tp").val(2);
            $("#id").val(id);
            $("#sal").val(rs[0]['id_salario']);
            $("#nombre").val(rs[0]['nombres']);
            $("#apellido").val(rs[0]['apellidos']);
            $("#paiselect").val(rs[0]['id_Pais']);
            $("#dptoselect").val(rs[0]['id_dpto']);
            $("#muni").val(rs[0]['id_municipio']);
            $("#nacimiento").val(rs[0]['nacimiento']);
            $("#salario").val(rs[0]['salario']);
            $("#periodo").val(rs[0]['periodo']);
            $("#cargo").val(rs[0]['id_cargo']);
            $("#btn_Guardar").text('Actualizar');
            $("#titulo").text('Editar Empleado');
            $("#AgregarEmpleados").modal("show");
          }
        })
      } else {
        $("#tp").val(1);
        $("#nombre").val('');
        $("#apellido").val('');
        $("#nacimiento").val('');
        $("#paiselect").val('Seleccionar Pais');
        $("#dptoselect").val('Seleccionar Departamento');
        $("#muni").val('Seleccionar Municipio');
        $("#cargo").val('Seleccionar Cargo');
        $("#salario").val('');
        $("#periodo").val('');
        $("#btn_Guardar").text('Guardar');
        $("#titulo").text('Agregar Empleado');
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
          <button type="button" class="btn btn-primary close" data-bs-dismiss="modal">No</button>
          <a class="btn btn-danger btn-ok">Si</a>
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