<?php
session_start();
 
if (!isset($_SESSION['login']) || $_SESSION['login'] == false){
  header('Location: ../index.php');
}

?>
<!doctype html>
<html lang="es">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

  <!--- lgiht box css-->
  <link href="../dist/lightbox2/src/css/lightbox.css" rel="stylesheet" />

  <!-- <link href="path/to/lightbox.css" rel="stylesheet" /> -->
  <link rel="stylesheet" href="./css/diseño.css">
</head>

<body class="cuerpo">
  <div class="container mt-3">
              <button type="button" class="btn btn-sm btn-outline-light btn-lg" id="salir">
              <i class="bi bi-arrow-bar-left"></i>
                regresar a Inicio
              </button>
    </div>

  <div class="container mt-3">
    <div class="card">
      <div class="card-header bg-primary text-light">
        <button type="button" class="btn btn-sm btn-primary btn-lg mt-1 mb-1 " data-bs-toggle="modal" data-bs-target="#modal-estudiante">
          Registrar
        </button>
      </div>  
    
    
      <div class="card-body">
        <table id= "tabla-estudiantes"class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Apellidos</th>
              <th>Nombres</th>
              <th>Tipo</th>
              <th>Documento</th>
              <th>Nacimiento</th>
              <th>Carrera</th>
              <th>Operaciones</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
        <div class="card-footer text-end">
            <a href="../controllers/usuario.controller.php?operacion=finalizar">Cerrar sesión</a>
          </div>
      </div>
    </div>
  </div>
  
  <!-- Modal Body -->
  <div class="modal fade" id="modal-estudiante" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary text-light">
          <h5 class="modal-title" id="modalTitleId">Registro de estudiantes</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
          <form action="" autocomplete="off" id="formulario-estudiantes" enctype="multipart/form-data">
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
                <label for="tipodocumento" class="form-label">Tipo documento:</label>
                <select name="tipodocumento" id="tipodocumento" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                  <option value="D">DNI</option>
                  <option value="C">Carnet de Extranjeria</option>
                </select>
              </div>
              <div class="mb-3 col-md-6">
                <label for="nrodocumento" class="form-label">Nro documento:</label>
                <input type="text" class="form-control form-control-sm" id="nrodocumento">
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="fechanacimiento" class="form-label">Fecha nacimiento:</label>
                <input type="date" class="form-control form-control-sm" id="fechanacimiento">
              </div>
              <div class="mb-3 col-md-6">
                <label for="sede" class="form-label">Sede:</label>
                <select name="sede" id="sede" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="escuela" class="form-label">Escuela:</label>
                <select name="escuela" id="escuela" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
              <div class="mb-3 col-md-6">
                <label for="carrera" class="form-label">Carreras:</label>
                <select name="carrera" id="carrera" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
            </div>

            <div class="mb-3">
              <label for="fotografia">Fotografía:</label>
              <input type="file" id="fotografia" accept=".jpg" class="form-control form-control-sm">
            </div>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-sm btn-primary" id="guardar-estudiante">Guardar</button>
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
  
  <!-- scrip light box-->

  <script src="../dist/lightbox2/src/js/lightbox.js"></script>


  <script>
    $(document).ready(function (){

      function mostrarEstudiantes(){
        $.ajax({
          url: '../controllers/estudiante.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success:function(result){
            $("#tabla-estudiantes tbody").html(result);

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

      function obtenerEscuelas(){
        $.ajax({
          url: '../controllers/escuela.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function (result){
            $("#escuela").html(result);
          }
        });
      }

      function registrarEstudiante(){
        
        //Enviaremos los datos dentro de un objeto
        var formData = new FormData();

        formData.append("operacion", "registrar");
        formData.append("apellidos",$('#apellidos').val());
        formData.append("nombres",$('#nombres').val());
        formData.append("tipodocumento",$("#tipodocumento").val());
        formData.append("nrodocumento",$("#nrodocumento").val());
        formData.append("fechanacimiento",$("#fechanacimiento").val());
        formData.append("idcarrera",$("#carrera").val());
        formData.append("idsede",$("#sede").val());
        formData.append("fotografia",$("#fotografia")[0].files[0]);

       





        $.ajax({
          url: '../controllers/estudiante.controller.php',
          type: 'POST',
          data: formData,
          contentType:false,
          processData: false,
          cache: false,
          success: function(){
            $("#formulario-estudiantes")[0].reset();
            $("#modal-estudiante").modal("hide");
            mostrarEstudiantes();
          }
        });
      }

      function preguntarRegistro(){
        Swal.fire({
          icon: 'question',
          title: 'Matrículas',
          text: '¿Está seguro de registrar al estudiante?',
          footer: 'Desarrollado con PHP',
          confirmButtonText: 'Aceptar',
          confirmButtonColor: '#3498DB',
          showCancelButton: true,
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          //Identificando acción del usuario
          if (result.isConfirmed){
            registrarEstudiante();
          }
        });
      }

      function eliminarEstudiante(idEstudiante){
        $.ajax
          ({
              url: '../controllers/estudiante.controller.php',
              type: 'POST',
              data: 
              {
                operacion   : 'eliminar',
                idestudiante     : idEstudiante
              },
              success: function(result){
                mostrarEstudiantes();         
              }
          });
      }
      $("#tabla-estudiantes").on("click", ".eliminar", function (){
        const idEstudiante = $(this).data("idestudiante");
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          title: 'Estas seguro?',
          text: "No podrás revertir esto!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Sí, elimínalo!',
          cancelButtonText: 'No, cancelar!',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            eliminarEstudiante(idEstudiante);
            swalWithBootstrapButtons.fire(
              'ELIMINADO!',
              'Estudiante Eliminado',
              'success'
              
            )
            
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'CANCELADO',
              'Regstro sin cambios',
              'error'
            )
          }
        })
      });


      $("#guardar-estudiante").click(preguntarRegistro);

      $("#salir").click(function(){
        window.location.href = "./inicio.php";
        });

      //Al cambiar una escuela, se actualizará las carreras
      $("#escuela").change(function (){
        const idescuelaFiltro = $(this).val();

        $.ajax({
          url: '../controllers/carrera.controller.php',
          type: 'POST',
          data: {
            operacion     : 'listar',
            idescuela     : idescuelaFiltro
          },
          dataType: 'text',
          success: function(result){
            $("#carrera").html(result);
          }
        });
      });

      //Predeterminamos un control dentro del modal
      $("#modal-estudiante").on("shown.bs.modal", event => {
        $("#apellidos").focus();

        obtenerSedes();
        obtenerEscuelas();
        
      });
      mostrarEstudiantes();


    });
  </script>

</body>

</html>