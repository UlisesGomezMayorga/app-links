<?php
	session_start();
	include 'tools.php';

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles.css">
	<title>Registro</title>
</head>
<body>
	<br>
	<center><div class="titulo">
		<h1>Registro</h1>
	</div></center>
	<br>


	<div id="frm">
	<center><br>
	<form action="" class="formulario"method="POST">
		<label for="Nombre">Ingrese su email</label>
		<br>
		<input type="text" required class="boton" name="Nombre"  />
		<br>
		<label for="contraseña">Ingrese su contraseña</label>
		<br>
		<input type="password" required class="boton" name="contraseña"  />
		<br>
		<br>
		<input type="submit" class="boton" name="btnSubmit" value="Registrarse">
		<br>
		<br>
		<a href="login.php">Ya tienes una cuenta? Inicia sesión</a>
		</center>
	</form>
</div>


<?php
	if(isset($_POST["btnSubmit"])){
		$nombre = $_POST ["Nombre"];
		$contraseña=$_POST["contraseña"];
		$id=0;


		$file = fopen('users.csv','r');
			$aux=0;

			while(!feof($file)){
				$nom[] = explode(',',fgets($file));
				
			}
			$contador=count($nom)-1;
			for ($i=0; $i < count($nom)-1; $i++) { 
				if($nombre==$nom[$i][1]){
						$aux=3;
						break;
				}else{
						$aux=1;
						$id=$nom[$i][0];
					}

				
			}
			
		fclose($file);

			// if(!isset($_SESSION['idtrainer'])){ //si esta iniciada
			// 	header('Location: paneltrainer.php');

			// }
			if($aux==3){
				?><center><h3 class='texto'>Email ya registrado</h3></center><?php
			}
			if($aux==1){
				addtrainer($nombre,$contraseña);
				$id=$id+1;
				?>
				<center><a class="texto" href="logintrainer.php">Su cuenta ha sido registrada</a></center>
				<?php			
			}
			// var_dump($id);
	}

?>

</body>
</html>