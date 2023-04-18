<?php

require_once '../models/Cargo.php';

if (isset($_POST['operacion'])) {

    $cargo = new Cargo();


    if ($_POST['operacion'] == 'listar') {


        $datosObtenidos = $cargo->listarCargos();
        if ($datosObtenidos) {

            echo "<option value='' selected>Seleccione</option>";
            foreach ($datosObtenidos as $registro) {
                echo "<option value='{$registro['idcargo']}'>{$registro['cargo']}</option>";
            }
        } else {
            echo "<option value=''>No encontramos datos</option>";
        }
    }
}
