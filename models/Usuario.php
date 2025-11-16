<?php 

require_once "Pessoas.php";

class Usuarios extends Pessoas
{ 
  private string $tipo;

  public function getTipo()
  {
    return $this->tipo;
  }

  public function setTipo($tipo)
  {
    $this->tipo = $tipo;
  }
}