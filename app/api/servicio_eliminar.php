<?php
include('../../ajax/validarSesion.php');

	$id_servicio = $_GET["id_servicio"];
	$id_subaplicativo = $_GET["id_subaplicativo"];

	$query = "DELETE FROM subaplicativos_servicios WHERE ID_SUBAPLICATIVO = '{$id_subaplicativo}' AND ID_SERVICIO = '{$id_servicio}'";

	include "mysqlconnection.php";
	$result = $mysqli->query($query);

	if($result){
		escribir("Servicio_Eliminado", "Eliminado " . $_SESSION["nombre"]." ". $_SESSION["ip"] . "  ".$query);
		echo "Se eliminó el registro seleccionado";
	}else{
		escribir("Servicio_Eliminado", "ERROR " . $_SESSION["nombre"]." ". $_SESSION["ip"] . "  ".$query);
		echo "No se pudo eliminar el registro seleccionado";
	}

 ?>
