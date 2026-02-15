<?php

	namespace app\controllers;
	use app\models\mainModel;

	class loginController extends mainModel{

		/*----------  Controlador iniciar sesion  ----------*/
		public function iniciarSesionControlador(){

			$usuario=$this->limpiarCadena($_POST['login_usuario']);
			$clave=$this->limpiarCadena($_POST['login_clave']);

			//Validación campos obligatorios
			if($usuario=="" || $clave==""){
					echo "<script>
									Swal.fire({
										icon: 'error',
										title: 'Ocurrió un error inesperado',
										text: 'No has llenado todos los campos que son obligatorios'
									});
								</script>";
			}else{
				// Validando integridad de los datos de usuario 
				if($this->verificarDatos("[a-zA-Z0-9]{4,20}",$usuario)){
					echo "<script>
									Swal.fire({
											icon: 'error',
											title: 'Ocurrió un error inesperado',
											text: 'El USUARIO no coincide con el formato solicitado'
										});
								</script>";
				}else{
					// Validando integridad de los datos de clave
					if($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}",$clave)){
						echo "<script>
										Swal.fire({
											icon: 'error',
											title: 'Ocurrió un error inesperado',
											text: 'La CLAVE no coincide con el formato solicitado'
										});
									</script>";
					}else{

					}
				}
			}
		}
	}
?>