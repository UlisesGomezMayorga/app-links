<?php
session_start();
error_reporting(0);
	include 'tools.php';
	include 'tools2.php';
	if(!isset($_SESSION['usuario'])){ //si esta iniciada
	 			header('Location: login.php');
	}




?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles.css">
	<title>Panel</title>
</head>
<body>
		<div id="nav">
	<center><h1>Panel</h1></center>
		
		<div id="links">
			<a class="btn" href="profile.php">Perfil</a>
			<a class="btn" href="logout.php">Cerrar Sesión</a>
		</div>
	</div>
	<?php
	$opciones='<div id="frm1">
	<a href="panel.php?mode=addlink">Agregar link</a><br>
	
</div><br>';
	
			switch ($_GET['mode']) {
				case 'addlink':
					$opciones="";
					?>
					<div id="frm1">
					<center> 
					<form action="" class="formulario1" method="POST">
					<label for="url">Url</label>
					<br>
					<input type="text" class="boton" required id="url" name="url"  />
					<br>
					<label for="nombre">Nombre</label>
					<br>
					<input type="text" class="boton" required id="nombre" name="nombre"  />
					<br>
					<label for="categoria">Categoria (opcional)</label>
					<br>
					<input type="text" class="boton" id="categoria" name="categoria"  />
					<br>
					<br>
					<input type="submit" class="boton" name="btnSubmit" value="Ingresar">
					<br><br>
					<a href="panel.php">Volver</a>
					
					<?php
					if(isset($_POST['btnSubmit'])){
						$url=$_POST['url'];
						$nombre=$_POST['nombre'];
						$categoria=$_POST['categoria'];
						$idusuario=$_SESSION['idUsuario'];
						if($categoria==""){
							addlink1($url,$nombre,$idusuario);
						}else{
							addlink2($url,$nombre,$idusuario,$categoria);
						}
					}
					break;
				
				case 'options':
					// var_dump($_GET['idlink']);
					if(isset($_GET['idlink'])){

						// var_dump($_GET['idlink']);
					?>

							<?php
						$file = fopen('links.csv','r');
						while(!feof($file)){
							$nom[] = explode(',',fgets($file));
						}

							for ($i=0; $i < count($nom)-1; $i++) { 
								if($_GET['idlink']==$nom[$i][0]){
									?>
															<center><br><div class="formulario">
									<div id="frm">
										<div class='ver'><h2 class='ver'><?php echo($nom[$i][2]) ?></h2>

										<?php echo($nom[$i][3]) ?>
										<?php echo($nom[$i][4]) ?>
										</div>
								</div></div></center>
								<?php
							}
							?>
						
						<?php
					}

							?><br>
							<center>
							<a href="panel.php?mode=del&idlink=<?php echo $_GET['idlink'] ?> ">Eliminar</a>
							<br><br>
							<a href="panel.php?mode=mod&idlink=<?php echo $_GET['idlink'] ?> ">Modificar</a>
							<br><br>
							<a href="panel.php">Cancelar</a>
						</div></center>
					<?php
					}

					break;

				case 'del':	
					deleteById($_GET['idlink']);
					header('Location:panel.php');
					break;

				case 'mod':
				?>
					<div id="frm1">
					<center> 
					<form action="" class="formulario1" method="POST">
					<label for="url">Url</label>
					<br>
					<input type="text" class="boton" required id="url" name="url"  />
					<br>
					<label for="nombre">Nombre</label>
					<br>
					<input type="text" class="boton" required id="nombre" name="nombre"  />
					<br>
					<label for="categoria">Categoria (opcional)</label>
					<br>
					<input type="text" class="boton" id="categoria" name="categoria"  />
					<br>
					<br>
					<input type="submit" class="boton" name="btnSubmit" value="Actualizar">
					<br><br><a href="panel.php">Cancelar</a>
					
					<?php
					if(isset($_POST['btnSubmit'])){
						$url=$_POST['url'];
						$nombre=$_POST['nombre'];
						$categoria=$_POST['categoria'];
						$idusuario=$_SESSION['idUsuario'];
						if($categoria==""){
							$items[0]=$_GET['idlink'];
							$items[1]=$idusuario;
							$items[2]=$nombre;
							$items[3]=$url;
							$items[4]=$_POST['btnSubmit'];
							editLink($items);
							header('Location:panel.php');
						}else{
							$items[0]=$_GET['idlink'];
							$items[1]=$idusuario;
							$items[2]=$nombre;
							$items[3]=$url;
							$items[4]=$categoria;
							$items[5]=$_POST['btnSubmit'];
							editLink($items);
							header('Location:panel.php');
						}
					}

					break;

				default:
					echo($opciones);
					
					$file = fopen('links.csv','r');
					while(!feof($file)){
						$nom[] = explode(',',fgets($file));
					}
					if($_SESSION['usuario']=='root'){
						?>
						<center><div id="listado-items"><?php
						for ($i=0; $i < count($nom)-1; $i++) { 
						// var_dump($nom[$i][2]);
							
								?>
								
							<a href=<?php echo($nom[$i][3])?> >

								<div class="renglon-datos">
									<p><?php echo($nom[$i][2]) ?></p>
								</div>
							</a>
								
								<?php
							
						}
												?>
						</div></center>
						<?php
					}else{
						$usuario=$_SESSION['idUsuario'];
						// redirect($usuario,$contraseña);
						?>
						<center><div id="listado-items"><?php
						for ($i=0; $i < count($nom)-1; $i++) { 
							// var_dump($nom[$i][2]);
							if($usuario==$nom[$i][1]){
								if($nom[$i][3][0] == 'h'){
								?>	
									<a href=<?php echo($nom[$i][3])?> >

										<div class="renglon-datos">
											<p><?php echo($nom[$i][2]) ?></p>
											<div class="opciones"><a href="panel.php?mode=options&idlink=<?php echo $nom[$i][0] ?> ">☰</a></div>
										</div>
									</a>
								<?php
								}else{
								?>	
									<a href=http:/www.<?php echo($nom[$i][3])?> >

										<div class="renglon-datos">
											<p><?php echo($nom[$i][2]) ?></p>
											<div class="opciones"><a href="panel.php?mode=options&idlink=<?php echo $nom[$i][0] ?> ">☰</a></div>
										</div>
									</a>
								<?php
								}
								
								

								
								
							}
						}
						?>
						</div></center>
						<?php
					}
					break;
			}


	?>
</body>
</html>