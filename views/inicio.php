<?php
session_start();
 
if (!isset($_SESSION['login']) || $_SESSION['login'] == false){
  header('Location: ../index.php');
}

?>

<!doctype html>
<html lang="es">

<head>
  <title>Inicio</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/diseño.css">
</head>

<body class="cuerpo">
    <div class="container mt-4">
      <div class="row text-center">
        <h1 class="text-light">Inicio</h1>
      </div>
      <div class="row justify-content-center mt-4">
        <div class="col-sm-3 mb-3">
            <div class="card bg-black p-5 card-color" id="c-estudiante">
                <img src="./img/iconos/Estudiante-white.png" class="card-img-top" alt="...">
                <h5 class="card-text text-light text-center mt-3"> Estudiante</h5>
            </div>

        </div>
        <div class="col-sm-3 mb-3">
            <div class="card bg-black p-5 card-color" id="c-colaboradores">
                <img src="./img/iconos/colaborador-white.png" class="card-img-top" alt="...">
                <h5 class="card-text text-light text-center mt-3"> Colaborador</h5>
            </div>
        </div>
      </div>
    </div>
    <div class="col-lg-9 text-end">
        <button type="button" class="btn btn-lg btn-outline-light" id="C-sesion">Cerrar Sesión</button>
    </div>





  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</body>

    <script>
        $(document).ready(function(){
        $("#c-estudiante").click(function(){
        window.location.href = "estudiantes.php";
        });    
        $("#c-colaboradores").click(function(){
        window.location.href = "colaboradores.php";
        });
        $("#C-sesion").click(function(){
        window.location.href = "../controllers/usuario.controller.php?operacion=finalizar";
        });      
    });
    </script>

</html>