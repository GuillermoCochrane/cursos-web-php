<?php

	namespace app\controllers;
	use app\models\mainModel;

	class userController extends mainModel{

		/*----------  Controlador registrar usuario  ----------*/
		public function registrarUsuarioControlador(){

			# Sanitizando datos
			$nombre=$this->limpiarCadena($_POST['usuario_nombre']);
			$apellido=$this->limpiarCadena($_POST['usuario_apellido']);

			$usuario=$this->limpiarCadena($_POST['usuario_usuario']);
			$email=$this->limpiarCadena($_POST['usuario_email']);
			$clave1=$this->limpiarCadena($_POST['usuario_clave_1']);
			$clave2=$this->limpiarCadena($_POST['usuario_clave_2']);


		}
	}

?>