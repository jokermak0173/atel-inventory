<?php

	class Conexion{
		public function conectar(){
			$link = new PDO("mysql:host=189.198.135.118;dbname=mi_atel;charset=utf8", "mi_atel_web", "Pa\$\$MiAtelWeb2019.", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$link->exec("set names utf8");

			return $link;
		}

		// public function conectarLocal(){
		// 	$link = new PDO("mysql:host=localhost;dbname=atel-inventory;charset=utf8", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
		// 	$link->exec("set names utf8");
		//
		// 	return $link;
		// }

		// public function conectarLocal(){
		// 	$link = new PDO("mysql:host=192.5.215.247;dbname=atel_inventory;charset=utf8", "atel-inventory", "s3cr3t0@atel-inventory", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
		// 	$link->exec("set names utf8");
		//
		// 	return $link;
		// }
		public function conectarLocal(){
			$link = new PDO("mysql:host=189.198.135.118;dbname=atel_inventory;charset=utf8", "atel-inventory", "s3cr3t0@atel-inventory", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$link->exec("set names utf8");

			return $link;
		}
	}

?>
