<!DOCTYPE html>
<html>
<head>
	<title>WebGenerator</title>
</head>
<body>
	<center><h2>Bienvenido a tu Panel</h2>
<?php
	session_start();
	if (!isset($_SESSION["email"]))
	{
		header("location: login.php");
	}
	define("USER","3655");
	define("PASS","3655");
	define("DB","3655");
	define("HOST","mattprofe.com.ar");
	$db = new mysqli(HOST, USER, PASS, DB);
	$email=$_SESSION["email"];
	$sql = "SELECT `idUsuario` FROM `usuarios` WHERE `email`='$email'";
	$res = $db->query($sql);
	$reg = $res->fetch_array();
	echo "<a href=logout.php>Cerrar Sesion de ".$reg["idUsuario"]." </a><br><br>";
	$id=$reg["idUsuario"];
	if ($_SESSION["email"]== "admin@server")
	{
		$sql = "SELECT `dominio` FROM `webs`";
		$res = $db->query($sql);
		echo "Paginas Webs creadas<br>";
		while ($reg = $res->fetch_array()){
			$dominio=$reg['dominio'];
			echo "<a href=$dominio/index.php>$dominio</a><br>";
		}
	}else
	{
		if (isset($_POST["Generar"])){
			$sql = "SELECT `dominio` FROM `webs`";
			$res = $db->query($sql);
			$resultado="No Repetida";
			$dominioconcatenado=$id.$_POST["dominio"];
			while ($reg = $res->fetch_array()){
				if($reg["dominio"] == $dominioconcatenado)
				{
					$resultado="Repetida";
				}
			}
			if($resultado != "Repetida")
			{
				
				$date=date("Y-m-d");
				$sql = "INSERT INTO `webs` (`idUsuario`, `dominio`,`fechaCreacion`) VALUES ('$id','$dominioconcatenado','$date');";
				$res = $db->query($sql);
				shell_exec('./wix.sh '.$dominioconcatenado);
			}else{echo "Dominio existente,ingrese otro";}
		}
		echo "<form action=panel.php method=POST>";
		echo "Generar Web de:<input type=text name=dominio><br>";
		echo "<input type=submit name=Generar value=Crear Web>";
		echo "</form>";
		$sql = "SELECT `dominio` FROM `webs` WHERE `idUsuario` = '$id'";
		$res = $db->query($sql);
		echo "<br><br>Paginas Webs creadas<br>";
		echo "<table border=1>";
		while ($reg = $res->fetch_array()){
			$dominio=$reg['dominio'];
			echo "<tr><td><a href=$dominio/index.php>$dominio</a></td>";
			echo "<td><a href=dowland.php?dominio=$dominio>Descargar Web</a></td></tr>";
		}
		echo "</table></center></body></html>";
	}
?>