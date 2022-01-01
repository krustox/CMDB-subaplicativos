<?php

include('../../ajax/validarSesion.php');


	$response =  array();

	if(isset($_GET["id_sub"]) && isset($_GET["ra"])){
		$ra = $_GET["ra"];
		$id_sub = $_GET["id_sub"];

		$query = "UPDATE subaplicativos SET RA = '$ra' WHERE ID = '$id_sub' AND Vigente = 1";
		include "mysqlconnection.php";
		$result = $mysqli->query($query);

    if($result){
  		escribir("RA", "OK " . $_SESSION["nombre"]." ". $_SESSION["ip"] . "  ".$query);
  		echo "Se Cambio el RA del subaplicativo con ID:".$id_sub;
  	}else{
  		escribir("RA", "ERROR " . $_SESSION["nombre"]." ". $_SESSION["ip"] . "  ".$query);
  		echo "No se pudo Cambiar el RA del subaplicativo con ID:".$id_sub;
  	}
  }
 ?>
