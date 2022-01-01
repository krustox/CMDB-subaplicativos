<?php
include('../../ajax/validarSesion.php');

$response =  array();
	if(isset($_GET["id"])){
		$id_canal = $_GET["id"];
		include "mysqlconnection.php";

			$query = "SELECT canal.*
                FROM subaplicativos_canal, canal
                WHERE subaplicativos_canal.ID_CANAL = canal.ID
                AND subaplicativos_canal.ID_SUBAPLICATIVO = ".$id_canal;


			$result = $mysqli->query($query);

			while ($fila = $result->fetch_assoc()) {
        $response[] = array(
          "ID" =>utf8_encode($fila["ID"]),
          "NOMBRE" =>utf8_encode ($fila["NOMBRE"])
        );
			}


	}else{
			$id_subaplicativo = $_GET["id_subaplicativo"];
		include "mysqlconnection.php";

		//Extraer información del proceso
		$query = "SELECT * FROM banco.canal WHERE ID not in (SELECT ID_CANAL FROM banco.subaplicativos_canal WHERE ID_SUBAPLICATIVO = $id_subaplicativo)";
		$result = $mysqli->query($query);

		while ($fila = $result->fetch_assoc()) {
			//escribir("ldap", $fila["ID"]." ".getName($fila["AFA"]). " ".getName($fila["RA"]));
			    $response[] = array(
			    	"ID" =>utf8_encode($fila["ID"]),
			    	"NOMBRE" =>utf8_encode ($fila["NOMBRE"])
          );
			}
		//echo var_dump($response);
	}

	header('Content-type: application/json');
	echo json_encode($response);
 ?>
