<?php
require "../controladores/usuarios.controlador.php";
require "../modelos/usuarios.modelo.php";

require "../modelos/plazas.modelo.php";

require "../controladores/solicitudes.controlador.php";
require "../modelos/solicitudes.modelo.php";

class TablaSolicitudes{

	public function mostrarTablaSolicitudes($plaza){

         $item = "plaza";
         $valor = $plaza;
         $asesores = ControladorSolicitudes::ctrMostrarSolicitudesPlaza($item, $valor);


         $datosJson = '{
					  "data": [';
					  for($i = 0; $i < count($asesores); $i++){
							$estado = '';
							if($asesores[$i]["estado"] == "cambiado"){
								$estado = "<button type='button' class='btn btn-success btn-sm'>cambiado</button>";
							}else if($asesores[$i]["estado"] == "enviado"){
								$estado = "<button type='button' class='btn btn-warning btn-sm'>pendiente</button>";
							}else if($asesores[$i]["estado"] == "cancelado"){
								$estado = "<button type='button' class='btn btn-danger btn-sm'>cancelado</button>";
							}else{
								$estado = $asesores[$i]["estado"];
							}

									  	$datosJson.= '[
					      "'.$asesores[$i]["local"].'",
					      "'.$asesores[$i]["posicion"].'",
					      "'.$asesores[$i]["usuario_reporta"].'",
					     	"'.$asesores[$i]["componente"].'",
					      "'.$asesores[$i]["fecha_reporte"].'",
								"'.$asesores[$i]["usuario_atiende"].'",
								"'.$asesores[$i]["fecha_resolucion"].'",
					      "'.$estado.'"';

					     $datosJson.='
					    ],';
					  }
		$datosJson = substr($datosJson, 0, -1);
		$datosJson.= ']
	}';
	echo $datosJson;




	}

	}

if(isset($_GET["idPlaza"])){
	if($_GET["idPlaza"]){
		$mostrarTabla = new TablaSolicitudes();
		$mostrarTabla -> mostrarTablaSolicitudes($_GET["idPlaza"]);
	}


}


?>
