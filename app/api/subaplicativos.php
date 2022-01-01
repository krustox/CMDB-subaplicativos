<?php

include('../../ajax/validarSesion.php');


	$response =  array();

	$query = "SELECT * FROM subaplicativos";

	if(isset($_GET["id"]) && isset($_GET["afa"])){
		$id_app = $_GET["id"];
		$afa = $_GET["afa"];

		$query .= " WHERE ID_APLICATIVO = ".$id_app." AND AFA = '".$afa."' AND Vigente = 1";
		include "mysqlconnection.php";
		$result = $mysqli->query($query);

		while ($fila = $result->fetch_assoc()) {
			$response[] = array(
				"ID" =>utf8_encode($fila["ID"]),
				"NOMBRE" =>utf8_encode($fila["NOMBRE"]),
				"AFA" =>utf8_encode(getName($fila["AFA"])),
				"RA" =>utf8_encode(getName($fila["RA"])),
				"VIGENTE" =>utf8_encode($fila["Vigente"]),
				"AFA_FIN" =>utf8_encode($fila["AFA_FIN"])
			);
		}
	}

	header('Content-type: application/json');
	echo json_encode($response);
 ?>
