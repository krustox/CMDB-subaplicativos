<?php
$dbhost ="localhost";
$dbusuario ="root";
$dbpassword ="newpassword";
$dbport = 3306;
$db="banco";

function verify($user,$sesion,$ip,$encuesta,$dbhost,$dbusuario,$dbpassword,$db,$dbport,$host){
	$conecta = new mysqli($dbhost, $dbusuario, $dbpassword,$db,$dbport);
	if($encuesta != "SUBAPLICATIVOS-AFA"){
		$encuesta = "SUBAPLICATIVOS-AFA";
	}
	if($conecta->connect_error){
		echo $conecta->connect_error;
	}else{
		$result = $conecta->query("SELECT count(*) FROM usuario WHERE nombre = '$user' AND encuesta = '$encuesta';");
		$row = $result->fetch_array(MYSQLI_NUM);
		if($row[0]>1){
			if($conecta->query("DELETE FROM usuario WHERE nombre = '$user' AND encuesta = '$encuesta';") == TRUE){
				escribir("login", "Cerró Sesión: (TODAS)  ".$_SESSION['nombre1']." ". $session ." ".$_SESSION['encuesta'] );
				$_SESSION['status'] = null;
				$_SESSION['nombre'] = null;
				$_SESSION['nombre1'] = null;
				$_SESSION['session'] = null;
				$_SESSION['encuesta'] = null;
				$_SESSION['ip'] = null;
				session_unset();
				session_destroy();
				cerrar_session($user,$sesion,$ip,$encuesta,$dbhost,$dbusuario,$dbpassword,$db,$dbport,$host);
				header("Location: http://$host/bancoestado-subaplicativos/index.php");
			}else{
				echo $conecta->error;
			}
		}else if($row[0]<1){
			$_SESSION['status'] = null;
			$_SESSION['nombre'] = null;
			$_SESSION['nombre1'] = null;
			$_SESSION['session'] = null;
			$_SESSION['encuesta'] = null;
			$_SESSION['ip'] = null;
			session_unset();
			session_destroy();
			cerrar_session($user,$sesion,$ip,$encuesta,$dbhost,$dbusuario,$dbpassword,$db,$dbport,$host);
			header("Location: http://$host/bancoestado-subaplicativos/index.php");
		}else if($row[0]==1){
			$result = $conecta->query("SELECT session_id FROM usuario WHERE nombre = '$user' AND encuesta = '$encuesta';");
			$row = $result->fetch_array(MYSQLI_NUM);
			if($row[0] != $sesion){
				$_SESSION['status'] = null;
				$_SESSION['nombre'] = null;
				$_SESSION['nombre1'] = null;
				$_SESSION['session'] = null;
				$_SESSION['encuesta'] = null;
				$_SESSION['ip'] = null;
				session_unset();
				session_destroy();
				cerrar_session($user,$sesion,$ip,$encuesta,$dbhost,$dbusuario,$dbpassword,$db,$dbport,$host);
				header("Location: http://$host/bancoestado-subaplicativos/index.php");
			}
		}
	}
}

function iniciar_session($user,$session,$ip,$encuesta,$dbhost,$dbusuario,$dbpassword,$db,$dbport,$host){
	$conecta = new mysqli($dbhost, $dbusuario, $dbpassword,$db,$dbport);
	if($conecta->connect_error){
		echo $conecta->connect_error;
	}else{
		$result = $conecta->query("SELECT count(*) FROM usuario WHERE nombre = '$user' AND encuesta = '$encuesta';");
		$row = $result->fetch_array(MYSQLI_NUM);
		if($row[0]>0){
				if($conecta->query("UPDATE usuario SET session_id = '$session',ip='$ip' WHERE nombre = '$user' AND encuesta = '$encuesta';") == TRUE)
				{
					escribir("login", "Inicio Sesión: (Cierra Sesion preexistente) " . $user." ". $session ." ");
				}else{
					echo $conecta->error;
				}
		}else{
			if($conecta->query("INSERT INTO usuario (nombre,session_id,ip,encuesta) VALUES ('$user','$session','$ip','$encuesta')") == TRUE)
			{
				escribir("login", "Inicio Sesión: (Sesion Nueva) " . $user." ". $session." ".$encuesta );}else{echo $conecta->error;
			}
		}
		mysqli_close($conecta);
	}
}

function cerrar_session($user,$session,$ip,$encuesta,$dbhost,$dbusuario,$dbpassword,$db,$dbport,$host){
	$conecta = new mysqli($dbhost, $dbusuario, $dbpassword,$db,$dbport);
	if($conecta->connect_error){
		echo $conecta->connect_error;
	}else{
		if($conecta->query("DELETE FROM usuario WHERE nombre = '$user' AND encuesta = '$encuesta' ;") == TRUE){
			escribir("login", "Cerró Sesión: (TODAS) ".$_SESSION['nombre1']." ".$_SESSION['nombre']." ". $session." ".$_SESSION['encuesta']);
			$_SESSION['status'] = null;
			$_SESSION['nombre'] = null;
			$_SESSION['nombre1'] = null;
			$_SESSION['session'] = null;
			$_SESSION['encuesta'] = null;
			$_SESSION['ip'] = null;
			session_unset();
			session_destroy();
			header("Location: http://$host/bancoestado-subaplicativos/index.php");
		}else{
			echo $conecta->error;
		}
	}
}

function cerrar_sessiones($host){
			session_unset();
			session_destroy();
			header("Location: http://$host/bancoestado-subaplicativos/index.php");
}

?>
