<?php

class ControladorComponentes{
  static public function ctrMostrarComponentes($item, $valor){
    $tabla = "componente";
    $componentes = ModeloComponentes::mdlMostrarComponentes($tabla, $item, $valor);
    return $componentes;
  }
}

?>
