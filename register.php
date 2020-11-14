<!DOCTYPE html>
<html>
<head>
	<title>WebGenerator</title>
</head>
<body>
	<h1>Registrarte es simple</h1>
	<form method="POST" action="register.php">
		<input type="text" name="email">
		<input type="text" name="contraseña1">
		<input type="text" name="contraseña2">
		<input type="submit" name="Crear" value="Crear">
    </form>
    <br>
    <?php
define("USER","3655");
define("PASS","3655");
define("DB","3655");
define("HOST","mattprofe.com.ar");
if (isset($_POST["Crear"]))
{
	$caracter=str_split($_POST["email"]);
	$resultado="falso";
	for ($i=0; $i < strlen($_POST["email"]); $i++)
	{
		if($caracter[$i] == '@'){$resultado="verdadero";}
	}
	if ($resultado=="verdadero" and $_POST["email"] != "" and $_POST["email"] != " ")
	{ 
		if($_POST["contraseña1"] == $_POST["contraseña2"]){
			$db = new mysqli(HOST, USER, PASS, DB);
			$sql = "SELECT * FROM `usuarios`";
			$res = $db->query($sql);
			$resultado="-";
			while($reg = $res->fetch_array())
			{
				if ($reg["email"] == $_POST["email"]){
				$resultado="Repetido";
				}
			}
			if ($resultado == "-"){
				$email=$_POST["email"];
				$password=$_POST["contraseña1"];
				$date=date("Y-m-d");
				$sql = "INSERT INTO `usuarios` (`email`, `password`,`fechaRegistro`) VALUES ('$email','$password','$date');";
				$res = $db->query($sql);
				header("Location: login.php");
				}else{echo "Ese email ya tiene creado una cuenta";}
		}else{echo "Las constraseñas con distintas";}
	}else{echo "Ingrese un email correcto";}
}
?>
</body>
</html>