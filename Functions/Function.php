<?php

//Obtener IP del cliente
function getRealIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			return $_SERVER['HTTP_CLIENT_IP'];
		}
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		return $_SERVER['REMOTE_ADDR'];
}

//Obtener nombre del LDAP
function getName($user){
	if ($user != "ABEST" ){

		$usuario = Trim($user);
		$adServer = "167.28.175.35";
		$ldap = ldap_connect($adServer);
		$username = "montivoli";
		$password = "15MontHL";
		$ldaprdn = 'banco' . "\\" . $username;
		ldap_set_option($ldap, LDAP_OPT_TIMELIMIT, 2);
		ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
		$bind = @ldap_bind($ldap, $ldaprdn, $password);
		if ($bind) {
			$filter="(sAMAccountName=$usuario)";
			$result = ldap_search($ldap,"dc=banco,dc=bestado,dc=cl",$filter);
			ldap_sort($ldap,$result,"sn");
			$info = ldap_get_entries($ldap, $result);
			if(count($info) > 1  ){
				$usuario = $info[0]["sn"][0].", " . $info[0]["givenname"][0];
				//escribir("LDAP",$usuario);
				@ldap_close($ldap);
				escribir("ldap-mal",$usuario);
				return $usuario;
			}else{
				escribir("ldap-ok",$user);
				return $user;
			}
		}else{
			escribir("ldap",$user);
			return $user;
		}
	}
	return $user;
}

function getResponsable($user){
include("../API/mysqlconnection.php");
	$query = "SELECT * FROM banco.aplicativos WHERE ID in (SELECT ID_APLICATIVO FROM banco.subaplicativos WHERE AFA = '$user')";//SELECT * FROM banco.procesos WHERE RESPONSABLE = '$user'";
	$result = $mysqli->query($query);

	$response = array();
	while ($fila = $result->fetch_assoc()) {
		$response[] = array(
			"ID" => $fila["ID"],
			"NOMBRE" => utf8_encode($fila["NOMBRE"]),
			"TRIPLETA" => $fila["TRIPLETA"],
			"AFA" => getName($user),
			"AFAS" => $user
		);
	}
	return $response;
}

function getResponsableSubaplicativo($user,$id){
include("../API/mysqlconnection.php");
	$query = "SELECT * FROM banco.subaplicativos WHERE ID = $id AND AFA ='$user'";//SELECT * FROM banco.procesos WHERE RESPONSABLE = '$user'";

	$result = $mysqli->query($query);

	$response = array();
	while ($fila = $result->fetch_assoc()) {
		$response[] = array(
			"ID" => $fila["ID"],
			"NOMBRE" => utf8_encode($fila["NOMBRE"]),
			"AFA" => getName($fila["AFA"]),
			"RA" => getName($fila["RA"]),
			"RAS" => $fila["RA"],
			"VIGENTE" => $fila["Vigente"]
		);
	}
	return $response;
}

function revisado($id){
	include("../API/mysqlconnection.php");
	$hoy = date("Y-m-d H:i:s");
	$query = "UPDATE banco.subaplicativos SET R_AFA = 1, AFA_MODIFICADO = '$hoy'  WHERE ID = $id";
	escribir("revisado",$query);
	$result = $mysqli->query($query);
}

?>
