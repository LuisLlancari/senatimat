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










}