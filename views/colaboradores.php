<!doctype html>
<html lang="es">

<head>
  <title>Colaboradores</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

</head>

<body>

  <div class="container mt-3">
      <div class="card">
        <div class="card-header bg-primary text-light">
          <div class="row">
            <div class="col-md-6">
              <strong>COLABORADORES</strong>
            </div>
            <div class="col-md-6 text-end">
            <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#modal-colaborador">
              Agregar Colaborador
            </button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-sm table-striped " id="tabla-colaborador">
           
            <thead>
              <tr>
                <th>#</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>Telefono</th>
                <th>Cargo</th>
                <th>Sede</th>
                <th>T.contrato</th>
                <th>Direccion</th>
                <th>operaciones</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div> 
    <!-- Formulario -->

    <div class="modal fade" id="modal-colaborador" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary text-light">
          <h5 class="modal-title" id="modalTitleId">Registro de Colaboradores</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
          <form action="" autocomplete="off" id="formulario-colaborador" enctype="multipart/form-data">
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control form-control-sm" id="apellidos">
              </div>
              <div class="mb-3 col-md-6">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" class="form-control form-control-sm" id="nombres">
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="telefono" class="form-label">Telefono:</label>
                <input type="text" class="form-control form-control-sm" id="telefono">
              </div>
              <div class="mb-3 col-md-6">
                <label for="cargo" class="form-label">Cargo:</label>
                <select name="cargo" id="cargo" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
            </div>
            <div class="row">
            <div class="mb-3 col-md-6">
                <label for="sede" class="form-label">Sede:</label>
                <select name="sede" id="sede" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
              <div class="mb-3 col-md-6">
                <label for="tipocontrato" class="form-label">Tipo de contrato:</label>
                <select name="sede" id="tipocontrato" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                  <option value="C">Completo</option>
                  <option value="P">Parcial</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="direccion" class="form-label">Direccion:</label>
                <input type="text" class="form-control form-control-sm" id="direccion">
              </div>

              <div class="mb-3 col-md-6">
                <label for="cv">CV :</label>
                <input type="file" id="cv" accept=".pdf" class="form-control form-control-sm">
              </div>
        
            </div>

          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-sm btn-primary" id="guardar-colaborador">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

    <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function(){
      
      function mostrarColaboradores(){
        $.ajax({
          url: '../controllers/colaboradores.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success:function(result){
            $("#tabla-colaborador tbody").html(result);

          }
        });
      }

      function registrarColaborador(){
        
        //Enviaremos los datos dentro de un objeto
        var formData = new FormData();

        formData.append("operacion", "registrar");
        formData.append("apellidos",$('#apellidos').val());
        formData.append("nombres",$('#nombres').val());
        formData.append("idcargo",$("#cargo").val());
        formData.append("idsede",$("#sede").val());
        formData.append("telefono",$("#telefono").val());
        formData.append("tipocontrato",$("#tipocontrato").val());
        formData.append("direccion",$("#direccion").val());
        formData.append("cv",$("#cv")[0].files[0]);

       





        $.ajax({
          url: '../controllers/colaboradores.controller.php',
          type: 'POST',
          data: formData,
          contentType:false,
          processData: false,
          cache: false,
          success: function(){
            $("#formulario-colaborador")[0].reset();
            $("#modal-colaborador").modal("hide");

            alert("guardado correctamente");
            mostrarColaboradores();
            
          }
        });
      }

      function obtenerSedes(){
        $.ajax({
          url: '../controllers/sede.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function(result){
            $("#sede").html(result);
          }
        });
      }
      
      function obtenerCargo(){
        $.ajax({
          url: '../controllers/cargo.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function(result){
            $("#cargo").html(result);
          }
        });
      }
      function eliminarCv(idcolaboradorEliminar){}

      

      $("#tabla-colaborador tbody").on("click", ".eliminar", function (){
        const idcolaboradorEliminar =$(this).data("idcolaborador");
        if (confirm("Estas seguro de proceder? ")){ 
          $.ajax({

            url: '../controllers/colaboradores.controller.php',
            type: 'POST',
            data: {
              operacion         :'eliminar',
              idcolaborador     : idcolaboradorEliminar
            },
            success: function(result){
              if (result == ""){
                mostrarColaboradores();
              }}
          });
         }
      });


      $("#guardar-colaborador").click(registrarColaborador);

      
      mostrarColaboradores();
      obtenerSedes();
      obtenerCargo();

    });
  </script>


</body>

</html>