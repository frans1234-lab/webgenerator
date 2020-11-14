<!DOCTYPE html>
<html>
<head>
	<title>WebGenerator</title>
</head>
<body>
<center>
	<h1>WebGenerator</h1>
	<form method="POST" action="login.php">
		<input type="text" name="email">
		<input type="password" name="password">
		<input type="submit" name="Crear" value="Ingresar">
    </form>
    <a href="register.php">Registrarte</a>
<?php
session_start();
define("USER","adm_webgenerator");
define("PASS","webgenerator2020");
define("DB","webgenerator");
define("HOST","localhost");
if (isset($_SESSION["email"]) and isset($_SESSION["password"]))
{
	$db = new mysqli(HOST, USER, PASS, DB);
	$sql = "SELECT * FROM `usuarios`";
	$res = $db->query($sql);
	$resultado="Repetido";
	while($reg = $res->fetch_array()){
		if ($reg["email"] == $_SESSION["email"] and $reg["password"] == $_SESSION["password"])
		{
			header("Location: panel.php?valido=SI");
		}
	}
}
if (isset($_POST["Crear"])){
	$db = new mysqli(HOST, USER, PASS, DB);
	$sql = "SELECT * FROM `usuarios`";
	$res = $db->query($sql);
	$resultado="Repetido";
	while($reg = $res->fetch_array()){
		if ($reg["email"] == $_POST["email"] and $reg["password"] == $_POST["password"])
		{
			$resultado="good";
			$_SESSION["email"]=$_POST["email"];
			$_SESSION["password"]=$_POST["password"];
			header("Location: panel.php?valido=SI");
		}
	}
	if ($resultado=="Repetido")
	{
		echo "<h3>Contraseña o email incorrecto/s</h3>";
	}
}
?>
</center>
</body>
</html>
