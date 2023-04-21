<?php

require_once '../models/Colaboradores.php';


if(isset($_POST['operacion'])){

  $colaborador = new Colaboradores();


  if($_POST['operacion'] == 'listar'){

    $datosObtenidos = $colaborador->listarColaboradores();

    if($datosObtenidos){
      $Nfilas = 1;
      $botonNulo = "<a href='#' class='btn btn-outline-danger btn-sm mostrar' title='No Tiene Nada'><i class='bi bi-file-pdf-fill'></i></a>";

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
              <a href='#' data-idcolaborador='{$registros['idcolaborador']}' class='btn btn-danger btn-sm eliminar'><i class='bi bi-trash3'></i></a>";
              // <a href='#' data-idcolaborador='{$registros['idcolaborador']}' class='btn btn-info btn-sm editar'><i class='bi bi-pencil-fill'></i></a>";
              // <a href='#' data-idcurso='{$registros['idcolaborador']}' class='btn btn-outline-danger btn-sm mostrar'><i class='bi bi-file-pdf-fill'></i></a>

              if($registros['cv']==''){
                echo $botonNulo;
              }else{
                echo "<a href='../views/document/pdf/{$registros['cv']}' target='_blank' class='btn btn-danger btn-sm mostrar'><i class='bi bi-file-pdf-fill'></i></a>";
              } 
             echo"  
            </td>
          </tr>
        ";
        $Nfilas++;
      }
    }

  }


  if($_POST['operacion'] == 'registrar'){

    $datosGuardar = [
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

    $colaborador->registrarColaboradores($datosGuardar);
  }


  if($_POST['operacion'] == 'eliminar'){

    $ruta = $colaborador->obtnerCv($_POST['idcolaborador']);
    $registro = $colaborador->eliminarColaboradores($_POST['idcolaborador']);
    $rutafile=  $ruta['cv'];

    if($rutafile!= null){
      unlink("../views/document/pdf/{$rutafile}");
    }
  }

}


