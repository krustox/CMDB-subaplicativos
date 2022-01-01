<?php
include('../../ajax/validarSesion.php');
	$response = array();
	$id_servicio = $_GET["id_servicio"];
	$id_subaplicativo = $_GET["id_subaplicativo"];

	$query = "INSERT INTO subaplicativos_servicios VALUES ('{$id_subaplicativo}','{$id_servicio}');";

	include "mysqlconnection.php";
	$result = $mysqli->query($query);

	if($result){
		escribir("Servicio", "Agregado " . $_SESSION["nombre"]." ". $_SESSION["ip"] . "  ".$query);
		$response["status"] = "ok";
		echo "Servicio Agregado";
	}else{
		escribir("Servicio", "Error " . $_SESSION["nombre"]." ". $_SESSION["ip"] . " ".$query);
		$response["status"] = "error";
		echo "Servicio no Agregado";
	}

 ?>
