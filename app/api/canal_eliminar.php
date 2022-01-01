<?php
include('../../ajax/validarSesion.php');

	$id_canal = $_GET["id_canal"];
	$id_subaplicativo = $_GET["id_subaplicativo"];

	$query = "DELETE FROM subaplicativos_canal WHERE ID_SUBAPLICATIVO = '{$id_subaplicativo}' AND ID_CANAL = '{$id_canal}'";

	include "mysqlconnection.php";
	$result = $mysqli->query($query);

	if($result){
		escribir("Canal_Eliminado", "Eliminado " . $_SESSION["nombre"]." ". $_SESSION["ip"] . "  ".$query);
		echo "Se eliminó el registro seleccionado";
	}else{
		escribir("Canal_Eliminado", "ERROR " . $_SESSION["nombre"]." ". $_SESSION["ip"] . "  ".$query);
		echo "No se pudo eliminar el registro seleccionado";
	}

 ?>
