<?php

	function getCantLinks(){
	$file = fopen('links.csv','r');
	$cont = 0;
	while(!feof($file)){
		if(fgets($file)){
				$cont+=1;
			}
		}

		return $cont-1;
		fclose($f);
 	}

	function makeLinkCSV(){
		$f = fopen("links.csv", "w");

	        fwrite($f,'idlink,idusuario,nombre,'.'link,'.PHP_EOL);
	    fclose($f);
	}

	// makeLinkCSV();
	function makeUsuariosCSV(){
		$f = fopen("users.csv", "w");

	        fwrite($f,'id,'.'email,'.'contraseña,'.PHP_EOL);
	    fclose($f);
	}
	// makeUsuariosCSV();

 	function addtrainer($email,$contraseña){
 		$file = fopen('users.csv','a+');
 		$id=0;
 		while(!feof($file)){
			$ids = explode(',',fgets($file));	
			if(feof($file)-1){
				$id=$ids[0]+1;
			}
		}
 		fwrite($file ,$id.','.$email.','.$contraseña.",".PHP_EOL);
 		// makeRegistro($id);
 	// 	$_SESSION['idtrainer'] = $id;
		// $_SESSION['usertrainer'] = $_POST['usuario'];
		// $_SESSION['nomtrainer'] = $nombre;
		header('Location: logout.php');

 		fclose($file);
 	}



 	function addlink1($url,$nombre,$idusuario){
 		$file = fopen('links.csv','a+');
 		$id=0;
 		while(!feof($file)){
			$ids = explode(',',fgets($file));	
			if(feof($file)-1){
				$id=$ids[0]+1;
			}
		}
 		fwrite($file ,$id.','.$idusuario.','.$nombre.','.$url.",".PHP_EOL);
 		// makeRegistro($id);
 	// 	$_SESSION['idtrainer'] = $id;
		// $_SESSION['usertrainer'] = $_POST['usuario'];
		// $_SESSION['nomtrainer'] = $nombre;
		header('Location: panel.php');

 		fclose($file);
 	}


 	function addlink2($url,$nombre,$idusuario,$categoria){
 		$file = fopen('links.csv','a+');
 		$id=0;
 		while(!feof($file)){
			$ids = explode(',',fgets($file));	
			if(feof($file)-1){
				$id=$ids[0]+1;
			}
		}
 		fwrite($file ,$id.','.$idusuario.','.$nombre.','.$url.",".$categoria.','.PHP_EOL);
 		// makeRegistro($id);
 	// 	$_SESSION['idtrainer'] = $id;
		// $_SESSION['usertrainer'] = $_POST['usuario'];
		// $_SESSION['nomtrainer'] = $nombre;
		header('Location: panel.php');

 		fclose($file);
 	}

	function loadDatosMemoria2(){

		// abre el archivo como lectura
		$a = fopen("links.csv", "r");

		$renglon = "";

		// mientras no llega al fin de archivo
		while(!feof($a)){

			// lee el renglón
			$renglon =  fgets($a);

			// si el renglon no esta vacio 
			if($renglon!=""){
				// lo pasamos a matriz con explode
				$matriz[] = explode(",", $renglon);
			}
		}

		// cerramos el archivo
		fclose($a);

		// hay datos en la matriz?
		if(isset($matriz)){
			// retornamos la matriz para que se manipule
			return $matriz;
		}else{ // no hay datos en la matriz
			return false;
		}
	}

	// Retorna un string con el listado y botones para borrar renglón
	// =============================================
	function showDatos2(){

		// Cargamos el archivo de texto en una matriz
		$datos = loadDatosMemoria2();

		// si no hay datos retorna un mensaje
		if($datos == false){
			return 'No hay datos para listar. <br><a href="?modo=crear">Cargar info en datos.csv</a><br>';
		}

		$listado = '<div id="wrapper"><div id="listado">';

		// Recorre la matriz
		for ($i=0; $i < count($datos); $i++) { 

			// acumula los renglones del listado con el botón borrar
			$listado .= $datos[$i][0].' '.$datos[$i][1].' '.$datos[$i][2].'<div><a href="?modo=borrar&id='.$datos[$i][0].'" class="btn borrar">X</a>
				<a href="?modo=editar&id='.$datos[$i][0].'" class="btn editar">M</a></div>';
		}

		// retorna el listado
		return $listado."</div></div>";
	}

	// Borra una fila de la matriz
	// =============================================
	function deleteById2($id){
		$matriz = loadDatosMemoria2();

		// si no hay datos en la matriz retornamos false
		if($matriz == false){
			return false;
		}

		// recorremos las filas de la matriz
		for ($i=0; $i < count($matriz); $i++) { 
			
			// el id coincide con el id de la fila
			if($matriz[$i][0]==$id){

				// Borramos el renglon
				unset($matriz[$i]);

				break; // sale del for
			}
		}

		// Reindexa la matriz 
		$matriz = array_values($matriz);

		// guarda la matriz en el archivo
		saveDatos2($matriz);
	}

	// Edita los datos del id que viene en item[0].
	// ítem es un vector, lo que sigue del indice 0
	// serán todos los valores que se van a editar,
	// sin importar si cambiaron o no deben estar todos,
	// el último ítem lo cargamos con una coma.
	// =============================================
	function editLink($item){
		$matriz = loadDatosMemoria2();

		// si no hay datos en la matriz retornamos false
		if($matriz == false){
			return false;
		}


		// recorremos las filas de la matriz
		for ($i=0; $i < count($matriz); $i++) { 
			
			// el id coincide con el id de la fila
			if($matriz[$i][0]==$item[0]){

				// Sobreescribo el renglon
				$matriz[$i] = $item;

				break; // sale del for
			}
		}

		// guarda la matriz en el archivo
		saveDatos2($matriz);
	}












	// Retorna un vector con los datos del ítem que tiene ese id
	// ===========================
	function getItemById2($id){

	$matriz = loadDatosMemoria2();

		// si no hay datos en la matriz retornamos false
		if($matriz == false){
			return false;
		}


		$vector = "";

		// recorremos las filas de la matriz
		for ($i=0; $i < count($matriz); $i++) { 
			
			// el id coincide con el id de la fila
			if($matriz[$i][0]==$id){

				$vector = $matriz[$i];

				break; // sale del for
			}
		}

		return $vector;
	}

	// Sobreescribe el archivo con el contenido de la matriz
	// =============================================
	function saveDatos2($matriz){

		// apertura del archivo como escritura
		$a = fopen("links.csv", "w");

		// Recorremos la matriz y pasamos su contenido al archivo
		for ($i=0; $i < count($matriz); $i++) { 
			
			// Variable que acumula los datos de un renglon
			$buff = "";

			// recorremos las columnas de una fila de la matriz, la ultima columna no (ya que tiene el enter)
			for ($x=0; $x < count($matriz[$i])-1; $x++) { 
				$buff .= $matriz[$i][$x]. ",";
			}

			// agregamos el enter al final del renglon
			$buff .= PHP_EOL; 

			// Escribimos el renglon en el archivo
			fwrite($a, $buff);
			
		}

		fclose($a);

	}



 	?>