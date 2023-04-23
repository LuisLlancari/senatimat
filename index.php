<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login']==true){
  header('Location: ./views/inicio.php');
}


?>

<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  
  <link rel="stylesheet" href="./views/css/diseño.css">
</head>

<body class="cuerpo">
 
<div class="container">
    <div class="row mt-3">
      <div class="col-md-3"></div>
      <div class="col-md-3 mx-auto">
        <!-- Inicio de CARD -->
        <div class="card">
          <div class="card-header bg-primary text-light text-center gri">
            <strong>Inicio de sesión</strong>
          </div>
          <div class="card-body">
            <form action="" autocomplete="off">
              <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" id="usuario" class="form-control form-control-sm" autofocus>
              </div>
              <div class="mb-3">
                <label for="clave" class="form-label">Contraseña:</label>
                <input type="password" id="clave" class="form-control form-control-sm">
              </div>
            </form>
          </div>
          <div class="card-footer text-end gri">
            <div class="row">
              <div class="col">
                <button type="button" id="iniciar-sesion" class="btn btn-sm btn-success">Iniciar sesión</button>
              </div>
              <div class="col">
                <button type="button" id="iniciar-sesion" class="btn btn-sm btn-primary"  data-bs-toggle="modal" data-bs-target="#modal-usuario">Registrarse</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Fin de CARD -->
      </div>
      <div class="col-md-3"></div>
    </div>
  </div>
  <!-- MODALES -->
    <div class="modal" tabindex="-1" id="modal-usuario">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Registrar usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" autocomplete="off" id="formulario-usuario">
                <div class="mb-3">
                  <label for="usuario" class="form-label">Usuario:</label>
                  <input type="text" id="R-usuario" class="form-control form-control-sm" autofocus>
                </div>
                <div class="mb-3">
                  <label for="clave" class="form-label">Contraseña:</label>
                  <input type="password" id="R-clave" class="form-control form-control-sm">
                </div>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="registra-usuario">Registrar</button>
          </div>
        </div>
      </div>
    </div>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
     $(document).ready(function (){
      let idtrabajadoractualizar = -1;


      function iniciarSesion(){
        const Usuario = $("#usuario").val();
        const clave = $("#clave").val();
        
        if (usuario != "" && clave != ""){
          $.ajax({
            url: 'controllers/usuario.controller.php',
            type: 'POST',
            data: {
              operacion     : 'login',
              usuario : Usuario,
              claveIngresada: clave
            },
            dataType: 'JSON',
            success: function (result){
              console.log(result);
              if (result["status"]){
                window.location.href = "views/inicio.php";
              }else{
                alert(result["mensaje"]);
              }
            }
          });
        }
      }

      function alertaRegistro(){
        Swal.fire({
        position: 'top',
        icon: 'success',
        title: 'Usuario registrado con exito',
        showConfirmButton: false,
        timer: 1500
      })
      }

      function registrarUsuario(){
        $.ajax({
            url: 'controllers/usuario.controller.php',
            type: 'POST',
            data: {
            operacion:'registrar',
            idusuario : idtrabajadoractualizar,
            usuario       : $("#R-usuario").val(),
            clave         : $("#R-clave").val()
            
            },
            success: function(result){
              
                $("#formulario-usuario")[0].reset();

                $("#modal-usuario").modal('hide');
                alertaRegistro();
            }
          });
      }

      


      $("#iniciar-sesion").click(iniciarSesion);
      $("#registra-usuario").click(registrarUsuario);
      });
  </script>

</body>

</html>