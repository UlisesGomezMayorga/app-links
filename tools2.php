<?php 
	
	// crea el archivo datos.csv con datos de ejemplo
	// =============================================	

	function loadDatosMemoria1(){

		// abre el archivo como lectura
		$a = fopen("users.csv", "r");

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
	function showDatos1(){

		// Cargamos el archivo de texto en una matriz
		$datos = loadDatosMemoria1();

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
	function deleteById1($id){
		$matriz = loadDatosMemoria1();

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
		saveDatos1($matriz);
	}

	// Edita los datos del id que viene en item[0].
	// ítem es un vector, lo que sigue del indice 0
	// serán todos los valores que se van a editar,
	// sin importar si cambiaron o no deben estar todos,
	// el último ítem lo cargamos con una coma.
	// =============================================
	function editTrainer($item){
		$matriz = loadDatosMemoria1();

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
		saveDatos1($matriz);
	}

	// Retorna un vector con los datos del ítem que tiene ese id
	// ===========================
	function getItemById($id){

	$matriz = loadDatosMemoria1();

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
	function saveDatos1($matriz){

		// apertura del archivo como escritura
		$a = fopen("users.csv", "w");

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





function saveCommentCSV($comments){
		$comentarios_csv = fopen("DBTXT/capturados.csv", "w");


		for ($i=0; $i < count($comments); $i++) { 


			fwrite($comentarios_csv, implode(",", $comments[$i]));
		}


		fclose($comentarios_csv);

		return true;

	}

	// Retorna en una matriz todos los comentarios
	// ===================================
	function getAllComent(){

		$comentarios_csv = fopen("DBTXT/capturados.csv", "r");

		while(!feof($comentarios_csv)){

			$renglon = fgets($comentarios_csv);

			if($renglon != ""){
				$comentarios[] = explode(",",$renglon);
			}
		}

		fclose($comentarios_csv);


		return $comentarios;
	}



	function saveCommentCSVtrainer($comments){
		$comentarios_csv = fopen("users.csv", "w");


		for ($i=0; $i < count($comments); $i++) { 


			fwrite($comentarios_csv, implode(",", $comments[$i]));
		}


		fclose($comentarios_csv);

		return true;

	}

	// Retorna en una matriz todos los comentarios
	// ===================================
	function getAllComenttrainer(){

		$comentarios_csv = fopen("users.csv", "r");

		while(!feof($comentarios_csv)){

			$renglon = fgets($comentarios_csv);

			if($renglon != ""){
				$comentarios[] = explode(",",$renglon);
			}
		}

		fclose($comentarios_csv);


		return $comentarios;
	}





	// Borra un comentario por su id
	// ===================================
	function leavePokeByIdCaptura($idComment){//leave poke by id captura
		$comments = getAllComent();

		for ($i=0; $i < count($comments); $i++) { 
			
			if($comments[$i][0] == $idComment){

				unset($comments[$i]);

				// Re indexar la matriz
				$comments = array_values($comments);

				saveCommentCSV($comments);

				return getAllComent();
			}
		}

		return false;
	}
// leavePokeByIdCaptura(1001);
	function leaveAllPokeByIdTrainer($idComment){//leave poke by id captura
		$matriz = getAllComent();

		// si no hay datos en la matriz retornamos false
		if($matriz == false){
			return false;
		}

		// recorremos las filas de la matriz
		for ($i=0; $i < count($matriz); $i++) { 
			
			// el id coincide con el id de la fila
			if($matriz[$i][1]==$idComment){

				// Borramos el renglon
				unset($matriz[$i]);

				 // sale del for
			}
		}

		// Reindexa la matriz 
		$matriz = array_values($matriz);

		// guarda la matriz en el archivo
		saveCommentCSV($matriz);
	}

// var_dump(getAllComent());



 function leaveTrainer($idTrainer){
 	leaveAllPokeByIdTrainer($idTrainer);
 	$comments = getAllComenttrainer();

	for ($i=0; $i < count($comments); $i++) { 
			
		if($comments[$i][0] == $idTrainer){

			unset($comments[$i]);

				// Re indexar la matriz
			$comments = array_values($comments);

			saveCommentCSVtrainer($comments);

			return getAllComenttrainer();
		}
	}

	return false;

 }



	function createDatos(){

		$a = fopen("datos.csv", "w");

		fwrite($a, "1001,lima,namiya,
1002,cereza,namiya,
1003,zarsamora,namiya,
1004,tigresa,gerhard,
1005,lince,gerhard,
1006,panda,gerhard,");

		fclose($a);

	}

	// retorna una matriz con los datos del archivo
	// en caso de que haya renglones en el archivo retorna False
	// =============================================
	function loadDatosMemoria(){

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
	function showDatos(){

		// Cargamos el archivo de texto en una matriz
		$datos = loadDatosMemoria();

		// si no hay datos retorna un mensaje
		if($datos == false){
			return 'No hay datos para listar. <br><a href="?modo=crear">Cargar info en datos.csv</a><br>';
		}

		$listado = "";

		// Recorre la matriz
		for ($i=0; $i < count($datos); $i++) { 

			// acumula los renglones del listado con el botón borrar
			$listado .= $datos[$i][0].' '.$datos[$i][1].' '.$datos[$i][2].'&nbsp<a href="?modo=borrar&id='.$datos[$i][0].'" class="btn borrar">X</a><br>';
		}

		// retorna el listado
		return $listado;
	}

	// Borra una fila de la matriz
	// =============================================
	function deleteById($id){
		$matriz = loadDatosMemoria();

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
		saveDatos($matriz);
	}

	// Sobreescribe el archivo con el contenido de la matriz
	// =============================================
	function saveDatos($matriz){

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


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <title>list-delete</title> -->

	<style type="text/css">
		.btn{
			border-radius: 8px;
			text-decoration: none;
			padding: 0 10px;
		}

		.borrar{
			background-color: red;
			color: white;
			font-weight: bold;
		}

		.borrar:hover, .borrar:focus{
			background-color: blue;
		}
	</style>
</head>
<body>





	<?php 

		// // si existe modo
		// if(isset($_GET["modo"])){

		// 	// averiguamos en que modo esta
		// 	switch ($_GET["modo"]) {
		// 		case 'crear':		
		// 			// si fue crear crea un archivo datos.csv de muestra
		// 			createDatos();
		// 			// mostramos el listado
		// 			echo showDatos();					
		// 			break;

		// 		case 'borrar':
					
		// 			// si fue borrar averiguamos si tiene id
		// 			if(isset($_GET["id"])){
		// 				// borra el id
		// 				deleteById($_GET["id"]);
		// 			}

		// 			// mostramos el listado
		// 			echo showDatos();

		// 			break;
				
				

		// 		default:
		// 			# code...
		// 			break;
		// 	}

		// }else{ // no existe modo entonces mostramos un link que crea 

		// 	echo '<a href="?modo=crear">Crear datos.csv</a><br>';
		// }


	 ?>
	
</body>
</html>