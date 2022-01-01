<?php
include('../../ajax/validarSesion.php');
	$response = array();
	$id_canal = $_GET["id_canal"];
	$id_subaplicativo = $_GET["id_subaplicativo"];

	$query = "INSERT INTO subaplicativos_canal VALUES ('{$id_subaplicativo}','{$id_canal}');";

	include "mysqlconnection.php";
	$result = $mysqli->query($query);

	if($result){
		escribir("Canal", "Agregado " . $_SESSION["nombre"]." ". $_SESSION["ip"] . "  ".$query);
		$response["status"] = "ok";
		echo "Canal Agregado";
	}else{
		escribir("Canal", "Error " . $_SESSION["nombre"]." ". $_SESSION["ip"] . " ".$query);
		$response["status"] = "error";
		echo "Canal no Agregado";
	}

 ?>
