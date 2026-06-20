<?php

	namespace app\controllers;
	use app\models\mainModel;

	class searchController extends mainModel{

		# ----------  Controlador modulos de busquedas  ---------- #

		/* Metodo de validacion de modulos de busquedas */
		public function modulosBusquedaControlador($modulo){

			$listaModulos=['userSearch'];

			/* Si el parametro coincide con alguno del array, devolvemos false */
			if(in_array($modulo, $listaModulos)){
				return false;
			}else{
				return true;
			}
		}

		/*----------  Metodo para iniciar busqueda  ----------*/
		public function iniciarBuscadorControlador(){
			
			# Sanitizamos los datos recibidos por POST
			$url=$this->limpiarCadena($_POST['modulo_url']);
			$texto=$this->limpiarCadena($_POST['txt_buscador']);

			# Validamos el modulo de busqueda
			if($this->modulosBusquedaControlador($url)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No podemos procesar la petición en este momento",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}

			# Validamos que la busqueda tenga contenido
			if($texto==""){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"Introduce un termino de busqueda",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}

			# Validamos que el formato del contenido de la busqueda
			if($this->verificarDatos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}",$texto)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El termino de busqueda no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}

			# Guardamos el contenido de la busqueda en la sesion
			$_SESSION[$url]=$texto;

			# Generamos un modal de redireccionamiento a la pagina de busquedas, con la sesion con el contenido de la busqueda
			$alerta=[
				"tipo"=>"redireccionar",
				"url"=>APP_URL.$url."/"
			];

			# Devolvemos el modal correspondiente
			return json_encode($alerta);
			exit();
		}

		/*----------  Metodo para eliminar busqueda  ----------*/
		public function eliminarBuscadorControlador(){

			# Sanitizamos los datos recibidos por POST
			$url=$this->limpiarCadena($_POST['modulo_url']);

			# Validamos el modulo de busqueda
			if($this->modulosBusquedaControlador($url)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No podemos procesar la petición en este momento",
					"icono"=>"error"
				];

				return json_encode($alerta);
				exit();
			}
		}
	}

?>