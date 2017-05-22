<?php
/**
 * Permitir la conexion contra la base de datos
 */
class db
{
  private $host="localhost";
  private $user="root";
  private $pass="";
  private $db_name="usuarios";

  private $conexion;

  private $error=false;

  function __construct()
  {
      $this->conexion = new mysqli($this->host, $this->user, $this->pass, $this->db_name);
      if ($this->conexion->connect_errno) {
        $this->error=true;
      }
  }
  function hayError(){
    return $this->error;
  }
  function conexion(){
	return $this->conexion;
  }
  public function realizarConsulta($consulta){
    if($this->error==false){
      $resultado = $this->conexion->query($consulta);
      return $resultado;
    }else{
      $this->error="Imposible realizar la consulta: ".$consulta;
      return null;
    }
  }
}
?>
