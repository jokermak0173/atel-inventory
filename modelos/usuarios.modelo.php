<?php

	require_once "conexion.php";

	class ModeloUsuarios{
		/*========================================
		=            MOSTRAR USUARIOS            =
		========================================*/
		static public function mdlMostrarUsuarios($tabla, $item, $valor){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
			$stmt->close();
			$stmt = null;
		}

		static public function mdlMostrarUsuariosActivos($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :valor1 AND $item2 = :valor2 AND $item3 = :valor3");
			$stmt -> bindParam(":valor1", $valor1, PDO::PARAM_INT);
			$stmt -> bindParam(":valor2", $valor2, PDO::PARAM_INT);
			$stmt -> bindParam(":valor3", $valor3, PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt -> fetchaLL();
			$stmt->close();
			$stmt = null;
		}
}
