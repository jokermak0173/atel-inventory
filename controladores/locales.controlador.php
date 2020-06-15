<?php

class ControladorLocales{
  public function ctrMostrarLocales($item, $valor){
    $tabla = "locales";
    $locales = ModeloLocales::mdlMostrarLocales($tabla, $item, $valor);
    return $locales;
  }

  public function ctrMostrarLocal($item, $valor){
    $tabla = "locales";
    $locales = ModeloLocales::mdlMostrarLocal($tabla, $item, $valor);
    return $locales;
  }
}

?>
