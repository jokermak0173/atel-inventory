<?php

	require_once "../controladores/solicitudes.controlador.php";
	require_once "../modelos/solicitudes.modelo.php";

	require_once "../controladores/componentes.controlador.php";
	require_once "../modelos/componentes.modelo.php";

	require_once "../controladores/usuarios.controlador.php";
	require_once "../modelos/usuarios.modelo.php";

	require_once "../controladores/locales.controlador.php";
	require_once "../modelos/locales.modelo.php";


	class AjaxSolicitudes{



		public $posicion;
		public $estado;
		public $solicitud;
		public $local;
		public $usuario;

		public function ajaxMostrarSolicitudesPosicion(){

			$item1 = "posicion";
			$valor1 = $this->posicion;
			$item2 = "estado";
			$valor2 = $this->estado;
			$respuesta = ControladorSolicitudes::ctrMostrarSolicitudPosicion($item1, $valor1, $item2, $valor2);
			$htmlRespuesta = '<div class="form-group ">
													<b>Posicion: </b> '.$this->posicion.'
												</div>
											';
			if($respuesta){

				foreach ($respuesta as $key => $value) {
					$componente = ControladorComponentes::ctrMostrarComponentes("id", $value["componente"]);
					$fechaReporte = date_create($value["fecha_reporte"]);
					$fechaFormateada = date_format($fechaReporte,"d/m/Y H:i:s");
					$htmlRespuesta.= '<form method="post">
						<hr>
						<input type="hidden" name="idSolicitud" value="'.$value["id"].'" >
						<label class="col-form-label">Fecha cambio: &nbsp;</label> '.$fechaFormateada.'<br>
	          <label class="col-form-label">Solicitud para cambio de: &nbsp;</label> '.$componente["nombre"].'
						<div class="form-group" style="margin-top: 0px; padding: 0px">
	            <label for="message-text" class="col-form-label">Comentario supervisor:</label>
	            <textarea class="form-control" readonly>'.$value["comentario_reporte"].'</textarea>
	          </div>
						<div class="row">
							<div class="col-8">
							<div class="input-group">

								<label for="message-text" style="margin-right: 10px;" class="col-form-label">Se cambio el componente?:</label>
								<select class="form-control" name="confirmarCambio" required>
									<option value="">No</option>
									<option value="si">Si</option>
								</select>

							</div>
							</div>
						</div>
						<div class="col-form-label">
	          <label for="message-text" class="col-form-label">Comentario sistemas:</label>
	          <textarea class="form-control" name="comentarioSistemas"></textarea>
						</div>


	      </div>
	      <div class="input-group">
	        <button type="submit" class="btn btn-success" >Confirmar cambio</button>
					<button data-dismiss="modal" usuario="" idSolicitud="'.$value["id"].'" type="button" class="btn btn-danger btnCancelarSolicitud" style="margin-left: 172px;" >Cancelar solicitud</button>
	      </div>

	      </form>';
				}
			}else{
				$htmlRespuesta.= '<hr>';
				$htmlRespuesta.= '<h6 style="text-align: center;">Sin solicitudes vigentes de cambios</h6>';
			}


			$item1 = "posicion";
			$valor1 = $this->posicion;
			$item2 = "estado";
			$valor2 = "cambiado";
			$respuesta = ControladorSolicitudes::ctrMostrarSolicitudPosicion($item1, $valor1, $item2, $valor2);
			if($respuesta){
				$htmlRespuesta.= '<table class="table table-striped">
														<thead>
															<tr>
																<th scope="col">Fecha</th>
																<th scope="col">Componente</th>
																<th scope="col">Reporta</th>
																<th scope="col">Atiende</th>
															</tr>
														</thead>
														<tbody>
				';
				foreach($respuesta as $key => $value){
					$componente = ControladorComponentes::ctrMostrarComponentes("id", $value["componente"]);
					$fechaReporte = date_create($value["fecha_reporte"]);
					$fechaFormateada = date_format($fechaReporte,"d/m/Y H:i:s");
					$usuarioReporta = ControladorUsuarios::ctrMostrarUsuario("numemp", $value["usuario_reporta"]);
					$usuarioAtiende = ControladorUsuarios::ctrMostrarUsuario("numemp", $value["usuario_atiende"]);

					$htmlRespuesta.= '<tr>
															<td>'.$fechaFormateada.'</td>
															<td>'.$componente["nombre"].'</td>
															<td>'.utf8_decode($usuarioReporta["nombre_completo"]).'</td>
															<td>'.utf8_decode($usuarioAtiende["nombre_completo"]).'</td>
														</tr>
						';
				}
				$htmlRespuesta.= '</tbody></table>';
			}else{
				$htmlRespuesta.= '<hr>';
				$htmlRespuesta.= '<h6 style="text-align: center;">Sin historico de cambios</h6>';
			}

			echo $htmlRespuesta;
		}

		public function ajaxMostrarSolicitudesEnviadas(){

			$item1 = "local";
			$valor1 = $this->local;
			$item2 = "estado";
			$valor2 = $this->estado;
			$respuesta = ControladorSolicitudes::ctrMostrarSolicitudPosicion($item1, $valor1, $item2, $valor2);
			echo json_encode($respuesta);

		}

		public function ajaxCancelarSolicitud(){
			$item1 = "estado";
			$valor1 = "cancelado";
			$item2 = "usuario_atiende";
			$valor2 = $this->usuario;
			$item3 = "id";
			$valor3 = $this->solicitud;
			$respuesta = ControladorSolicitudes::ctrCancelarSolicitud($item1, $valor1, $item2, $valor2, $item3, $valor3);
			echo $respuesta;
		}

		public function ajaxMostrarSolicitud(){
			$item1 = "id";
			$valor1 = $this->solicitud;
			$respuesta = ControladorSolicitudes::ctrMostrarSolicitud($item1, $valor1);
			echo json_encode($respuesta);
		}

	}

	if(isset($_POST["mostrarSolicitud"])){
		$actualizar = new AjaxSolicitudes();
		$actualizar -> solicitud = $_POST["solicitud"];
		$actualizar -> ajaxMostrarSolicitud();
	}


	if(isset($_POST["mostrarSolicitudesEnviadas"])){
		$actualizar = new AjaxSolicitudes();
		$actualizar -> local = $_POST["idLocal"];
		$actualizar -> estado = $_POST["estado"];
		$actualizar -> ajaxMostrarSolicitudesEnviadas();
	}

	if(isset($_POST["mostrarSolicitudes"])){
		$actualizar = new AjaxSolicitudes();
		$actualizar -> posicion = $_POST["posicion"];
		$actualizar -> estado = $_POST["estado"];
		$actualizar -> ajaxMostrarSolicitudesPosicion();
	}

	if(isset($_POST["cancelarSolicitud"])){
		$actualizar = new AjaxSolicitudes();
		$actualizar -> solicitud = $_POST["idSolicitud"];
		$actualizar -> usuario = $_POST["usuario"];
		$actualizar -> ajaxCancelarSolicitud();
	}

?>
