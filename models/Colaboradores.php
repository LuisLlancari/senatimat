<?php

require_once 'Conexion.php';

class Colaboradores extends Conexion{

  private $accesoBD;

  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion();
  }



  public function listarColaboradores(){
    try {
      $consulta= $this->accesoBD->prepare("CALL spu_colaboradores_listar()");
      $consulta->execute();

      return $consulta->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        die($e->getMessage());
    }
  }
  
}