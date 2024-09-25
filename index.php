<?php
	include 'tools.php';




?>







<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles.css">
	<title>App-links</title>
</head>
<body>
	<div id="nav">
		<h1>App-links</h1>
		<div>
			<a class="btn" href="login.php">Ingresar</a>
			<a class="btn" href="register.php">Registrarme</a>
		</div>
	</div>
	<div id="hero">
		<div id="#herotext">
			<h2>Añade los links de tus paginas favoritas.</h2>
			<br>
			<br>
			<h3>Total de links guardados: <?php echo(getCantLinks()) ?></h3>		
		</div>
	</div>
</body>
</html>