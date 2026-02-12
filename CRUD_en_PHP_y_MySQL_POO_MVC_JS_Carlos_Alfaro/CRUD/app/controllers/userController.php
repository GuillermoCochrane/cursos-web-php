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
			
			# Validación campos obligatorios #
			if($nombre=="" || $apellido=="" || $usuario=="" || $clave1=="" || $clave2==""){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No has llenado todos los campos que son obligatorios",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}

			# Validación de tipos de datos y largo de los mismos  para: #
			//Nombre
			if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El NOMBRE no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}

			//Apellido
			if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El APELLIDO no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}

			// Usuario
			if($this->verificarDatos("[a-zA-Z0-9]{4,20}",$usuario)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El USUARIO no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}

			// Passwords y repetición
			if($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}",$clave1) || $this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}",$clave2)){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"Las CLAVES no coinciden con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}

		# Validación del email #
			if($email!=""){
				//Verficamos que sea un email válido
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$check_email=$this->ejecutarConsulta("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");

					// Verificamos si el email ya existe
					if($check_email->rowCount()>0){
						$alerta=[
							"tipo"=>"simple",
							"titulo"=>"Ocurrió un error inesperado",
							"texto"=>"El EMAIL que acaba de ingresar ya se encuentra registrado en el sistema, por favor verifique e intente nuevamente",
							"icono"=>"error"
						];
						return json_encode($alerta);
						exit();
					}
				}else{
					//si el campo email está vacío
					$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"Ha ingresado un correo electrónico no valido",
						"icono"=>"error"
					];
					return json_encode($alerta);
					exit();
				}
			}
		}
	}

?>