<?php

require_once 'Conexion.php';

class Usuario extends Conexion{

  private $accesoBD; //Conexión

  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion();
  }

  public function iniciarSesion($usuario = ""){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_usuarios_login(?)");
      $consulta->execute(array($usuario));
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function registrarusuario($datos=[]){
    try {
      $consulta = $this->accesoBD->prepare("CALL spu_usuarios_registrar(?,?)");
      $consulta->execute(
        array(
          $datos['usuario'],
          $datos['clave']
        )
      );
    } 
    catch (Exception $e){
      die($e->getMessage());
    }
  }
}