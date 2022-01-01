<?php

include('../../ajax/validarSesion.php');


	$response =  array();

	$query = "UPDATE subaplicativos SET AFA_FIN = 1 ";

	if(isset($_GET["id_sub"]) && isset($_GET["id_app"])){
		$id_app = $_GET["id_app"];
		$id_sub = $_GET["id_sub"];

		$query .= " WHERE ID_APLICATIVO = ".$id_app." AND ID = '".$id_sub."' AND AFA_FIN = 0";
		include "mysqlconnection.php";
		$result = $mysqli->query($query);

    if($result){
  		escribir("Finalizado", "OK " . $_SESSION["nombre"]." ". $_SESSION["ip"] . "  ".$query);
  		echo "Se Cambio el estado del subaplicativo con ID:".$id_sub;
  	}else{
  		escribir("Finalizado", "ERROR " . $_SESSION["nombre"]." ". $_SESSION["ip"] . "  ".$query);
  		echo "No se pudo Cambiar el estado del subaplicativo con ID:".$id_sub;
  	}
  }
 ?>
