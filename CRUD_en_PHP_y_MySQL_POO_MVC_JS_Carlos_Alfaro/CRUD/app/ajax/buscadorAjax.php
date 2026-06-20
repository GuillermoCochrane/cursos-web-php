<?php
	
	require_once "../../config/app.php";
	require_once "../views/components/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\searchController;

	if(isset($_POST['modulo_buscador'])){

		$insBuscador = new searchController();

		/* Ruta para procesar la busqueda */
		if($_POST['modulo_buscador']=="buscar"){
			echo $insBuscador->iniciarBuscadorControlador();
		}

		/* Ruta para eliminar la busqueda */
		if($_POST['modulo_buscador']=="eliminar"){
			echo $insBuscador->eliminarBuscadorControlador();
		}

	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}

?>