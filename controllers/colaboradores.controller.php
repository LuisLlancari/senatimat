<?php

require_once '../models/Colaboradores.php';


if(isset($_POST['operacion'])){

  $colaborador = new Colaboradores();


  if($_POST['operacion'] == 'listar'){

    $datosObtenidos = $colaborador->listarColaboradores();

    if($datosObtenidos){
      $Nfilas = 1;
      
      foreach($datosObtenidos as $registros){
        echo
        "
        <tr>
            <td>{$Nfilas}</td>
            <td>{$registros['apellidos']}</td>
            <td>{$registros['nombres']}</td>
            <td>{$registros['telefono']}</td>
            <td>{$registros['cargo']}</td>
            <td>{$registros['sede']}</td>
            <td>{$registros['tipocontrato']}</td>
            <td>{$registros['direccion']}</td>
            <td>
              <a href='#' data-idcurso='{$registros['idcolaborador']}' class='btn btn-danger btn-sm eliminar'><i class='bi bi-trash3'></i></a>
              <a href='#' data-idcurso='{$registros['idcolaborador']}' class='btn btn-info btn-sm editar'><i class='bi bi-pencil-fill'></i></a>
              
            </td>
          </tr>
        ";
        $Nfilas++;
      }
    }

  }


  if($_POST['operacion'] == 'registrar'){

    $datoGuardar = [
      "apellidos"     =>$_POST['apellidos'],
      "nombres"       =>$_POST['nombres'],
      "telefono"      =>$_POST['telefono'],
      "idcargo"       =>$_POST['idcargo'],
      "idsede"        =>$_POST['idsede'],
      "tipocontrato"  =>$_POST['tipocontrato'],
      "direccion"     =>$_POST['direccion'],
      "cv"            => ''
    ];


    if(isset($_FILES['cv'])){
      $rutaDestino = '../views/document/pdf/';
      $fechaActual=date('c'); // c = complete, ano/mes/dia/hora/minuto/segundo
      $nombreArchivo = sha1($fechaActual) . ".pdf";
      $rutaDestino .= $nombreArchivo;

      //Guardamos la fotografia en el servidor
      if(move_uploaded_file($_FILES['cv']['tmp_name'], $rutaDestino)){
        $datosGuardar['cv'] = $nombreArchivo;
      }
    }

    $colaborador->registrarColaboradores($datoGuardar);
  }








}