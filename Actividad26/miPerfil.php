<?php
include 'lib/seguridad.php';
$seguridad = new seguridad();
	if ($seguridad->getUsuario()== null){
		header('Location: index.php');
		exit;
	}
	//-- COOKIES --\\
	if (isset($_POST['colores'])) {
		$fondo=$_POST['colores'];
		setcookie('fondo',$fondo,time()+3600);
	}
	//-- FIN COOKIES --\\

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mi Perfil</title>
    <?php
    if ($seguridad->cookies()==true) {
    echo "<style type=text/css>
    	body{
    		background-color:".$seguridad->cookies().";
    	}
    </style>";
	}else{
		return null;
	}
	?>
  </head>
  <body>
	<?php
		if ((empty($_POST['email'])) && (empty($_POST['nombre'])) && (empty($_POST['apellidos'])) && (empty($_POST['roles']))){

	?>
	<h1>Mi perfil</h1><hr>
	<form class="" action="miPerfil.php" method="post">

	<label for="Email">Email:</label>
	<br><input type="text" name="email"  placeholder="Usuario" value="<?=$_GET['email']?>" readonly required/><br><br>

	<label for="Nombre">Nombre:</label>
	<br><input type="text" name="nombre" placeholder="Actualiza tu nombre"><br><br>

	<label for="Apellidos">Apellidos:</label>
	<br><input type="text" name="apellidos" placeholder="Actualiza tu apellido"><br><br>

	<label for="Colores">Colores:</label>
	<br><select name="colores">
		<option value="">Elige un Color</option>
		<option value="red">Rojo</option>
		<option value="blue">Azul</option>
		<option value="green">Verde</option>
		<option value="white">Blanco</option>
		</select>
	<br>
	<input type="submit" name="" value="Actualizar">
	</form>

	<form  action="miPerfil.php" method="post">
	<input type="hidden" name="logout" value="Logout">
	<input type="submit" name="logout" value="LogOut">
	<?php
	}

	if (isset($_POST['logout'])){
			echo "Logout correcto";
			$seguridad->logout();
			header('Location: index.php');
		}

	if((isset($_POST['email'])) && (!empty($_POST['email'])) &&
        (isset($_POST['nombre'])) && (!empty($_POST['nombre'])) &&
        (isset($_POST['apellidos'])) && (!empty($_POST['apellidos']))&&
	(isset($_POST['roles'])) && (!empty($_POST['roles']))) {

		include 'lib/usuarios.php';
		$user = new usuario();
		$user->updateUser($_POST['nombre'],$_POST['apellidos'],$_POST['roles'],$_POST['email']);
		echo "Tu usuario ha sido actualizado";
		}
	?>
	</body>
	</html>
