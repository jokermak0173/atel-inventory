<?php

class ControladorSolicitudes{

  public function ctrEnviarSolicitud(){

    if(isset($_POST["posicionCambio"]) && isset($_POST["componenteCambio"])){


      $tabla = "solicitud_cambio";
      $item1 = "local";
      $valor1 = $_SESSION["idLocalActual"];
      $item2 = "posicion";
      $valor2 = $_POST["posicionCambio"];
      $item3 = "usuario_reporta";
      $valor3 = $_SESSION["numemp"];
      $item4 = "componente";
      $valor4 = $_POST["componenteCambio"];
      $item5 = "comentario_reporte";
      $valor5 = $_POST["comentarioCambio"];


      $respuesta = ModeloSolicitudes::mdlAgregarSolicitud($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4, $item5, $valor5);

      if($respuesta == "ok"){
            echo '<script>
            swal({
              type: "success",
              title: "¡Se envio la solicitud de cambio!",
              showConfirmbutton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
            }).then(function(result){
              if(result.value){
                window.location = "'.$_SESSION["localActual"].'";
              }
            });

           </script>';
      }else{
        echo '<script>
            swal({
              type: "error",
              title: "Error al publicar aviso Cod. Error: '.$respuesta[2].'",
              showConfirmbutton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
            }).then(function(result){
              if(result.value){
                window.location = "'.$_SESSION["localActual"].'";
              }
            });

           </script>';
      }
    }
  }

  public function ctrCambioComponenteSistemas(){

    if(isset($_POST["posicionCambioSistemas"]) && isset($_POST["componenteCambioSistemas"]) && isset($_POST["motivoCambio"])){

      date_default_timezone_set('America/Mexico_City');
      date("Y-m-d H:i:s");

      $tabla = "solicitud_cambio";
      $item1 = "local";
      $valor1 = $_SESSION["idLocalActual"];
      $item2 = "posicion";
      $valor2 = $_POST["posicionCambioSistemas"];
      $item3 = "usuario_reporta";
      $valor3 = $_SESSION["numemp"];
      $item4 = "motivo_cambio";
      $valor4 = $_POST["motivoCambio"];
      $item5 = "componente";
      $valor5 = $_POST["componenteCambioSistemas"];
      $item6 = "comentario_reporte";
      $valor6 = $_POST["comentarioCambioSistemas"];
      $item7 = "usuario_atiende";
      $valor7 = $_SESSION["numemp"];
      $item8 = "comentario_resolucion";
      $valor8 = $_POST["comentarioCambioSistemas"];
      $item9 = "fecha_resolucion";
      $valor9 = date("Y-m-d H:i:s");


      $respuesta = ModeloSolicitudes::mdlCambioComponenteSistemas($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4, $item5, $valor5, $item6, $valor6, $item7, $valor7, $item8, $valor8, $item9, $valor9);

      if($respuesta == "ok"){
            echo '<script>
            swal({
              type: "success",
              title: "¡Se envio la solicitud de cambio!",
              showConfirmbutton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
            }).then(function(result){
              if(result.value){
                window.location = "'.$_SESSION["localActual"].'";
              }
            });

           </script>';
      }else{
        echo '<script>
            swal({
              type: "error",
              title: "Error al registrar cambio Cod. Error: '.$respuesta[2].'",
              showConfirmbutton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
            }).then(function(result){
              if(result.value){
                window.location = "'.$_SESSION["localActual"].'";
              }
            });

           </script>';
      }
    }
  }


  public function ctrConfirmarCambio(){

    if(isset($_POST["idSolicitud"]) && isset($_POST["confirmarCambio"])){


      $tabla = "solicitud_cambio";

      $item1 = "id";
      $valor1 = $_POST["idSolicitud"];
      $item2 = "usuario_atiende";
      $valor2 = $_SESSION["numemp"];
      $item3 = "comentario_resolucion";
      $valor3 = $_POST["comentarioSistemas"];
      $item4 = "estado";
      $valor4 = 'cambiado';

      $respuesta = ModeloSolicitudes::mdlEditarSolicitud($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);

      if($respuesta == "ok"){
            echo '<script>
            swal({
              type: "success",
              title: "¡Cambio registrado!",
              showConfirmbutton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
            }).then(function(result){
              if(result.value){
                window.location = "'.$_SESSION["localActual"].'";
              }
            });

           </script>';
      }else{
        echo '<script>
            swal({
              type: "error",
              title: "Error al registrar el cambio. Error: '.$respuesta[2].'",
              showConfirmbutton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
            }).then(function(result){
              if(result.value){
                window.location = "'.$_SESSION["localActual"].'";
              }
            });

           </script>';
      }
    }
  }

  public function ctrMostrarSolicitudesEnviadas($item1, $valor1, $item2, $valor2){
    $tabla = "solicitud_cambio";
    $solicitudes = ModeloSolicitudes::mdlMostrarSolicitudesEnviadas($tabla, $item1, $valor1, $item2, $valor2);
    return $solicitudes;
  }

  public function ctrMostrarSolicitudPosicion($item1, $valor1, $item2, $valor2){
    $tabla = "solicitud_cambio";
    $solicitudes = ModeloSolicitudes::mdlMostrarSolicitudPosicion($tabla, $item1, $valor1, $item2, $valor2);
    return $solicitudes;
  }

  public function ctrMostrarSolicitudesPlaza($item, $valor){
    $solicitudes = ModeloSolicitudes::mdlMostrarSolicitudesPlaza($item, $valor);
    return $solicitudes;
  }

  public function ctrMostrarSolicitud($item, $valor){
    $tabla = "solicitud_cambio";
    $solicitudes = ModeloSolicitudes::mdlMostrarSolicitud($tabla, $item, $valor);
    return $solicitudes;
  }

  public function ctrCancelarSolicitud($item1, $valor1, $item2, $valor2, $item3, $valor3){
    $tabla = "solicitud_cambio";
    $solicitudes = ModeloSolicitudes::mdlCancelarSolicitud($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3);
    return $solicitudes;
  }

  static public function ctrDescargarReporte(){

			if(isset($_POST["fechaInicio"]) && isset($_POST["fechaFin"])){

				$fecha1 = $_POST["fechaInicio"];
				$fecha2 = $_POST["fechaFin"];

				$fecha = date('Y-m-d H:i:s');
				$respuesta = ModeloSolicitudes::mdlMostrarSolicitudesPorFechas($fecha1, $fecha2, $_SESSION["idPlaza"]);

				$fechaRecuperacion = date('__Y_m_d__H_i_s');

				$nombreArchivo = "vistas/archivos/reportes/Reporte del ".$_POST["fechaInicio"]. " al ". $_POST["fechaFin"].$fechaRecuperacion."__".$_SESSION["numemp"].".csv";

				$archivoReporte = fopen($nombreArchivo, "w");

				fwrite($archivoReporte, "Fecha_reporte, Local, Posicion, Usuario_reporta, Componente, Comentario_reporte, Usuario_atiende, Motivo_cambio, Fecha_resolucion, Comentario_resolucion, Estado".PHP_EOL);

				foreach ($respuesta as $key => $value) {
        $pos = $value["posicion"];
         if($pos < 100 && $pos > 9){
           $pos = "0".$pos;
         }else if($pos < 10){
           $pos = "00".$pos;
         }

					$usuarioReporta = ControladorUsuarios::ctrMostrarUsuario("numemp", $value["usuario_reporta"]);
          $usuarioAtiende = ControladorUsuarios::ctrMostrarUsuario("numemp", $value["usuario_atiende"]);
          $componente = ControladorComponentes::ctrMostrarComponentes("id", $value["componente"]);
          $local = ControladorLocales::ctrMostrarLocal("id", $value["local"]);

					fwrite($archivoReporte, $value["fecha_reporte"].",".$local["nombre_alias"].",".$pos.",".utf8_decode($usuarioReporta["nombre_completo"]).",".$componente["nombre"].",".$value["comentario_reporte"].",".utf8_decode($usuarioAtiende["nombre_completo"]).",".$value["motivo_cambio"].",".$value["fecha_resolucion"].",".$value["comentario_resolucion"].",".$value["estado"].PHP_EOL);
				}

				fclose($archivoReporte);
				echo '<script>window.open("http://192.5.215.248/atel-inventory/'.$nombreArchivo.'")</script>';


			}
}

}


 ?>
