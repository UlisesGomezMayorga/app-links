<?php
	// include 'trainertools.php';
	session_start();
	$id=$_SESSION['idusuario'];
	// registrologout($id);
	session_unset();
	session_destroy();
	
	header('Location: login.php');
	
	
?>