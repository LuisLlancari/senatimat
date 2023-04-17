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

    //vamos a verificcar si la vista envio una Fotografia
    if(isset($_FILES['fotografia'])){

      $rutaDestino = '../views/img/fotografias/';
      $fechaActual=date('c'); // c = complete, ano/mes/dia/hora/minuto/segundo
      $nombreArchivo = sha1($fechaActual) . ".jpg";
      $rutaDestino .= $nombreArchivo;

      //Guardamos la fotografia en el servidor
      if(move_uploaded_file($_FILES['fotografia']['tmp_name'], $rutaDestino)){
        $datosGuardar['fotografia'] = $nombreArchivo;
      }

    }

    // Paso 2: Enviar el array al metodo registrar
    $estudiante->registrarEstudiante($datosGuardar);


  }

  if($_POST['operacion'] == 'listar'){

    $datosObtenidos = $estudiante->listarEstudiante();

    if($datosObtenidos){
      $nfilas =1;
      foreach($datosObtenidos as $estudiante){

        echo"
        <tr>
        <td>{$nfilas}</td>
        <td>{$estudiante['apellidos']}</td>
        <td>{$estudiante['nombres']}</td>  
        <td>{$estudiante['tipodocumento']}</td>
        <td>{$estudiante['nrodocumento']}</td>
        <td>{$estudiante['fechanacimiento']}</td>
        <td>{$estudiante['escuela']}</td>
        <td>{$estudiante['carrera']}</td>
        <td>{$estudiante['sede']}</td>
        <td>{$estudiante['fotografia']}</td>
        </tr>
        ";
        $nfilas++;
      }
    }
  }

}