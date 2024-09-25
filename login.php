<?php

	session_start();

	if(isset($_SESSION['usuario'])){ //si esta iniciada
	 			header('Location: profile.php');
	 }
?>





<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LoginTrainer</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<br>
	<center><div class="titulo">
		<h1>Inicio de Sesión</h1>
	</div></center>
<br>
<br>
<div id="frm">
<center> 
	<form action="" class="formulario" method="POST">
		<label for="Nombre">Nombre de usuario</label>
		<br>
		<input type="text" class="boton" required id="Nombre" name="Nombre"  />
		<br>
		<label for="password">Contraseña</label>
		<br>
		<input type="password" class="boton" required id="contra" name="contra"  />
		<br><br>
		<input type="submit" class="boton" name="btnSubmit" value="Ingresar">
		<br><br></form>
		<a class="texto" href="register.php">Registrate</a>
		<!-- <a class="texto" href="addtrainer.php">Nuevo entrenador???</a> -->
	
		</center>
</div>

	<?php
	 // 	$texto.="<center><b><h1 class='titulo'>Bienvenido Entrenador</h1></b></center>";
 	// $texto.="<center><h2>Entrenadores actuales:   ".$cant."   </h2><center>";
 	// $texto.=';



 		$usuario="";
 		$contraseña="";
 		$id="";
 		$nombre="";
 		$aux=0;
 		$aux2=0;
 		$nombe="";
 		$apellido="";
		if(isset($_POST["btnSubmit"])){
			$usuario = $_POST ['Nombre'];
			$contraseña = $_POST ['contra'];

			if($usuario=='root'){
				if($contraseña=='toor'){
					$_SESSION['usuario']='root';
					$_SESSION['contraseña']='toor';
					header('Location:panel.php');
				}
			}

			$file = fopen('users.csv','r');
			while(!feof($file)){
				$nom[] = explode(',',fgets($file));
			}
			// redirect($usuario,$contraseña);
			for ($i=0; $i < count($nom)-1; $i++) { 
				if($usuario==$nom[$i][1]){
					if($contraseña == rtrim($nom[$i][2])){
						$nombre=$nom[$i][1];
						$aux=3;
						$id=$nom[$i][0];
						$nombre=$nom[$i][1];
						$_SESSION['idUsuario'] = $id;
						$_SESSION['usuario'] = $_POST['Nombre'];
						$_SESSION['contraseña'] = $_POST['contra'];
						// $_SESSION['randpoke']=0;
						// $_SESSION['fecha']=$nom[$i][6];
						// registrologin($id);
						header('Location: panel.php');
						break;
					}
					if($contraseña!=rtrim($nom[$i][2])){
						$aux=1;
					}
				}
			}
			fclose($file);


//Condicionales de logueo
			if($aux==3){
				$texto="<center><h1 class='titulo'>Bienvenido  ".$nombre."  ".$apellido."</h1></center>";
			}
			if($aux==1){
				?><center><h3>Contraseña Invalida</h3></center><?php
			}
			if($aux!=3&&$aux!=1){
				?><center><h3>Usuario Inexistente</h3></center><?php
			}
		
		
		}
	// echo $texto;
	?>
	 
</body>
</html>