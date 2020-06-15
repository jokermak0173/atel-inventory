<?php

	class ControladorUsuarios{

		/*==========================================
		=            INGRESO DE USUARIO            =
		==========================================*/

		public function ctrIngresoUsuario(){

			if(isset($_POST["numemp"]) && isset($_POST["ingresoPassword"])){

				if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["numemp"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoPassword"])){

					$tabla = "usuario";
					$item = "numemp";
					$valor = $_POST["numemp"];

					$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

					$tabla = "plaza";
					$item = "id";
					$valor = $respuesta["plaza"];
					$plaza = ModeloPlazas::mdlMostrarPlaza($tabla, $item, $valor);

					$passwordEncriptado = md5($_POST["ingresoPassword"]);

					if($respuesta["numemp"] == $_POST["numemp"] && $respuesta["password"] == $passwordEncriptado){

						if($respuesta["status_usuario"] == 1)
						{
              $_SESSION["nivelAcceso"] = $respuesta["nivel_acceso"];

              if($_SESSION["nivelAcceso"] == 1 || $_SESSION["nivelAcceso"] == 2 || $_SESSION["nivelAcceso"] == 999){
                switch($_SESSION["nivelAcceso"]){
                  case 999: $_SESSION["puesto"] = "Root"; break;
                  case 1: $_SESSION["puesto"] = "Sistemas"; break;
                  case 2: $_SESSION["puesto"] = "Supervisor"; break;
                }
                if($plaza["id"] < 3){

                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["nombreCompleto"] = utf8_decode($respuesta["nombre_completo"]);
                    $_SESSION["nombreCompleto2"] = utf8_decode($respuesta["nombre_completo"]);
                    $_SESSION["nombrePlaza"] = utf8_decode($plaza["nombre"]);
                    $_SESSION["idPlaza"] = $plaza["id"];
                    $_SESSION["numemp"] = $respuesta["numemp"];

    								switch($_SESSION["idPlaza"])
    								{
    							  	case 1: echo '<script>window.location = "sala-a";</script>';
    									case 2: echo '<script>window.location = "e11";</script>';

    								}
                }else {
                    echo '<br><div class="alert alert-warning">Plaza no habilitada</div>';
                }

            }

						}else{
							echo '<br><div class="alert alert-warning">Cuenta deshabilitada</div>';
						}

					}else{
						echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
					}
				}
			}
		}

		static public function ctrMostrarUsuario($item, $valor){

			$tabla = "usuario";
			$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
			return $respuesta;

		}
  }
