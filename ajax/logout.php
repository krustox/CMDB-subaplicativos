<?php
	session_start();
	include('../Functions/Archivo.php');
	include('../Config/mysql.php');
	include('../Config/variables.php');

	$user ="";
	$session="";
	$ip="";
	$encuesta= "";
	if(isset($_SESSION['nombre1'])){
		$user = $_SESSION['nombre1'];
	}
	if(isset($_SESSION['session'])){
		$session = $_SESSION['session'];
	}
	if(isset($_SESSION['ip'])){
		$ip = $_SESSION['ip'];
	}
	if(isset($_SESSION['encuesta'])){
		$encuesta = $_SESSION['encuesta'];
	}

	if($user != "" && $session != "" && $ip != "" && $encuesta != "" ){
		cerrar_session($user,$session,$ip,$encuesta,$dbhost,$dbusuario,$dbpassword,$db,$dbport,$host);
	}else{
		header("Location: http://$host/bancoestado-subaplicativos/index.php");
	}

 ?>
