<?php
include('../../ajax/validarSesion.php');

$response =  array();
	if(isset($_GET["id"])){
		$id_subaplicativo = $_GET["id"];
		include "mysqlconnection.php";

			$query = "SELECT servicios.*
                FROM subaplicativos_servicios, servicios
                WHERE subaplicativos_servicios.ID_SERVICIO = servicios.ID
                AND subaplicativos_servicios.ID_SUBAPLICATIVO = ".$id_subaplicativo;


			$result = $mysqli->query($query);

			while ($fila = $result->fetch_assoc()) {
        $response[] = array(
          "ID" =>utf8_encode($fila["ID"]),
          "NOMBRE" =>utf8_encode ($fila["NOMBRE"]),
          "DESCRIPCION" =>utf8_encode ($fila["DESCRIPCION"]),
          "CANAL" =>utf8_encode ($fila["CANAL"]),
					"TRIPLETA" =>utf8_encode ($fila["TRIPLETA"]),
          "GESTOR" =>utf8_encode (getName($fila["GESTOR"]))
        );
			}


	}else{
			$id_subaplicativo = $_GET["id_subaplicativo"];
		include "mysqlconnection.php";

		//Extraer información del proceso
		$query = "SELECT * FROM banco.servicios WHERE ID not in (SELECT ID_SERVICIO FROM banco.subaplicativos_servicios WHERE ID_SUBAPLICATIVO = $id_subaplicativo)";
		$result = $mysqli->query($query);

		while ($fila = $result->fetch_assoc()) {
			//escribir("ldap", $fila["ID"]." ".getName($fila["AFA"]). " ".getName($fila["RA"]));
			    $response[] = array(
			    	"ID" =>utf8_encode($fila["ID"]),
			    	"NOMBRE" =>utf8_encode ($fila["NOMBRE"]),
			    	"DESCRIPCION" =>utf8_encode ($fila["DESCRIPCION"]),
			    	"CANAL" =>utf8_encode ($fila["CANAL"]),
						"TRIPLETA" =>utf8_encode ($fila["TRIPLETA"]),
			    	"GESTOR" =>utf8_encode (getName($fila["GESTOR"]))
          );
			}
		//echo var_dump($response);
	}

	header('Content-type: application/json');
	echo json_encode($response);
 ?>
