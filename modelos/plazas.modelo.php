<?php

	require_once "conexion.php";

	class ModeloPlazas{

		static public function mdlMostrarPlaza($tabla, $item, $valor){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":$item", $valor);
			$stmt -> execute();
			return $stmt -> fetch();
			$stmt->close();
			$stmt = null;
		}


	}

?>
