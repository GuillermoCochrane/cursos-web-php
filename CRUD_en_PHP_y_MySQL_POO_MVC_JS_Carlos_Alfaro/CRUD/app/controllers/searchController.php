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
			
			# Sanrizamos los datos recibidos por POST
			$url=$this->limpiarCadena($_POST['modulo_url']);
			$texto=$this->limpiarCadena($_POST['txt_buscador']);
		}
	}

?>