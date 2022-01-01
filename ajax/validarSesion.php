<?php
	session_start();
	include("../../Functions/Archivo.php");
	include('../../Config/mysql.php');
	include('../../Config/variables.php');
	include("../../Functions/Function.php");

	if(isset($_SESSION['nombre1']) && isset($_SESSION['session']) && isset($_SESSION['ip']) && isset($_SESSION['encuesta'])) {
		$user = $_SESSION['nombre1'];
		$sesion = $_SESSION['session'];
		$ip = $_SESSION['ip'];
		$encuesta = $_SESSION['encuesta'];
		escribir("Verify","Se verifica la sessión del usuario ".$user);
		verify($user,$sesion,$ip,$encuesta,$dbhost,$dbusuario,$dbpassword,$db,$dbport,$host);
	}else{
		escribir("Verify","No se pudo verificar la sessión del usuario ");
		cerrar_sessiones($host);
	}
 ?>
