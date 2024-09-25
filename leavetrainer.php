<?php
	include 'tools2.php';
	session_start();

	if(!isset($_SESSION['idUsuario'])){ //si esta iniciada
	 	header('Location: login.php');

	 }

	deleteById1($_SESSION['idUsuario']);

	session_unset();
	session_destroy();
	
	header('Location: login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	
</body>
</html>