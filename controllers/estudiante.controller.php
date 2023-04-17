<?php

require_once '../models/Estudiante.php';

if(isset($_POST['operacion'])){

  $estudiante = new Estudiante();

  if($_POST['operacion'] == 'registrar'){

    //Paso 1: recolectar todos los valores enviadoes
    //por la vista y almacenarlos en un array asociativo
    $datosGuardar = [
      "apellidos"       => $_POST['apellidos'],
      "nombres"         => $_POST['nombres'],
      "tipodocumento"   => $_POST['tipodocumento'],
      "nrodocumento"    => $_POST['nrodocumento'],
      "fechanacimiento" => $_POST['fechanacimiento'],
      "idcarrera"       => $_POST['idcarrera'],
      "idsede"          => $_POST['idsede'],
      "fotografia"      => ''

    ];
    // Paso 2: Enviar el array al metodo registrar
    $estudiante->registrarEstudiante($datosGuardar);


  }

}