<?php
session_start();
error_reporting(0);
	include 'tools2.php';

	if(!isset($_SESSION['usuario'])){ //si esta iniciada
	 			header('Location: login.php');

	 	if ($_SESSION['usuario']=='root') {
	 		header('Location:panel.php');
	 	}
	}

?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles.css">
	<title>Perfil</title>
</head>
<body>
	<div id="nav">
		<center><h1>Perfil</h1></center>
		<h2><?php echo($_SESSION['usuario']) ?></h2>
		<div>
			<a class="btn" href="panel.php">Panel</a>
			<a class="btn" href="logout.php">Cerrar Sesión</a>
		</div>
	</div>
	
	<br>
<?php




switch ($_GET["mode"]) {
		case 'addpais':
			$opciones="";
			?>
			<div id="frm1">
			<center> 
			<form action="" class="formulario1" method="POST">
			<label for="pais">País</label>
			<br>
			<input type="text" class="boton" required id="pais" name="pais"  />
			<br>
			<label for="provincia">Provincia</label>
			<br>
			<input type="text" class="boton" required id="provincia" name="provincia"  />
			<br>
			<label for="Localidad">Localidad</label>
			<br>
			<input type="text" class="boton" required id="Localidad" name="Localidad"  />
			<br>
			<br>
			<input type="submit" class="boton" name="btnSubmit" value="Enviar">
			<br><br><a href="profile.php">Cancelar</a>
			<?php
			if(isset($_POST['btnSubmit'])){
				$pais=$_POST['pais'];
				$provincia=$_POST['provincia'];
				$localidad=$_POST['Localidad'];
				$id=$_SESSION['idUsuario'];
				$usu=$_SESSION['usuario'];
				$contra=$_SESSION['contraseña'];
				$item[0]=$id;
				$item[1]=$usu;
				$item[2]=$contra;
				$item[3]=$pais;
				$item[4]=$provincia;
				$item[5]=$localidad;
				$item[6]=$_POST['btnSubmit'];
				// var_dump($item);
				editTrainer($item);
				header('Location:profile.php');


			}
		break;
		

	default:




		if($_SESSION['usuario']!='root'){
		?>
			<h3><a href="leavetrainer.php" style="text-align: center; display: inline-block; width: 100%; ">Abandonar cuenta y borrar datos</a></h3>
			<div id="frm1">
			<a href="profile.php?mode=addpais">Agregar/Modificar su ubicacion</a><br>
			
		</div>
		<?php 
		echo($opciones);}
		break;
}
?>
<!-- 	<div id="frm1">
	<center> 
	<form action="" class="formulario1" method="POST">
		<label for="pais">País</label>
		<br>
		<input type="text" class="boton" id="pais" name="pais"  />
		<br>
		<label for="provincia">Provincia</label>
		<br>
		<input type="provincia" class="boton" id="provincia" name="provincia"  />
		<br>
		<label for="localidad">localidad</label>
		<br>
		<input type="localidad" class="boton" id="localidad" name="localidad"  />
		<br>
		<label for="edad">edad</label>
		<br>
		<input type="edad" class="boton" id="edad" name="edad"  />
		<br><br>
		<input type="submit" class="boton" name="btnSubmit" value="Ingresar">
		<br><br></form>
		
				</center>
</div> -->

</body>
</html>